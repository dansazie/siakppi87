<?php

namespace App\Http\Livewire\Admin\Setting\Tingkat;

use Livewire\Component;
use App\Models\Satuan;
use App\Models\Tingkat;
use Alert;
use Livewire\WithPagination;

class ListTingkat extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $tingkat_id;
    public $tingkat;
    public $satuan;
    public $hapus_id;
    public $satuans;    
    public $update_mode = false;
    public $judul;

    public function mount(){
        $this->satuans=Satuan::all();
    }

    public function render()
    {
        $tingkats = Tingkat::with('satuan')->paginate(10);
        return view('livewire.admin.setting.tingkat.list-tingkat',['tingkats'=>$tingkats]);
    }

    public function submit()
    {
        $this->validate([
            'tingkat'   => 'required|unique:tingkats',
            'satuan' => 'required'
        ]);
        if($this->tingkat_id==""){
            Tingkat::create([
                'tingkat'   => $this->tingkat,
                'satuan_id' => $this->satuan
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/setting/tingkat');
        }else{
            $tingkat = Tingkat::find($this->tingkat_id);
            $tingkat->update([
                'tingkat'   => $this->tingkat,
                'satuan_id' => $this->satuan
            ]);
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/setting/tingkat');
        }
    }

    public function edit($id)
    {        
        $this->resetValidation();
        $this->update_mode == true;
        $this->judul='Update Tingkat';
        $tingkat = Tingkat::where('id',$id)->first();
        $this->tingkat_id = $id;
        $this->tingkat = $tingkat->tingkat;
        $this->satuan = $tingkat->satuan_id;
    }

    public function add()
    {        
        $this->resetValidation();
        $this->update_mode == false;
        $this->judul='Tambah Tingkat';
        $this->tingkat_id = "";
        $this->tingkat = "";
        $this->satuan = "";
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
        return redirect()->to('/setting/tingkat');        
    }
}
