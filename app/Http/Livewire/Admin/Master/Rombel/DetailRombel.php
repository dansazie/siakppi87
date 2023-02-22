<?php

namespace App\Http\Livewire\Admin\Master\Rombel;

use Livewire\Component;
use App\Models\Rombel;
use App\Models\Santri;
use Alert;
use Livewire\WithPagination;
use Carbon\Carbon;
use DB;

class DetailRombel extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public  $santri_id;
    public  $santris=[];
    public  $getsantris=[];
    public  $datasantris=[];
    public  $santrisaktif=[];
    public  $getrombel;
    public  $rombel;
    public  $tingkat;
    public  $tahunakademik;
    public  $walikelas;
    public  $rombel_id;
    public  $update_mode = false;
    public  $judul="";

    protected $listeners = ['showData' => 'showData','simpan'=>'simpan'];

    public function mount($id){
        $this->getrombel = Rombel::with(['tingkat','tahunAkademik','waliKelas','santris'])->find($id);
        if(!empty($this->getrombel->santris)){
            foreach($this->getrombel->santris as $row){
                $this->santris[]=collect([
                    'santri_id'=>$row->id,
                    'namasantri'=>$row->namalengkap,
                    'nis'=>$row->nis,
                ]);
            }
        }
        $this->getsantris = Santri::where('tingkat_id',$this->getrombel->tingkat_id)->get()->toArray();
        $this->santrisaktif = Santri::has('rombels')->get()->toArray();
        //dd($this->santrisaktif,$this->getsantris);
        $this->rombel=$this->getrombel->rombel;
        $this->tingkat=$this->getrombel->tingkat->tingkat;
        $this->walikelas=$this->getrombel->waliKelas->namalengkap;
        $this->tahunakademik=$this->getrombel->tahunAkademik->tahunakademik;
    }

    public function render()
    {

        return view('livewire.admin.master.rombel.detail-rombel');
    }

    public function showData(){
        $this->datasantris = $this->getsantris;
        foreach($this->datasantris as $in=> $a){
            foreach($this->santrisaktif as $key=> $b){
                if($a['namalengkap'] === $b['namalengkap']){
                    unset($this->datasantris[$in]);
                    $this->datasantris = $this->datasantris;
                }
            }
        }
        foreach($this->datasantris as $in=> $a){
            foreach($this->santris as $key=> $b){
                if($a['namalengkap'] === $b['namasantri']){
                    unset($this->datasantris[$in]);
                    $this->datasantris = $this->datasantris;
                }
            }
        }
    }

    public function addSantri($key)
    {

        $x=$this->datasantris[$key];
       // dd($x);
        $this->santris[]=[
            'santri_id'=>$x['id'],
            'namasantri'=>$x['namalengkap'],
            'nis'=>$x['nis']
        ];
        $this->santris = $this->santris;
        unset($this->datasantris[$key]);
        $key="";
    }

    public function removeSantri($index)
    {
        $y=$this->santris[$index];
        $this->datasantris[] =[
            'id'=> $y['santri_id'],
            'namalengkap'=>$y['namasantri'],
            'nis'=>$y['nis']
        ];
        unset($this->santris[$index]);
        //dd($this->datasantris);
    }

    private function mapingSantri($data)
    {
       // dd($data);
        return collect($data)->map(function ($i) {
            return ['santri_id' => $i,'status' => 'Aktif','tahun'=>setting('tahunakademik')];
        });
    }

    public function simpan()
    {

        if(!empty($this->santris)) {
            foreach($this->santris as $row){
                $insertsantri[]=$row['santri_id'];
            }
            //dd($this->mapingSantri($insertsantri));
            $this->getrombel->santris()->sync($this->mapingSantri($insertsantri));
            Alert::success('Data Santri', 'Data santri berhasil disimpan');
            return redirect()->to('/master/rombel/detail/'.$this->getrombel->id);
        }else{
            Alert::success('Data Santri', 'Data santri berhasil disimpan');
            return redirect()->to('/master/rombel/detail/'.$this->getrombel->id);
        }
    }
}
