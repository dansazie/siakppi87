<?php

namespace App\Http\Livewire\Admin\Akademik\Mapel;

use Livewire\Component;
use App\Models\Jurusan;
use App\Models\Mapel;
use Alert;
use Livewire\WithPagination;

class ListMapel extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $mapel_id;
    public $kodemapel;
    public $mapel;
    public $status;
    public $jurusan;
    public $hapus_id;
    public $jurusans;    
    public $update_mode = false;
    public $judul="";

    public function mount(){
        $this->jurusans=Jurusan::all();
    }

    public function render()
    {
        $mapels = Mapel::with('jurusan')->paginate(10);
        return view('livewire.admin.akademik.mapel.list-mapel',['mapels'=>$mapels]);
    }

    public function submit()
    {
        if($this->update_mode==false){
            $this->validate([
                'kodemapel'   => 'required|unique:mapels',
                'mapel' => 'required',
                'jurusan' => 'required',
                'status' => 'required'
            ]);
        }else{
            $this->validate([
                'mapel' => 'required',
                'jurusan' => 'required',
                'status' => 'required'
            ]);
        }
       
        if($this->mapel_id==""){
            Mapel::create([
                'kodemapel'   => $this->kodemapel,
                'mapel' => $this->mapel,
                'jurusan_id'   => $this->jurusan,
                'status' => $this->status
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/master/mapel');
        }else{
            $mapel = Mapel::find($this->mapel_id);
            $mapel->update([
                'kodemapel'   => $this->kodemapel,
                'mapel' => $this->mapel,
                'jurusan_id'   => $this->jurusan,
                'status' => $this->status
            ]);
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/master/mapel');
        }
    }

    public function edit($id)
    {        
        $this->update_mode = true;
        $this->resetValidation();        
        $this->judul='Update Mata Pelajaran';
        $mapel = Mapel::where('id',$id)->first();
        $this->mapel_id = $id;
        $this->kodemapel = $mapel->kodemapel;
        $this->mapel = $mapel->mapel;
        $this->status = $mapel->status;
        $this->jurusan = $mapel->jurusan_id;
    }

    public function add()
    {        
        $this->update_mode = false;
        $this->resetValidation();        
        $this->judul='Tambah Mata Pelajaran';
        $this->mapel_id = "";
        $this->kodemapel = "";
        $this->mapel = "";
        $this->status = "";
        $this->jurusan = "";
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
        Mapel::where('id',$id)->delete();
        Alert::success('Hapus data', 'Berhasil menghapus data');
        return redirect()->to('/master/mapel');        
    }
}
