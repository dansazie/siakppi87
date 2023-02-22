<?php

namespace App\Http\Livewire\Admin\Akademik\Rombel;

use Livewire\Component;
use App\Models\Rombel;
use App\Models\Tingkat;
use App\Models\Jurusan;
use App\Models\TahunAkademiks;
use App\Models\Asatidz;
use App\Models\Santri;
use Alert;
use Livewire\WithPagination;

class ListRombel extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $update_mode = false;
    public $judul="";
    public $rombel_id;
    public $rombel;
    public $tingkats;
    public $tingkat;
    public $jurusans;
    public $jurusan;
    public $tahunakademik;
    public $asatidzs;
    public $walikelas;
    public $status;  
    public $hapus_id;  
    
    public function mount(){
        $this->tingkats=Tingkat::all();
        $this->jurusans=Jurusan::all();
        $this->tahunakademik=setting('tahunakademik_id');
        $this->asatidzs=Asatidz::all();
    }
    

    public function render()
    {
        $data['rombels']=Rombel::with(['tingkat','jurusan','waliKelas'])->withCount('santris')->where('tahunakademik_id',setting('tahunakademik_id'))->paginate(10);
        return view('livewire.admin.akademik.rombel.list-rombel',$data);
    }

    public function submit()
    {
        $this->validate([
                'rombel'   => 'required',
                'tingkat' => 'required',
                'jurusan' => 'required',
                'walikelas' => 'required',
                'status' => 'required'
        ]);        
       
        if($this->rombel_id==""){
            Rombel::create([
                'rombel'   => $this->rombel,
                'tingkat_id' => $this->tingkat,
                'jurusan_id' => $this->jurusan,
                'asatidz_id' => $this->walikelas,
                'tahunakademik_id' => $this->tahunakademik,
                'status' => $this->status
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/master/rombel');
        }else{
            $rombel = Rombel::find($this->rombel_id);
            $rombel->update([
                'rombel'   => $this->rombel,
                'tingkat_id' => $this->tingkat,
                'jurusan_id' => $this->jurusan,
                'asatidz_id' => $this->walikelas,
                'tahunakademik_id' => $this->tahunakademik,
                'status' => $this->status
            ]);
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/master/rombel');
        }
    }

    public function edit($id)
    {        
        $this->update_mode = true;
        $this->resetValidation();        
        $this->judul='Update Rombongan Belajar';
        $rombel = Rombel::where('id',$id)->first();
        $this->rombel_id = $id;
        $this->rombel = $rombel->rombel;
        $this->tingkat = $rombel->tingkat_id;        
        $this->jurusan = $rombel->jurusan_id;
        $this->walikelas = $rombel->waliKelas->id;        
        $this->status = $rombel->status;
    }

    public function add()
    {        
        $this->update_mode = false;
        $this->resetValidation();        
        $this->judul='Tambah Rombongan Belajar';
        $this->rombel_id = "";
        $this->rombel = "";
        $this->tingkat = "";        
        $this->jurusan = "";
        $this->walikelas = "";  
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
        Rombel::where('id',$id)->delete();
        Alert::success('Hapus data', 'Berhasil menghapus data');
        return redirect()->to('/master/rombel');        
    }
}
