<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Rombel') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Rombel</a>
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Rombongan Belajar</h4>
                    <div class="card-header-form">
                        <div class="input-group">
                          <div class="input-group-btn">                            
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add" wire:click="add()"><i class="fa fa-plus-circle"></i> Tambah</button>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl_rombel" class="table table-bordered table-striped">
                            <thead>
                                <tr>  
                                    <th>Rombel</th>
                                    <th>Tingkat</th>
                                    <th>Jurusan</th>
                                    <th>Wali Kelas</th>
                                    <th>Tahun</th>
                                    <th>Jumlah <br> Santri </th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($rombels as $key=> $row)
                                <tr>
                                    <td nowrap><a href="{{'/master/rombel/detail/'.$row->id}}">{{$row->rombel}}</a></td>
                                    <td>{{((!empty($row->tingkat->tingkat)) ? $row->tingkat->tingkat : "")}}</td>
                                    <td>{{((!empty($row->jurusan->jurusan)) ? $row->jurusan->jurusan : "")}}</td>                                    
                                    <td nowrap>{{((!empty($row->waliKelas->namalengkap)) ? $row->waliKelas->namalengkap : "")}}</td> 
                                    <td>{{setting('tahunakademik')}}</td> 
                                    <td nowrap>{{((!empty($row->santris_count)) ? $row->santris_count." Santri" : "Kosong")}}</td> 
                                    <td nowrap>
                                        <label class="badge {{(($row->status=='Aktif') ? 'badge-success' : 'badge-warning')}}">{{$row->status}}</label>
                                    </td>
                                    <td nowrap>
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
                        {{ $rombels->links() }}
                    </nav>
                </div>
            </div> 
        </div>
    </section> 


        <!-- modal -->  
        <div wire:ignore.self class="modal fade" role="dialog" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true"  >
            <div class="modal-dialog"  role="document" >
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
                                <div class="col-md-12">
                                    <label for="rombel">Rombel</label>
                                    <input type="text" name="rombel" wire:model="rombel" class="form-control" id="rombel" placeholder="isi dengan nama rombel aktif" {{(($update_mode) ? "readonly":"")}}>
                                    @error('rombel') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>                                
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="tingkat">Tingkat/Kelas</label>
                                    <select name="tingkat" wire:model="tingkat" class="form-control">
                                        <option value=''>pilih tingkat</option>
                                        @foreach($tingkats as $tingkat)
                                            <option value="{{ $tingkat->id }}">{{ $tingkat->tingkat }}</option>
                                        @endforeach
                                    </select>
                                    @error('tingkat') <span class="text-danger">{{ $message }}</span>@enderror 
                                </div>
                                <div class="col-md-6">
                                    <label for="jurusan">Jurusan</label>
                                    <select name="jurusan" wire:model="jurusan" class="form-control">
                                        <option value=''>pilih jurusan</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jurusan') <span class="text-danger">{{ $message }}</span>@enderror 
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-12">
                                    <label for="walikelas">Wali Kelas</label>
                                    <select name="walikelas" wire:model="walikelas" class="form-control">
                                        <option value=''>pilih wali kelas</option>
                                        @foreach($asatidzs as $walikelas)
                                            <option value="{{ $walikelas->id }}">{{ $walikelas->namalengkap }}</option>
                                        @endforeach
                                    </select>
                                    @error('walikelas') <span class="text-danger">{{ $message }}</span>@enderror 
                                </div>
                            </div> 
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="">Tahun Akademik</label>
                                    <input type="text" class="form-control" value="{{setting('tahunakademik')}}" readonly>
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
                        <input type="hidden" name="rombel_id" wire:model="rombel_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
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
