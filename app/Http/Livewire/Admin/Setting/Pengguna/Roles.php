<?php

namespace App\Http\Livewire\Admin\Setting\Pengguna;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Alert;

class Roles extends Component
{
    function __construct()
    {
         //$this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         //$this->middleware('permission:role-create', ['only' => ['create','store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         //$this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public $permissions=[];
    public $guard_name;
    public $role_id;
    public $name;

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function render()
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('livewire.admin.setting.pengguna.roles',compact('roles'));
    }

    public function submit()
    {
        $this->validate([
                'name'   => 'required'
        ]);      
        if($this->role_id==""){
            Role::create([
                'name' => $this->name
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/setting/roles');
        }else{
            $role = Role::find($this->role_id);
            $role->update([
                    'name' => $this->name
            ]);           
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/setting/roles');
        }
    }

    public function edit($id)
    {        
        $role = Role::where('id',$id)->first();
        $this->role_id = $id;
        $this->name = $role->name;
    }

    public function add()
    {        
        $this->role_id = "";
        $this->name = "";        
    }


    public function delete($id)
    {       
        if($id != Auth::id()){
            User::where('id',$id)->delete();
            Alert::success('Hapus data', 'Berhasil menghapus data');
            return redirect()->to('/setting/pengguna');
        }else{
            Alert::warning('Hapus data', 'Tidak dapat menghapus akun sendiri');
            return redirect()->to('/setting/pengguna');
        }
    }
}
