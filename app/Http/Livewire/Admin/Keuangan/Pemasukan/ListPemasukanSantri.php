<?php

namespace App\Http\Livewire\Admin\Keuangan\Pemasukan;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Pemasukan;
use Alert;
use Livewire\WithPagination;

class ListPemasukanSantri extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public  $cari='';

    public $update_mode = false;
    public $judul="";


    public function render()
    {
        sleep(1);
        $data['santris'] = Santri::with(['tingkat','pemasukans'])->search('namalengkap',$this->cari)->orderBy('tingkat_id','ASC')->paginate(15);
        //dd($data['santris']);
        return view('livewire.admin.keuangan.pemasukan.list-pemasukan-santri',$data);
    }
}
