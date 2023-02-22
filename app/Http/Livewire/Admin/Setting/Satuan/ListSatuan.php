<?php

namespace App\Http\Livewire\Admin\Setting\Satuan;

use Livewire\Component;
use App\Models\Satuan;
use App\Models\Asatidz;
use Alert;
use Livewire\WithPagination;

class ListSatuan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $satuan_id;
    public $nsm;
    public $npsn;
    public $mudir;
    public $logo;
    public $hapus_id;
    public $asatidzs;    
    public $update_mode = false;
    public $judul;

    public function mount(){
        $this->asatidzs=Asatidz::all();
    }
    
    public function render()
    {
        $satuans = Satuan::with('mudir')->paginate(5);
        //dd($satuans);
        return view('livewire.admin.setting.satuan.list-satuan',['satuans'=>$satuans]);
    }

    public function submit()
    {
        $this->validate([
            'satuan'   => 'required',
            'npsn' => 'required',
            'nsm' => 'required',
            'mudir' => 'required'
        ]);
        if($this->satuan_id==""){
            Satuan::create([
                'satuan'   => $this->satuan,
                'npsn' => $this->npsn,
                'nsm' => $this->nsm,
                'asatidz_id' => $this->mudir
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/setting/satuan');
        }else{
            $satuan = Satuan::find($this->satuan_id);
            $satuan->update([
                'satuan'   => $this->satuan,
                'npsn' => $this->npsn,
                'nsm' => $this->nsm,
                'asatidz_id' => $this->mudir
            ]);
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/setting/satuan');
        }
    }

    public function edit($id)
    {        
        $this->update_mode == true;
        $this->judul='Update Satuan';
        $satuan = Satuan::where('id',$id)->first();
        $this->satuan_id = $id;
        $this->satuan = $satuan->satuan;
        $this->npsn = $satuan->npsn;
        $this->nsm = $satuan->nsm;
        $this->mudir = $satuan->asatidz_id;
        $this->logo=$satuan->logo;
    }

    public function add()
    {        
        $this->update_mode == false;
        $this->judul='Tambah Satuan';
        $this->satuan_id = "";
        $this->satuan =  "";
        $this->npsn = "";
        $this->nsm =  "";
        $this->mudir =  "";
        $this->logo="";
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
        Satuan::where('id',$id)->delete();
        Alert::success('Hapus data', 'Berhasil menghapus data');
        return redirect()->to('/setting/satuan');        
    }


}
