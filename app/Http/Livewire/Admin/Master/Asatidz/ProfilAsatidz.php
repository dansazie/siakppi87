<?php

namespace App\Http\Livewire\Admin\Master\Asatidz;

use Livewire\Component;
use App\Models\Asatidz;
use App\Models\User;
use Alert;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use DB;

class ProfilAsatidz extends Component
{
    use WithFileUploads;
    public $file;

    public  $user_id;
    public  $user;
    public  $name;
    public  $email;
    public  $password;
    public  $usia;
    public  $photo;
    public  $asatidz;
    public  $asatidz_id;
    public  $update_mode = false;
    public  $judul="";

    public function mount($id){
        $this->asatidz = Asatidz::with(['provinsi','kabupaten','kecamatan','pendidikan','desa','user'])->where('nip',$id)->first();
        if ($this->asatidz) {
            $this->usia =Carbon::parse($this->asatidz->tgllahir)->diffInYears(Carbon::now());
            $this->name= $this->asatidz->namalengkap;
            $this->asatidz_id= $this->asatidz->id;
            $this->photo = $this->asatidz->photo;
            if(!empty($this->asatidz->user->id)){
                $this->update_mode = true;
                $this->judul = "Edit Akun";
                $this->email= $this->asatidz->user->email;
                $this->user_id= $this->asatidz->user->id;
            }else{
                    $this->update_mode = false;
                    $this->judul = "Buat Akun";
                    $this->email= "";
                    $this->password= "";
                    $this->user_id= "";
            }
        }else{
            Alert::warning('Perhatian', 'Data tidak ditemukan');
            return redirect()->to(route('master.asatidz'));
        }
        
    }

    public function render()
    {
        return view('livewire.admin.master.asatidz.profil-asatidz',['asatidz'=>$this->asatidz]);
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
            $asatidz=Asatidz::where('id', $this->asatidz_id)->first();
            $asatidz->update([
                'user_id'=>$user->id
            ]);
            if($this->file!=""){
                $asatidz->update([
                    'photo' => $this->file->store('photos', 'public')
                ]);
            }
            Alert::success('Buat Akun', 'Berhasil buat akun');
            return redirect()->to('/master/asatidz/profil/'.$this->asatidz->id);
        }else{
            $user = User::find($this->user_id);
            if($this->password !=""){
                $user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => bcrypt($this->password)
                ]);
                if($this->file!=""){
                    $asatidz=Asatidz::where('id', $this->asatidz_id)->first();
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
                    $asatidz=Asatidz::where('id', $this->asatidz_id)->first();
                    $asatidz->update([
                        'photo' => $this->file->store('photos', 'public')
                    ]);
                }
            }
            Alert::success('Ubah data', 'Berhasil merubah akun');
            return redirect()->to('/master/asatidz/profil/'.$this->asatidz->id);
        }
    }
}
