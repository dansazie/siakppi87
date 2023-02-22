<div>
    <x-loading-indicator></x-loading-indicator>    
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Asatidz') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Asatidz</a>
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>List Asatidz</h4>
                    <div class="card-header-form">
                        <div class="card-header-action">
                            <div class="row">
                                <div class="col col-md-6 flex justify-right">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="cari Asatidz ..." name="cari" wire:model="cari" id="cari">
                                        <div class="input-group-btn">
                                            <button type="button"  onclick="Livewire.emit('clearCari')"  class="btn btn-primary"><i class="fa fa-times-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="btn-group">                            
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add" wire:click="add()"><i class="fa fa-plus-circle"></i> Tambah</button>
                                        <a href="{{ route('master.asatidz.import') }}" class="btn btn-primary" > Import <i class="fa fa-plus-circle"></i></a>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                    </div>
                </div>
                <div class="card-body">                  
                    
                    
                    <div class="table-responsive" >
                        <table id="tbl_pengguna" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>    
                                    <th>Nama Lengkap</th>
                                    <th>Tempat, <br>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Pendidikan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($asatidzs as $key=> $row)
                                <tr>
                                    <td ><img alt="image" src="{{((empty($row->photo) ? asset('theme/img/avatar/avatar-1.png') : asset('storage/'.$row->photo)))}}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="Wildan Ahdian">
                                    </td>
                                    <td nowrap><a href="{{'/master/asatidz/profil/'.$row->nip}}">{{$row->namalengkap}}</a></td>
                                    <td>{{$row->tmplahir.', '}}<br>{{  \Carbon\Carbon::createFromFormat('Y-m-d', $row->tgllahir)->isoFormat('D MMMM Y')}}</td>
                                    <td>{{(($row->kelamin=='L') ? 'Laki-laki' : 'Perempuan')}}</td>                                    
                                    <td>{{((!empty($row->pendidikan->jenjang)) ? $row->pendidikan->jenjang : "")}}</td>
                                    <td>
                                        <label class="badge {{(($row->status=='Aktif') ? 'badge-success' : 'badge-warning')}}">{{$row->status}}</label>
                                    </td>
                                    <td>
                                        <div class="row button-group">
                                            <button type="button" data-toggle="modal" data-target="#modal-add" wire:click="edit({{ $row->id }})" class="btn btn-info btn-sm mr-1"><i class="fa fa-pen-square"></i></button><button type="button" data-toggle="modal" data-target="#modal-delete" wire:click="confirmHapus({{ $row->id }})"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            
                                        </div>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">                      
                        {{ $asatidzs->links() }}
                    </nav>
                </div>
            </div> 
        </div>
    </section> 

        <!-- modal -->  
        <div wire:ignore.self class="modal fade" role="dialog" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
            <div class="modal-dialog modal-lg"  role="document" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="judul-modal">{{$judul}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" wire:model="nip" class="form-control" id="nip" placeholder="No. induk" {{(($update_mode) ? "readonly":"")}}>
                                    @error('nip') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="nuptk">NUPTK</label>
                                    <input type="text" name="nuptk" wire:model="nuptk" class="form-control" id="nuptk" placeholder="NUPTK">
                                    @error('nuptk') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" wire:model="nik" class="form-control" id="namalengkap" placeholder="No. KTP/Passport">
                                    @error('nik') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-8">
                                    <label for="namalengkap">Nama Lengkap</label>
                                    <input type="text" name="namalengkap" wire:model="namalengkap" class="form-control" id="namalengkap" placeholder="nama Lengkap Asatidz">
                                    @error('namalengkap') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>                                                                
                            </div>                             
                            <div class="row form-group">
                                <div class="col-md-4">
                                    <label for="tmplahir">Tempat Lahir</label>
                                    <input type="text" name="tmplahir" wire:model="tmplahir" class="form-control" id="tmplahir" placeholder="Kota kelahiran">
                                    @error('tmplahir') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="tgllahir">Tanggal Lahir</label>
                                    <input type="date" name="tgllahir" wire:model="tgllahir" class="form-control" id="tgllahir">
                                    @error('tgllahir') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="kelamin">Jenis Kelamin</label>
                                    <select name="kelamin" wire:model="kelamin" class="form-control">
                                        <option value=''>pilih</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    @error('kelamin') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>   
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" wire:model="alamat" class="form-control"></textarea>
                                 @error('alamat') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>  
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="provinsi">Provinsi</label>
                                    <select name="provinsi" wire:model="provinsi" class="form-control">
                                        <option value=''>pilih provinsi</option>
                                        @foreach($provinsis as $provinsi)
                                            <option value="{{ $provinsi->id }}">{{ $provinsi->namaprovinsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="kabupaten">Kabupaten</label>
                                    <select name="kabupaten" wire:model="kabupaten" class="form-control">
                                        <option value=''>pilih kabupaten</option>
                                        @if(!is_null($kabupatens))
                                            @foreach($kabupatens as $kabupaten)
                                                <option value="{{ $kabupaten->id }}">{{ $kabupaten->namakabupaten }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kabupaten') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>                               
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select name="kecamatan" wire:model="kecamatan" class="form-control">
                                        <option value=''>pilih kecamatan</option>
                                        @if(!is_null($kecamatans))
                                            @foreach($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->namakecamatan }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('kecamatan') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="desa">Desa/Kelurahan</label>
                                    <select name="desa" wire:model="desa" class="form-control">
                                        <option value=''>pilih desa/kelurahan</option>
                                        @if(!is_null($desas))
                                            @foreach($desas as $desa)
                                                <option value="{{ $desa->id }}">{{ $desa->namadesa }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('desa') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>                               
                            </div>
                            <div class=" row form-group">
                                <div class="col-md-6">
                                    <label for="pendidikan">Pendidikan</label>
                                    <select name="pendidikan" wire:model="pendidikan" class="form-control">
                                        <option value=''>pendidikan terakhir</option>
                                        @foreach($pendidikans as $pendidikan)
                                            <option value="{{ $pendidikan->id }}">{{ $pendidikan->jenjang }}</option>
                                        @endforeach
                                    </select>
                                    @error('pendidikan') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <select name="status" wire:model="status" class="form-control">
                                        <option value=''>pilih status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                    @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>                                
                            </div>               
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="asatidz_id" wire:model="asatidz_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
            </div>   

        </div>

        <!--modal delete -->
        <div wire:ignore.self class="modal fade" role="dialog" id="modal-delete" aria-hidden="true" aria-labelledby="exampleModalLabel" >
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Anda yakin?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>                    
                    <div class="modal-body">
                        Data yang telah dihapus tidak dapat dikembalikan!                        
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="Livewire.emit('hapus')" class="btn btn-danger btn-shadow" >Ya</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
<div>
