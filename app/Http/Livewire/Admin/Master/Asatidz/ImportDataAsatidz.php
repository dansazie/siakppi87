<?php

namespace App\Http\Livewire\Admin\Master\Asatidz;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Asatidz;
use App\Imports\ImportAsatidz;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Alert;

class ImportDataAsatidz extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $fileimport;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $asatidzs=Asatidz::latest()->paginate(10);
        return view('livewire.admin.master.asatidz.import-data-asatidz',['asatidzs'=>$asatidzs]);
    }

    
 
    public function submit()
    {
        $this->validate([
            'fileimport' => 'required|mimes:xlsx,xls|max:1024', // 1MB Max
        ]);

        Excel::import(new ImportAsatidz, $this->fileimport);

        Alert::success('Tambah data', 'Berhasil tambah data');
        return redirect()->to('/master/asatidz/import');
        
        //$this->fileimport->store('importfile');
    }

    public function add(){
        $this->fileimport="";
    }
}
