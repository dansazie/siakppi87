<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Profil Pengguna') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('master.asatidz')}}">Asatidz</a>->Profil
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{((empty($asatidz->photo) ? asset('theme/img/avatar/avatar-1.png') : asset('storage/'.$asatidz->photo)))}}" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Jenis Kelamin</div>
                                    <div class="profile-widget-item-value">{{(($asatidz->kelamin=='L') ? 'Laki-laki' : 'Perempuan')}}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Usia</div>
                                    <div class="profile-widget-item-value">{{\Carbon\Carbon::parse($asatidz->tgllahir)->diffInYears(\Carbon\Carbon::now()).' Tahun'}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">
                                <strong>{{$asatidz->namalengkap}}</strong> 
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash">

                                    </div>
                                    {{(($asatidz->jabatan) ? $asatidz->jabatan->jabatan : '')}}
                                </div>                                
                            </div>
                            <div class="text-justify">
                            {{Str::title($asatidz->namalengkap)}} adalah seorang {{(($asatidz->kelamin=='L') ? 'Laki-laki' : 'Perempuan')}} warganegara <b>Indonesia</b>, lahir pada hari {{ \Carbon\Carbon::createFromFormat('Y-m-d', $asatidz->tgllahir)->isoFormat('dddd') }} tanggal {{ \Carbon\Carbon::createFromFormat('Y-m-d', $asatidz->tgllahir)->isoFormat('D MMMM Y') }} di Kota {{Str::title($asatidz->tmplahir)}}. <br>
                            Berdomisili di {{$asatidz->alamat}}{{((!empty($asatidz->desa->namadesa)) ? ' Desa '.Str::title($asatidz->desa->namadesa) : '')}}{{((!empty($asatidz->kecamatan->namakecamatan)) ? ' Kecamatan '.Str::title($asatidz->kecamatan->namakecamatan) : '')}}{{((!empty($asatidz->kabupaten->namakabupaten)) ? ' Kabupaten/Kota '.Str::title($asatidz->kabupaten->namakabupaten) : '')}}{{((!empty($asatidz->provinsi->namaprovinsi)) ? ' Provinsi '.Str::title($asatidz->provinsi->namaprovinsi) : '')}}. <br>
                            Mulai bertugas di Pesantren Persis 87 Pangatikan pada tanggal    hingga sekarang
                            </div>
                        </div>
                        <div class="card-footer text-center">     

                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                    <form wire:submit.prevent="submit">
                        <div class="card-header">
                            <h4>{{$judul}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label for="name">Nama Pengguna</label>
                                    <input type="text" name="name" wire:model="name" class="form-control" id="name" readonly>
                                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>                            
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" wire:model="email" class="form-control" id="email" required>
                                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" wire:model="password" class="form-control" id="password">
                                    @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label for="file">Photo</label>
                                    <input type="file" name="file" wire:model="file" class="form-control" id="file">
                                    @error('file') <span class="text-danger">{{ $message }}</span>@enderror
                                </div> 
                            </div>
                        </div>
                        <div class="card-footer text-right">
                        <input type="hidden" name="user_id" wire:model="user_id">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section> 
</div>
