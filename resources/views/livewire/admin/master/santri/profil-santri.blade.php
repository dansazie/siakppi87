<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Profil Santri') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('master.santri')}}">Santri</a>->Profil
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card profile-widget">
                        <div class="profile-widget-header">
                            <img alt="image" src="{{((empty($santri->photo) ? asset('theme/img/avatar/avatar-1.png') : asset('storage/'.$santri->photo)))}}" class="rounded-circle profile-widget-picture">
                            <div class="profile-widget-items">
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Jenis Kelamin</div>
                                    <div class="profile-widget-item-value">{{(($santri->kelamin=='L') ? 'Laki-laki' : 'Perempuan')}}</div>
                                </div>                                
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Usia</div>
                                    <div class="profile-widget-item-value">{{\Carbon\Carbon::parse($santri->tgllahir)->diffInYears(\Carbon\Carbon::now()).' Tahun'}}</div>
                                </div>
                                <div class="profile-widget-item">
                                    <div class="profile-widget-item-label">Tingkat</div>
                                    <div class="profile-widget-item-value">{{$santri->tingkat->tingkat}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-widget-description">
                            <div class="profile-widget-name">
                                <strong>{{$santri->namalengkap}}</strong> 
                                <div class="text-muted d-inline font-weight-normal">
                                    <div class="slash">

                                    </div>
                                    {{((!empty($rombel->rombel)) ? $rombel->rombel : '')}}
                                </div>                                
                            </div>
                            <div class="text-justify">
                            {{Str::title($santri->namalengkap)}} adalah seorang {{(($santri->kelamin=='L') ? 'Laki-laki' : 'Perempuan')}} warganegara <b>Indonesia</b>, lahir pada hari {{ \Carbon\Carbon::createFromFormat('Y-m-d', $santri->tgllahir)->isoFormat('dddd') }} tanggal {{ \Carbon\Carbon::createFromFormat('Y-m-d', $santri->tgllahir)->isoFormat('D MMMM Y') }} di Kota {{Str::title($santri->tmplahir)}}. <br>
                            Berdomisili di {{$santri->alamat}}{{((!empty($santri->desa->namadesa)) ? ' Desa '.Str::title($santri->desa->namadesa) : '')}}{{((!empty($santri->kecamatan->namakecamatan)) ? ' Kecamatan '.Str::title($santri->kecamatan->namakecamatan) : '')}}{{((!empty($santri->kabupaten->namakabupaten)) ? ' Kabupaten/Kota '.Str::title($santri->kabupaten->namakabupaten) : '')}}{{((!empty($santri->provinsi->namaprovinsi)) ? ' Provinsi '.Str::title($santri->provinsi->namaprovinsi) : '')}}. <br>
                            Mulai sekolah di Pesantren Persis 87 Pangatikan pada tanggal    hingga sekarang
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
