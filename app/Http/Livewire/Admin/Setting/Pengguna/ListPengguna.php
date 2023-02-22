<?php

namespace App\Http\Livewire\Admin\Setting\Pengguna;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Asatidz;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Alert;
use Livewire\WithPagination;

class ListPengguna extends Component
{
    use WithPagination;
    
    public $asatidzs;
    public $asatidz_id;
    public $name;
    public $email;
    public $password;
    public $user_id;
    public $role_id;
    public $role;
    public $roles=[];
    public $update_mode = false;
    public $judul;
    public $hapus_id;

    public function mount()
    {
        $this->roles = Role::all(); 
        $this->asatidzs = Asatidz::all();

    }
    
    public function render()
    {
        $users = User::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.setting.pengguna.list-pengguna',compact('users'));
    }

    public function submit()
    {        
        if($this->update_mode){
            $this->validate([
                'asatidz_id'=> 'required',
                'email' => 'required|email',
                'role' => 'required'
            ]);
        }else{
            $this->validate([
                'asatidz_id'=> 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role' => 'required'
            ]);
        }   

        $asatidz = Asatidz::where('id',$this->asatidz_id)->first();
        $this->name=$asatidz->namalengkap;                 

        if($this->user_id==""){
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password)
            ]);
            $user->assignRole($this->role);
            $asatidz->update(['user_id'=>$user->id]);  
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/setting/pengguna');
        }else{            
            $user = User::find($this->user_id);            
            if($this->password !=""){
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,                
                    'password' => bcrypt($this->password)
                ]);
            }else {
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email
                ]);                
            }   
            DB::table('model_has_roles')->where('model_id',$this->user_id)->delete();
            $user->assignRole($this->role);      
            $asatidz->update(['user_id'=>$this->user_id]);             
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/setting/pengguna');
        }
    }

    public function edit($id)
    {              
        $this->update_mode=true;
        $this->judul="Update Pengguna";
        $user = User::with('asatidz')->where('id',$id)->first();
        $role=DB::table('model_has_roles')->where('model_id',$id)->first();  
        $this->user_id = $id;
        //dd($user);
        if($user->asatidz){
            $this->asatidz_id = $user->asatidz->id;
        }else{
            $this->asatidz_id = "";
        }        
        $this->email = $user->email;
        $this->role = $role->role_id;
        $this->password = "";
    }

    public function add()
    {        
        $this->update_mode=false;
        $this->judul="Tambah Pengguna";
        $this->user_id = "";
        $this->asatidz_id = "";
        $this->email = "";
        $this->password = "";   
        $this->role="";     
    }

    public function confirmHapus($id)
    {       
        $this->hapus_id = $id;
        //dd($this->hapus_id);
    }

    protected $listeners = ['hapus' => 'hapus'];

    public function hapus()
    {               
        $id=$this->hapus_id;
        if($id != Auth::id()){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            User::where('id',$id)->delete(); 
            $this->hapus_id="";           
            Alert::success('Hapus data', 'Berhasil menghapus data');
            return redirect()->to('/setting/pengguna');
        }else{
            Alert::warning('Hapus data', 'Tidak dapat menghapus akun sendiri');
            return redirect()->to('/setting/pengguna');
        }
        
    }



    public function delete($id)
    {       
        if($id != Auth::id()){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            User::where('id',$id)->delete();            
            Alert::success('Hapus data', 'Berhasil menghapus data');
            return redirect()->to('/setting/pengguna');
        }else{
            Alert::warning('Hapus data', 'Tidak dapat menghapus akun sendiri');
            return redirect()->to('/setting/pengguna');
        }
    }
}
