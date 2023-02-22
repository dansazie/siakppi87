<?php

namespace App\Http\Livewire\Admin\Master\Santri;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Santri;
use App\Imports\ImportSantri;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Alert;

class ImportDataSantri extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $fileimport;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $santris=Santri::latest()->paginate(20);
        return view('livewire.admin.master.santri.import-data-santri',['santris'=>$santris]);
    }

    public function add(){
        $this->fileimport="";
    }

    public function submit()
    {
        $this->validate([
            'fileimport' => 'required|mimes:xlsx,xls|max:1024', // 1MB Max
        ]);

        Excel::import(new ImportSantri, $this->fileimport);

        Alert::success('Tambah data', 'Berhasil tambah data');
        return redirect()->to('/master/santri/import');
        
        //$this->fileimport->store('importfile');
    }
}
