<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Mata Pelajaran') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Mata Pelajaran</a>
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Data Mata Pelajaran</h4>
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
                        <table id="tbl_tingkat" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($mapels as $key=> $row)
                                <tr>
                                    <td>{{$row->kodemapel}}</td>
                                    <th>{{$row->mapel}}</th>
                                    <td nowrap>{{$row->jurusan->jurusan}}</td>
                                    <th>{{$row->status}}</th>
                                    <td nowrap>
                                        <button type="button" data-toggle="modal" data-target="#modal-add" wire:click="edit({{ $row->id }})" class="btn btn-info btn-sm"><i class="fa fa-pen-square"></i> Edit</button>
                                        <button type="button" data-toggle="modal" data-target="#modal-delete" wire:click="confirmHapus({{ $row->id }})"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @endforeach                          
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">                      
                        {{ $mapels->links() }}
                    </nav>
                  </div>
            </div> 
        </div>
    </section> 

        <!-- modal -->  
        <div wire:ignore.self class="modal fade" role="dialog" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judul-modal">{{$judul}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="kodemapel">Kode Mapel</label>
                                <input type="text" name="kodemapel" wire:model="kodemapel" class="form-control" id="kodemapel" {{(($update_mode) ? "readonly":"")}}>
                                @error('kodemapel') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>   
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <input type="text" name="mapel" wire:model="mapel" class="form-control" id="mapel">
                                @error('mapel') <span class="text-danger">{{ $message }}</span>@enderror
                            </div> 
                            <div class="form-group">
                                <label for="satuan">Jurusan</label>
                                <select wire:model="jurusan" name="jurusan" class="form-control" id="jurusan">
                                    <option value="">pilih jurusan</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{$jurusan->id}}">{{$jurusan->jurusan}}</option>
                                        @endforeach
                                </select>
                                @error('jurusan') <span class="text-danger">{{ $message }}</span>@enderror
                            </div> 
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select wire:model="status" name="status" class="form-control" id="status">
                                    <option value="">pilih status</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                                @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>                
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="mapel_id" wire:model="mapel_id">
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
</div>
