<?php

namespace App\Http\Livewire\Admin\Keuangan\Pemasukan;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Pemasukan;
use App\Models\Pembayaran;
use Auth;

class DetailPemasukanSantri extends Component
{
    public $santri;
    public $santri_id;
    public $rombel;
    public $total=0;
    public $pemasukans=[];
    public $pembayarans=[];
    public $kodebayar;



    public function mount($id){
        $this->santri=Santri::with('pemasukans','pembayarans')->where('nis',$id)->first();
        $this->santri_id=$this->santri->id;

        if(!empty($this->santri->pemasukans)){
            foreach ($this->santri->pemasukans as $key => $row) {
                $this->pemasukans[]=$row;
                $this->total+=$row->nominal;
            }
        }
        if(!empty($this->santri->pembayarans)){
            foreach ($this->santri->pembayarans as $key => $row) {
                $this->pembayarans[]=$row;
            }
        }
        $this->rombel=$this->santri->rombel()->first();

    }

    public function kodeBayar(){
        $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $noUrutAkhir = Pembayaran::max('id');
        $no = 1;
        $kode='';
        if($noUrutAkhir) {
            $kode= sprintf("%05s", abs($noUrutAkhir + 1)).$this->santri->nis .'/' . $bulanRomawi[date('n')] .'/' . substr(date('Y'),2);
        }
        else {
            $kode= sprintf("%05s", $no).$this->santri->nis .'/' . $bulanRomawi[date('n')] .'/' . substr(date('Y'),2);
        }
        return $kode;
    }

    public function add()
    {
        $this->kodebayar=$this->kodeBayar();
        $this->petugas = Auth::user()->name;
    }


    public function render()
    {
        return view('livewire.admin.keuangan.pemasukan.detail-pemasukan-santri');
    }
}
