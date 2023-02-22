<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Pendidikan') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pendidikan</a>
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
                    <h4>List Pendidikan</h4>
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
                        <table id="tbl_pendidikan" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenjang</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($pendidikan as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->jenjang}}</td>
                                    <td>{{$row->deskripsi}}</td>
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#modal-add" wire:click="edit({{ $row->id }})" class="btn btn-info btn-sm"><i class="fa fa-pen-square"></i> Edit</button>
                                        <button wire:click="delete({{ $row->id }})" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @endforeach                          
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">                      
                        {{ $pendidikan->links() }}
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
                        <h5 class="modal-title" id="judul-modal">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="jenjang">Jenjang</label>
                                <input type="text" name="jenjang" wire:model="jenjang" class="form-control" id="jenjang" placeholder="Jenjang Pendidikan">
                                @error('jenjang') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" wire:model="deskripsi" name="deskripsi" class="form-control" id="deskripsi" placeholder="Tulis keterangan jenjang">
                                @error('deskripsi') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>                    
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="pendidikan_id" wire:model="pendidikan_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
            </div>   
</div>
