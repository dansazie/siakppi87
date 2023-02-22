<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Satuan') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Satuan</a>
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
                    <h4>Data Satuan</h4>
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
                                    <th></th>
                                    <th>Satuan</th>
                                    <th>NPSN</th>
                                    <th>NSM</th>
                                    <th>Mudir/Kepala</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($satuans as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <th>{{$row->logo}}</th>
                                    <td nowrap>{{$row->satuan}}</td>
                                    <td>{{$row->npsn}}</td>
                                    <td>{{$row->nsm}}</td>
                                    <td nowrap>
                                        @if(!is_null($row->mudir))
                                            {{$row->mudir->namalengkap}}
                                        @endif                                    
                                    </td>
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
                        {{ $satuans->links() }}
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
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" wire:model="satuan" class="form-control" id="satuan">
                                @error('satuan') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="npsn">NPSN</label>
                                <input type="text" name="npsn" wire:model="npsn" class="form-control" id="npsn">
                                @error('npsn') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group">
                                <label for="nsm">NSM</label>
                                <input type="text" name="nsm" wire:model="nsm" class="form-control" id="nsm">
                                @error('nsm') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="mudir">Mudir/Kepala</label>
                                <select wire:model="mudir" name="mudir" class="form-control" id="mudir">
                                    <option value="">pilih mudir</option>
                                    @foreach($asatidzs as $asatidz)
                                        <option value="{{$asatidz->id}}">{{$asatidz->namalengkap}}</option>
                                    @endforeach
                                </select>
                                @error('mudir') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>                 
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="satuan_id" wire:model="satuan_id">
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
</div>
