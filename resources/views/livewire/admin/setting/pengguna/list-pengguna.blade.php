<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Pengguna') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Pengguna</a>
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>List Pengguna</h4>
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
                        <table id="tbl_pengguna" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>email</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($users as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>@if(!empty($row->getRoleNames()))
                                            @foreach($row->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>                                    
                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#modal-add" wire:click="edit({{ $row->id }})" class="btn btn-info btn-sm"><i class="fa fa-pen-square"></i> Edit</button>
                                        <button data-toggle="modal" data-target="#modal-delete" wire:click="confirmHapus({{ $row->id }})" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @endforeach                          
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
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
                    @csrf
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="asatidz_id">Nama Asatidz</label>
                                <select name="asatidz_id" wire:model="asatidz_id" class="form-control">
                                        <option value=''>pilih asatidz</option>
                                        @foreach($asatidzs as $asatidz)
                                            <option value="{{ $asatidz->id }}">{{ $asatidz->namalengkap }}</option>
                                        @endforeach
                                </select>
                                @error('asatidz_id') <span class="text-danger">{{ $message }}</span>@enderror                                
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" wire:model="email" name="email" class="form-control" id="email" placeholder="email pengguna">
                                @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>  
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" wire:model="password" name="password" class="form-control" id="password" placeholder="password pengguna">
                                @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>     
                            <div class="form-group">
                                <label for="role">Level</label>
                                <select name="role" wire:model="role" class="form-control">
                                    <option value=''>pilih level</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>              
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="user_id" wire:model="user_id">
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
