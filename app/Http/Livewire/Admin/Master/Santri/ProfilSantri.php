<?php

namespace App\Http\Livewire\Admin\Master\Santri;

use Livewire\Component;
use App\Models\Santri;
use App\Models\User;
use Alert;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class ProfilSantri extends Component
{
    use WithFileUploads;
    public $file;

    public  $user_id;
    public  $name;
    public  $email;
    public  $password;
    public  $usia;
    public  $photo;
    public  $santri;
    public  $santri_id;
    public  $update_mode = false;
    public  $judul="";

    public function mount($id){
        $this->santri = Santri::with(['provinsi','kabupaten','kecamatan','tingkat','desa','user','rombel'])->where('nis',$id)->first();
        if($this->santri){
            $this->usia =Carbon::parse($this->santri->tgllahir)->diffInYears(Carbon::now()); 
            $this->name= $this->santri->namalengkap;
            $this->rombel=$this->santri->rombel()->first();
            if(!empty($this->santri->user->id)){
                $this->update_mode = true;
                $this->judul = "Edit Akun";
                $this->email= $this->santri->user->email;
                $this->user_id= $this->santri->user->id;
                $this->santri_id= $this->santri->id;
                $this->photo = $this->santri->photo;
            }else{
                $this->update_mode = false;
                $this->judul = "Buat Akun";
                $this->email= "";
                $this->password= "";
                $this->user_id= "";
                $this->santri_id= $this->santri->id;
                $this->photo = "";
            }
        }else{
            Alert::warning('Perhatian', 'Data tidak ditemukan');
            return redirect()->to(route('master.santri'));
        }
        
    }

    public function render()
    {
        return view('livewire.admin.master.santri.profil-santri',['santri'=>$this->santri]);
    }

    public function submit()
    {
        if($this->update_mode){
            $this->validate([
                'name'   => 'required',
                'email' => 'required|email',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
        }else{
            $this->validate([
                'name'   => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
        }        
        if($this->user_id==""){
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password)
            ]);
            $asatidz=Santri::where('id', $this->santri_id)->first();
            $asatidz->update([
                'user_id'=>$user->id
            ]);
            if($this->file!=""){
                $asatidz->update([
                    'photo' => $this->file->store('photos', 'public')
                ]);
            }
            Alert::success('Buat Akun', 'Berhasil buat akun');
            return redirect()->to('/master/asatidz/profil/'.$this->santri->id);
        }else{
            $user = User::find($this->user_id);
            if($this->password !=""){
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,                
                    'password' => bcrypt($this->password)
                ]);
                if($this->file!=""){
                    $asatidz=Santri::where('id', $this->santri_id)->first();
                    $asatidz->update([
                        'photo' => $this->file->store('photos', 'public')
                    ]);
                }                
            }else {
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email
                ]);
                if($this->file!=""){
                    $asatidz=Santri::where('id', $this->santri_id)->first();
                    $asatidz->update([
                        'photo' => $this->file->store('photos', 'public')
                    ]);
                } 
            }            
            Alert::success('Ubah data', 'Berhasil merubah akun');
            return redirect()->to('/master/asatidz/profil/'.$this->santri->id);
        }
    }
}
