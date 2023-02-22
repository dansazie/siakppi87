<?php

namespace App\Http\Livewire\Admin\Master\Santri;
use App\Models\Santri;
use App\Models\Tingkat;
use App\Models\Rombel;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use Alert;
use Livewire\WithPagination;

use Livewire\Component;

class ListSantri extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public  $cari='';

    public  $nis;
    public  $nik;
    public  $nisn;
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
    public  $tingkats=null;
    public  $tingkat;
    public  $tingkat_id;
    public  $rombels;
    public  $rombel;
    public  $rombel_id;
    public  $status;
    public  $santri_id;
    public $update_mode = false;
    public $judul;
    public $hapus_id;

    public function mount(){
        $this->provinsis = Provinsi::All();
        $this->kabupatens = collect();
        $this->kecamatans = collect();
        $this->desas = collect();
        $this->tingkats = Tingkat::All();
    }

    public function render()
    {
        sleep(1);
        $data['santris'] = Santri::with(['provinsi','kabupaten','kecamatan','tingkat','desa','rombels'])->search('namalengkap',$this->cari)->orderBy('tingkat_id','ASC')->paginate(15);
        //dd($data['santris']);
        return view('livewire.admin.master.santri.list-santri',$data);
    }

    public function edit($id)
    {        
        $this->update_mode=true;
        $santri = Santri::with(['provinsi','kabupaten','kecamatan','desa','tingkat'])->where('id',$id)->first();
        //dd($santri->namalengkap);
        $this->judul="Update Santri";
        $this->santri_id = $id;
        $this->namalengkap = $santri->namalengkap;
        $this->nis = $santri->nis;
        $this->nisn = $santri->nisn;
        $this->nik = $santri->nik;
        $this->tmplahir = $santri->tmplahir;  
        $this->tgllahir = $santri->tgllahir; 
        $this->kelamin = $santri->kelamin;
        $this->alamat = $santri->alamat; 
        $this->status = $santri->status;
        if(!empty($santri->provinsi->id)){
            $this->provinsi= $santri->provinsi->id;
            $this->provinsi_id= $santri->provinsi->id;
            $this->kabupatens=Kabupaten::where('provinsi_id',$santri->provinsi->id)->get();
        }
        if(!empty($santri->kabupaten->id)){
            $this->kabupaten= $santri->kabupaten->id;
            $this->kabupaten_id = $santri->kabupaten->id;
            $this->kecamatans=Kecamatan::where('kabupaten_id',$santri->kabupaten->id)->get(); 
        } 
        if(!empty($santri->kecamatan->id)){
            $this->kecamatan= $santri->kecamatan->id;
            $this->kecamatan_id= $santri->kecamatan->id;
            $this->desas=Desa::where('kecamatan_id',$santri->kecamatan->id)->get();
        } 
        if(!empty($santri->desa->id)){
            $this->desa= $santri->desa->id; 
            $this->desa_id= $santri->desa->id; 
        }
        if(!empty($santri->tingkat->id)){
            $this->tingkat= $santri->tingkat->id; 
            $this->tingkat_id= $santri->tingkat->id;
        }            
    }

    public function submit()
    {
        if($this->update_mode){
            $this->validate([
                'nis' => 'required',
                'namalengkap' => 'required',
                'tmplahir' => 'required',
                'tgllahir' => 'required',
                'alamat' => 'required',
                'kelamin' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
                'tingkat' => 'required',
                'status' => 'required'
            ]);
        }else{
            $this->validate([
                'nis' => 'required|unique:santris',
                'namalengkap' => 'required',
                'tmplahir' => 'required',
                'tgllahir' => 'required',
                'alamat' => 'required',
                'kelamin' => 'required',
                'provinsi' => 'required',
                'kabupaten' => 'required',
                'kecamatan' => 'required',
                'desa' => 'required',
                'tingkat' => 'required',
                'status' => 'required'
            ]);
        }        
        if($this->santri_id==""){
            $santri = Santri::create([
                'nip' => $this->nip,
                'nisn' => $this->nisn,
                'nik' => $this->nik,
                'namalengkap' => $this->namalengkap,
                'tmplahir' => $this->tmplahir,
                'tgllahir' => $this->tgllahir,
                'alamat' => $this->alamat,
                'provinsi_id' => $this->provinsi_id,
                'kabupaten_id' => $this->kabupaten_id,
                'kecamatan_id' => $this->kecamatan_id,
                'desa_id' => $this->desa_id,
                'tingkat_id' => $this->tingkat,
                'status' => $this->status
            ]);            
            Alert::success('Tambah data', 'Berhasil tambah data');
            return redirect()->to('/master/santri');
        }else{
            $santri = Santri::find($this->santri_id);
            $santri->update([
                'nis' => $this->nis,
                'nisn' => $this->nisn,
                'nik' => $this->nik,
                'namalengkap' => $this->namalengkap,
                'tmplahir' => $this->tmplahir,
                'tgllahir' => $this->tgllahir,
                'alamat' => $this->alamat,
                'provinsi_id' => $this->provinsi_id,
                'kabupaten_id' => $this->kabupaten_id,
                'kecamatan_id' => $this->kecamatan_id,
                'desa_id' => $this->desa_id,
                'tingkat_id' => $this->tingkat,
                'status' => $this->status
            ]);          
            Alert::success('Ubah data', 'Berhasil merubah data');
            return redirect()->to('/master/santri');
        }
    }

    public function add()
    {        
        $this->update_mode=false;
        $this->judul="Tambah Santri";
        $this->santri_id = "";
        $this->namalengkap = "";
        $this->nis = "";
        $this->nisn = "";
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
        $this->tingkat=""; 
        $this->tingkat_id="";  
    }

    public function confirmHapus($id)
    {       
        $this->hapus_id = $id;
        //dd($this->hapus_id);
    }

    protected $listeners = ['hapus' => 'hapus','clearCari'=>'clearCari'];

    public function clearCari()
    {                            
        $this->cari="";        
    }

    public function hapus()
    {               
        Santri::where('id',$this->hapus_id)->delete();           
        $this->hapus_id="";        
        Alert::success('Hapus data', 'Berhasil menghapus data');
        return redirect()->to('/master/santri');
        
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
}
