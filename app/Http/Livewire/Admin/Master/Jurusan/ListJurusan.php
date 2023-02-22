<?php

namespace App\Http\Livewire\Admin\Master\Jurusan;

use Livewire\Component;
use App\Models\Jurusan;
use Alert;

class ListJurusan extends Component
{
    public $jurusan;
    public $status;
    public $jurusan_id;
    public $judul="";
    public $update_mode=false;

    public function render()
    {
        $jurusans = Jurusan::all();
        return view('livewire.admin.master.jurusan.list-jurusan',['jurusans'=>$jurusans]);
    }

    public function submit()
    {
        $this->validate([
            'jurusan'   => 'required',
            'status' => 'required'
        ]);
        if($this->jurusan_id==""){
            Jurusan::create([
                'jurusan'   => $this->jurusan,
                'status' => $this->status
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/master/jurusan');
        }else{
            $jurusan = Jurusan::find($this->jurusan_id);
            $jurusan->update([
                'jurusan'=> $this->jurusan,
                'status' => $this->status
            ]);
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/master/jurusan');
        }
    }

    public function edit($id)
    {        
        $this->resetValidation();
        $this->judul="Update Jurusan";
        $this->update_mode=true;
        $jurusan = Jurusan::where('id',$id)->first();
        $this->jurusan_id = $id;
        $this->jurusan = $jurusan->jurusan;
        $this->status = $jurusan->status;
    }

    public function add()
    {        
        $this->resetValidation();
        $this->judul="Tambah Jurusan";
        $this->update_mode=false;
        $this->jurusan_id = "";
        $this->jurusan = "";
        $this->status = "";
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
        $status=Jurusan::where('id',$id)->first();
        if($id){
            if($status->status!="Aktif"){
                Jurusan::where('id',$id)->delete();
                Alert::success('Hapus data', 'Berhasil menghapus data');
                return redirect()->to('/master/jurusan');
            }else{
                Alert::warning('Hapus data', 'Data Aktif tidak dapat dihapus');
                return redirect()->to('/master/jurusan');
            }
        }
        
    }
}
