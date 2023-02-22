<?php

namespace App\Http\Livewire\Admin\Setting\Aplikasi;

use Livewire\Component;
use App\Models\Setting;
use App\Models\TahunAkademiks;
use Livewire\WithFileUploads;
use Alert;
use DB;

class UpdateSetting extends Component
{
    use WithFileUploads;
    public $file;

    public $setting_id;
    public $nama_aplikasi;
    public $site_title;
    public $mode_sidebar=false;
    public $email_admin;
    public $teks_footer;
    public $logo;
    public $tahunakademik;
    public $tglmulai;
    public $tglakhir;
    public $tahunakademik_id;

    public function mount(){
        $setting=Setting::first();
        if(!empty($setting)){
            $this->setting_id=$setting->id;
            $this->nama_aplikasi=$setting->nama_aplikasi;
            $this->site_title=$setting->site_title;            
            $this->email_admin=$setting->email_admin;
            $this->teks_footer=$setting->teks_footer;
            $this->logo=$setting->logo;
            if($setting->mode_sidebar==0){
                $this->mode_sidebar=false;
            }else{
                $this->mode_sidebar=true;
            }
        }
        $tahunakademik=TahunAkademiks::where('status','Aktif')->first();
        if(!empty($tahunakademik)){
            $this->tahunakademik_id=$tahunakademik->id;
            $this->tahunakademik=$tahunakademik->tahunakademik;
            $this->tglmulai=$tahunakademik->tglmulai;
            $this->tglakhir=$tahunakademik->tglakhir;
        }
    }

    public function render()
    {
        
        return view('livewire.admin.setting.aplikasi.update-setting');
    }

    public function submit()
    {
        if($this->file!=""){
            $this->validate([
                'email_admin' => 'email',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                'tahunakademik' => 'required',
                'tglmulai' => 'required|date',
                'tglakhir' => 'required|date'
            ]);
        }else{
            $this->validate([
                'email_admin' => 'email',
                'tahunakademik' => 'required',
                'tglmulai' => 'required|date',
                'tglakhir' => 'required|date'
            ]);
        } 
        
        $this->addAkademik();

        if($this->setting_id==""){
            $setting = Setting::create([
                'nama_aplikasi' => $this->nama_aplikasi,
                'site_title' => $this->site_title,
                'mode_sidebar' => $this->mode_sidebar,
                'email_admin' => $this->email_admin,
                'teks_footer' => $this->teks_footer
            ]);
            if($this->file!=""){
                $setting->update([
                    'logo' => $this->file->store('logos', 'public')
                ]);
            }
            Alert::success('Pengaturan Aplikasi', 'Pengaturan berhasil dibuat');
            return redirect()->to('/setting/aplikasi');
        }else{
            $setting = Setting::find($this->setting_id);
            $setting->update([
                'nama_aplikasi' => $this->nama_aplikasi,
                'site_title' => $this->site_title,
                'mode_sidebar' => $this->mode_sidebar,
                'email_admin' => $this->email_admin,
                'teks_footer' => $this->teks_footer
            ]);  
            if($this->file!=""){
                $setting->update([
                    'logo' => $this->file->store('logos', 'public')
                ]);
            }         
            Alert::success('Pengaturan Aplikasi', 'Pengaturan berhasil dibuat');
            return redirect()->to('/setting/aplikasi');
        }
    }

    private function addAkademik(){
        
        if(!empty($this->tahunakademik_id)){
            $tahunakademik = TahunAkademiks::where('tahunakademik', $this->tahunakademik)->first();            
            if($tahunakademik){ 
                $this->editAkademik($tahunakademik->id);
                $ta = DB::table('tahunakademiks')
                    ->whereNotIn('id',[$tahunakademik->id])
                    ->get();
                foreach($ta as $a){
                    DB::table('tahunakademiks')
                    ->where('id', $a->id)
                    ->update(['status' => 'Non-Aktif']);
                }
            }else{
                $ta = DB::table('tahunakademiks')->get();
                foreach($ta as $a){
                    DB::table('tahunakademiks')
                    ->where('id', $a->id)
                    ->update(['status' => 'Non-Aktif']);
                }                
                TahunAkademiks::create([
                    'tahunakademik' => $this->tahunakademik,
                    'tglmulai' => $this->tglmulai,
                    'tglakhir' => $this->tglakhir,
                    'status' => 'Aktif'
                ]);
            }            
        }else{
            TahunAkademiks::create([
                'tahunakademik' => $this->tahunakademik,
                'tglmulai' => $this->tglmulai,
                'tglakhir' => $this->tglakhir,
                'status' => 'Aktif'
            ]);
        }
    }

    private function editAkademik($id){
        $tahunakademik = TahunAkademiks::where('id', $id)->first();          
        $tahunakademik->update([
                'tahunakademik' => $this->tahunakademik,
                'tglmulai' => $this->tglmulai,
                'tglakhir' => $this->tglakhir,
                'status' => 'Aktif'
        ]);  
        
    }
}
