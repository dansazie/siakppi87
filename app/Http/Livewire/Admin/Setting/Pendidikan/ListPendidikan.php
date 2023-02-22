<?php

namespace App\Http\Livewire\Admin\Setting\Pendidikan;

use Livewire\Component;
use App\Models\Pendidikan;
use Alert;
use Livewire\WithPagination;

class ListPendidikan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $jenjang;
    public $deskripsi;
    public $pendidikan_id;

    public function render()
    {
        $pendidikan = Pendidikan::latest()->paginate(5);
        return view('livewire.admin.setting.pendidikan.list-pendidikan',['pendidikan'=>$pendidikan]);
    }

    public function submit()
    {
        $this->validate([
            'jenjang'   => 'required',
            'deskripsi' => 'required'
        ]);
        if($this->pendidikan_id==""){
            Pendidikan::create([
                'jenjang' => $this->jenjang,
                'deskripsi' => $this->deskripsi
            ]);
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/setting/pendidikan');
        }else{
            $pendidikan = Pendidikan::find($this->pendidikan_id);
            $pendidikan->update([
                'jenjang' => $this->jenjang,
                'deskripsi' => $this->deskripsi
            ]);
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/setting/pendidikan');
        }
    }

    public function edit($id)
    {        
        $pendidikan = Pendidikan::where('id',$id)->first();
        $this->pendidikan_id = $id;
        $this->jenjang = $pendidikan->jenjang;
        $this->deskripsi = $pendidikan->deskripsi;
    }

    public function add()
    {        
        $this->pendidikan_id = "";
        $this->jenjang = "";
        $this->deskripsi = "";
    }


    public function delete($id)
    {       
        if($id){
            Pendidikan::where('id',$id)->delete();
            Alert::success('Hapus data', 'Berhasil menghapus data');
            return redirect()->to('/setting/pendidikan');
        }
    }
}
