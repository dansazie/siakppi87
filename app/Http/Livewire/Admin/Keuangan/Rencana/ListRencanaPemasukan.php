<?php

namespace App\Http\Livewire\Admin\Keuangan\Rencana;

use Livewire\Component;
use App\Models\TahunAkademiks;
use App\Models\Tingkat;
use App\Models\Santri;
use App\Models\Pemasukan;
use Alert;
use Livewire\WithPagination;
use DB;

class ListRencanaPemasukan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $update_mode = false;
    public $judul="";

    public $pemasukans;
    public $pemasukan_id;
    public $kode;
    public $namapemasukan;
    public $deskripsi;
    public $nominal;
    public $pemasukansantri;
    public $pilihtingkat=[];
    public $alltingkats=[];
    public $tahunakademik_id;
    public $tahunakademik;
    public $tglmulai;
    public $tglakhir;
    public $status="Non-Aktif";

    public function mount(){
        $this->alltingkats=Tingkat::all();
        $this->pemasukans=Pemasukan::with('tingkats','tahunAkademik')->get();
        $this->tahunakademik_id=setting('tahunakademik_id');
        $this->tahunakademik=setting('tahunakademik');
        $this->pilihtingkat=collect();
    }


    public function render()
    {
        //dd($this->pemasukans);
        return view('livewire.admin.keuangan.rencana.list-rencana-pemasukan');
    }

    private function mapingTingkat($data)
    {
       // dd($data);
        return collect($data)->map(function ($i) {
            return ['tingkat_id' => $i,'status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
        });
    }

    private function mapingSantri($data)
    {
        //dd($data);
        return collect($data)->map(function ($i) {
            return ['santri_id' => $i,'status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
        });
    }

    public function lock($id){
        $this->status="Aktif";
        $a=[];
        $c=[];
        $pemasukan=Pemasukan::with('tingkats')->where('id',$id)->first();
        if(!empty($pemasukan->tingkats)){
            foreach($pemasukan->tingkats as $row){
                $a [$row->id] = ['status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
                $b = DB::table('santris')->where('tingkat_id',$row->id)->get();
                foreach($b as $key=>$x){
                    $c[$x->id]= ['status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
                }
            }
            $pemasukan->tingkats()->sync($a,false);
            $pemasukan->santris()->sync($c,false);
        }
        $pemasukan->update(['status'=>$this->status]);

        Alert::success('Kunci data', 'Berhasil mengunci data');
        return redirect()->to('/keuangan/rencana/pemasukan');
    }

    public function unlock($id){
        $this->status="Non-Aktif";
        $a=[];
        $c=[];
        $pemasukan=Pemasukan::with('tingkats')->where('id',$id)->first();
        if(!empty($pemasukan->tingkats)){
            foreach($pemasukan->tingkats as $row){
                $a [$row->id] = ['status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
                $b = DB::table('santris')->where('tingkat_id',$row->id)->get();
                foreach($b as $key=>$x){
                    $c[$x->id]= ['status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
                }
            }
            $pemasukan->tingkats()->sync($a,false);
            $pemasukan->santris()->sync($c,false);
        }
        $pemasukan->update(['status'=>$this->status]);

        Alert::success('Kunci data', 'Berhasil membuka kunci data');
        return redirect()->to('/keuangan/rencana/pemasukan');
    }

    public function submit()
    {
        //dd($this->pilihtingkat);
        if($this->update_mode==false){
            $this->validate([
                'kode'   => 'required|unique:pemasukans',
                'namapemasukan' => 'required',
                'nominal' => 'required',
                //'status' => 'required'
            ]);
        }else{
            $this->validate([
                'namapemasukan' => 'required',
                'nominal' => 'required',
                //'status' => 'required'
            ]);
        }

        if($this->pemasukan_id==""){

            $a=[];            
            $data=Pemasukan::create([
                'kode'   => $this->kode,
                'namapemasukan' => $this->namapemasukan,
                'nominal' => $this->nominal,
                'is_pemasukansantri' => $this->pemasukansantri,
                'tahunakademik_id' => $this->tahunakademik_id,
                'status' => $this->status
           ]);
            if(!empty($this->pilihtingkat)){
                foreach($this->pilihtingkat as $row){
                    $a [$row] = ['status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
                }
                //dd($this->mapingSantri($c));
                $data->tingkats()->sync($a);
            }

            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/keuangan/rencana/pemasukan');
        }else{
            $a=[];
            $data = Pemasukan::find($this->pemasukan_id);
            $data->update([
                'kode'   => $this->kode,
                'namapemasukan' => $this->namapemasukan,
                'nominal' => $this->nominal,
                'is_pemasukansantri' => $this->pemasukansantri,
                'tahunakademik_id' => $this->tahunakademik_id,
                'status' => $this->status
            ]);
            if(!empty($this->pilihtingkat)){
                foreach($this->pilihtingkat as $row){
                    $a [$row] = ['status' => $this->status,'tahunakademik_id'=>$this->tahunakademik_id];
                }
                //dd($this->mapingSantri($c));
                $data->tingkats()->sync($a);
            }
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/keuangan/rencana/pemasukan');
        }
    }

    public function checkpemasukansantri()
    {
        if($this->pemasukansantri==false){
            $this->pilihtingkat = [];
        }
        $this->emit('pemasukansantri');
    }

    public function edit($id)
    {
        $this->showForm();
        $this->update_mode = true;
        $this->resetValidation();
        $this->judul='Update Rencana Pemasukan';
        $pemasukan=Pemasukan::with('tingkats')->where('id',$id)->first();
        $this->pemasukan_id = $id;
        $this->kode = $pemasukan->kode;
        $this->namapemasukan = $pemasukan->namapemasukan;
        $this->nominal = $pemasukan->nominal;
        $this->pemasukansantri = $pemasukan->is_pemasukansantri;
        //$this->status = $pemasukan->status;
        $this->pilihtingkat=[];
        if($pemasukan->tingkats){
            foreach($pemasukan->tingkats as $tingkat){
                $this->pilihtingkat[]=$tingkat->id;
            }
        }
        $this->checkpemasukansantri();
        //dd($this->tingkat);
    }

    public function showForm()
    {
        $this->emit('showform');
    }

    public function hideForm()
    {
        $this->emit('hideform');
    }

    public function add()
    {
        $this->showForm();
        $this->update_mode = false;
        $this->resetValidation();
        $this->judul='Tambah Rencana Pemasukan';
        $this->pemasukan_id = "";
        $this->kode = "";
        $this->namapemasukan = "";
        $this->nominal = "";
        //$this->status = "";
        $this->pemasukansantri = false;
        $this->pilihtingkat = [];

    }

    public function clearForm()
    {
        $this->update_mode = false;
        $this->resetValidation();
        $this->judul='Tambah Rencana Pemasukan';
        $this->pemasukan_id = "";
        $this->kode = "";
        $this->namapemasukan = "";
        $this->nominal = "";
        //$this->status = "";
        $this->pemasukansantri = false;
        $this->pilihtingkat = [];
        $this->checkpemasukansantri();
        $this->hideform();
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
        $pemasukan=Pemasukan::where('id',$id)->first();
        $pemasukan->tingkats()->detach();
        $pemasukan->delete();

        Alert::success('Hapus data', 'Berhasil menghapus data');
        return redirect()->to('/keuangan/rencana/pemasukan');
    }
}
