<?php

namespace App\Http\Livewire\Admin\Master\Asatidz;

use Livewire\Component;
use App\Models\Asatidz;
use App\Models\Pendidikan;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Alert;
use Livewire\WithPagination;

class ListAsatidz extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public  $nip;
    public  $nik;
    public  $nuptk;
    public  $namalengkap;
    public  $tmplahir;
    public  $tgllahir;
    public  $kelamin;
    public  $alamat;
    public  $provinsis=null;   
    public  $provinsi; 
    public  $kabupatens=null;
    public  $kabupaten;
    public  $kecamatans=null;
    public  $kecamatan;
    public  $desas=null;
    public  $desa;
    public  $provinsi_id;
    public  $kabupaten_id;
    public  $kecamatan_id;
    public  $desa_id;
    public  $pendidikans=null;
    public  $pendidikan;
    public  $pendidikan_id;
    public  $status;
    public  $asatidz_id;
    public $update_mode = false;
    public $judul;
    public $hapus_id;
    public  $cari='';

    public function mount(){
        $this->provinsis = Provinsi::All();
        $this->kabupatens = collect();
        $this->kecamatans = collect();
        $this->desas = collect();
        $this->pendidikans = Pendidikan::All();
    }

    protected $listeners = ['hapus' => 'hapus','clearCari'=>'clearCari'];

    public function clearCari()
    {                            
        $this->cari="";        
    }
    
    public function render()
    {
        sleep(1);
        $asatidzs = Asatidz::with(['provinsi','kabupaten','kecamatan','pendidikan','desa'])->search('namalengkap',$this->cari)->orderBy('namalengkap','ASC')->paginate(10);
        //dd($asatidzs);
        return view('livewire.admin.master.asatidz.list-asatidz',['asatidzs'=>$asatidzs]);
    }

    public function updatedProvinsi($id){
        $this->provinsi_id=$id;
        $this->kabupatens=Kabupaten::where('provinsi_id',$id)->get();
        $this->kecamatans=null;
        $this->desas=null;
    }

    public function updatedKabupaten($id){
        $this->kabupaten_id=$id;
        $this->kecamatans=Kecamatan::where('kabupaten_id',$id)->get();
        $this->desas=null;
    }

    public function updatedKecamatan($id){
        $this->kecamatan_id=$id;
        $this->desas=Desa::where('kecamatan_id',$id)->get();
    }

    public function updatedDesa($id){
        $this->desa_id=$id;
    }

    public function notFound(){
        Alert::warning('Perhatian', 'Data tidak ditemukan');
        return redirect()->to(route('master.asatidz'));
    }

    public function submit()
    {
        if($this->update_mode){
            $this->validate([
                'nip' => 'required',
                'namalengkap' => 'required',
                'tmplahir' => 'required',
                'tgllahir' => 'required',
                'alamat' => 'required',
                'kelamin' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
                'status' => 'required'
            ]);
        }else{
            $this->validate([
                'nip' => 'required|unique:asatidzs',
                'namalengkap' => 'required',
                'tmplahir' => 'required',
                'tgllahir' => 'required',
                'alamat' => 'required',
                'kelamin' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
                'status' => 'required'
            ]);
        }        
        if($this->asatidz_id==""){
            $asatidz = Asatidz::create([
                'nip' => $this->nip,
                'nuptk' => $this->nuptk,
                'nik' => $this->nik,
                'namalengkap' => $this->namalengkap,
                'tmplahir' => $this->tmplahir,
                'tgllahir' => $this->tgllahir,
                'alamat' => $this->alamat,
                'provinsi_id' => $this->provinsi_id,
                'kabupaten_id' => $this->kabupaten_id,
                'kecamatan_id' => $this->kecamatan_id,
                'desa_id' => $this->desa_id,
                'pendidikan_id' => $this->pendidikan,
                'status' => $this->status
            ]);            
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/master/asatidz');
        }else{
            $asatidz = Asatidz::find($this->asatidz_id);
            $asatidz->update([
                'nip' => $this->nip,
                'nuptk' => $this->nuptk,
                'nik' => $this->nik,
                'namalengkap' => $this->namalengkap,
                'tmplahir' => $this->tmplahir,
                'tgllahir' => $this->tgllahir,
                'alamat' => $this->alamat,
                'provinsi_id' => $this->provinsi_id,
                'kabupaten_id' => $this->kabupaten_id,
                'kecamatan_id' => $this->kecamatan_id,
                'desa_id' => $this->desa_id,
                'pendidikan_id' => $this->pendidikan,
                'status' => $this->status
            ]);          
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/master/asatidz');
        }
    }

    public function edit($id)
    {        
        $asatidz = Asatidz::with(['provinsi','kabupaten','kecamatan','pendidikan','desa'])->where('id',$id)->first();
        if($asatidz){
            $this->update_mode=true;        
            //dd($asatidz->namalengkap);
            $this->judul="Update Asatidz";
            $this->asatidz_id = $id;
            $this->namalengkap = $asatidz->namalengkap;
            $this->nip = $asatidz->nip;
            $this->nuptk = $asatidz->nuptk;
            $this->nik = $asatidz->nik;
            $this->tmplahir = $asatidz->tmplahir;  
            $this->tgllahir = $asatidz->tgllahir; 
            $this->kelamin = $asatidz->kelamin;
            $this->alamat = $asatidz->alamat; 
            $this->status = $asatidz->status;
            if(!empty($asatidz->provinsi->id)){
                $this->provinsi= $asatidz->provinsi->id;
                $this->provinsi_id= $asatidz->provinsi->id;
                $this->kabupatens=Kabupaten::where('provinsi_id',$asatidz->provinsi->id)->get();
            }
            if(!empty($asatidz->kabupaten->id)){
                $this->kabupaten= $asatidz->kabupaten->id;
                $this->kabupaten_id = $asatidz->kabupaten->id;
                $this->kecamatans=Kecamatan::where('kabupaten_id',$asatidz->kabupaten->id)->get(); 
            } 
            if(!empty($asatidz->kecamatan->id)){
                $this->kecamatan= $asatidz->kecamatan->id;
                $this->kecamatan_id= $asatidz->kecamatan->id;
                $this->desas=Desa::where('kecamatan_id',$asatidz->kecamatan->id)->get();
            } 
            if(!empty($asatidz->desa->id)){
                $this->desa= $asatidz->desa->id; 
                $this->desa_id= $asatidz->desa->id; 
            }
            if(!empty($asatidz->pendidikan->id)){
                $this->pendidikan= $asatidz->pendidikan->id; 
                $this->pendidikan_id= $asatidz->pendidikan->id;
            } 
        }else{
            $this->notFound();
        }
                   
    }

    public function add()
    {        
        $this->update_mode=false;
        $this->judul="Tambah Asatidz";
        $this->asatidz_id = "";
        $this->namalengkap = "";
        $this->nip = "";
        $this->nuptk = "";
        $this->nik = "";
        $this->tmplahir = "";  
        $this->tgllahir = ""; 
        $this->kelamin = "";
        $this->alamat = ""; 
        $this->status = ""; 
        $this->provinsi="";
        $this->provinsi_id="";
        $this->kabupatens=null;
        $this->kabupaten="";
        $this->kabupaten_id ="";
        $this->kecamatans=null;        
        $this->kecamatan="";
        $this->kecamatan_id="";
        $this->desas=null; 
        $this->desa=""; 
        $this->desa_id="";   
    }

    public function confirmHapus($id)
    {  
        $cek=Asatidz::where('id',$id)->first();
        if($cek){
            $this->hapus_id = $id;
        }else{
            $this->notFound();
        }     
    }

    public function hapus()
    {               
        Asatidz::where('id',$this->hapus_id)->delete();           
        $this->hapus_id="";        
        Alert::success('Hapus data', 'Berhasil menghapus data');
        return redirect()->to('/master/asatidz');
        
    }

    
}
