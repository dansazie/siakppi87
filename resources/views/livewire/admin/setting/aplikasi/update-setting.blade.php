<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Pengaturan Aplikasi') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('setting.aplikasi')}}">Setting</a>->Aplikasi
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">                
                <div class="col-12 col-md-12">
                    <div class="card">
                    <form wire:submit.prevent="submit">
                        <div class="card-header">
                            <h4>Pengaturan Aplikasi</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col col-md-7">
                                    <div class="col mb-2 text-center">
                                        <img alt="image" src="{{((empty($logo) ? asset('theme/img/avatar/avatar-1.png') : asset('storage/'.$logo)))}}" class="mr-3 rounded" width="90">
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <label for="nama_aplikasi">Nama Aplikasi</label>
                                        <input type="text" name="nama_aplikasi" wire:model="nama_aplikasi" class="form-control" id="nama_aplikasi">
                                        @error('nama_aplikasi') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>       
                                    <div class="form-group col-md-12 col-12">
                                        <label for="site_title">Site Title</label>
                                        <input type="text" name="site_title" wire:model="site_title" class="form-control" id="site_title">
                                        @error('site_title') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>  
                                    <div class="form-group col-md-12 col-12">
                                        <label for="teks_footer">Teks Footer</label>
                                        <input type="text" name="teks_footer" wire:model="teks_footer" class="form-control" id="teks_footer">
                                        @error('teks_footer') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col col-md-5">  
                                    <div class="form-group col-md-12 col-12">
                                        <label for="file">Logo</label>
                                            <div class="custom-file">
                                                <input type="file" name="file" wire:model="file" id="file" class="custom-file-input" id="site-favicon">
                                                <label class="custom-file-label">upload file</label>
                                            </div>
                                        @error('file') <span class="text-danger">{{ $message }}</span>@enderror                                        
                                    </div>       
                                    <div class="form-group col-md-12 col-12">
                                        <label for="email_admin">Email Admin</label>
                                        <input type="email_admin" name="email_admin" wire:model="email_admin" class="form-control" id="email" >
                                        @error('email_admin') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div> 
                                    <div class="form-group col-md-12 col-12">
                                        <label for="tahunakademik">Tahun Akademik</label>
                                        <input type="text" name="tahunakademik" wire:model="tahunakademik" class="form-control" id="tahunakademik" >
                                        @error('tahunakademik') <span class="text-danger">{{ $message }}</span>@enderror                                       
                                    </div>
                                    <div class="form-group col-md-12 col-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="tglmulai">Tanggal Mulai</label>
                                                <input type="date" name="tglmulai" wire:model="tglmulai" class="form-control" id="tglmulai" >
                                                @error('tglmulai') <span class="text-danger">{{ $message }}</span>@enderror                                       
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tglakhir">Tanggal Akhir</label>
                                                <input type="date" name="tglakhir" wire:model="tglakhir" class="form-control" id="tglakhir" >
                                                @error('tglakhir') <span class="text-danger">{{ $message }}</span>@enderror                                       
                                            </div>
                                        </div>                                       
                                    </div>                                    
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col col-md-12">
                                    <div class="col col-md-12 center">
                                            <input type="hidden" name="setting_id" wire:model="setting_id">
                                            <input type="hidden" name="tahunakademik_id" wire:model="tahunakademik_id">                            
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <label class="custom-switch">
                                                <input type="checkbox" name="mode_sidebar" wire:model="mode_sidebar"class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Tampilan sidebar mode : <b>mini</b> ?</span>
                                            </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>
