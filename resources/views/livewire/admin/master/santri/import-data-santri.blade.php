<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Import Data Santri') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{route('master.santri')}}">Santri</a>-><a href="#">import</a>
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Santri</h4>
                    <div class="card-header-form">
                        <div class="input-group">
                          <div class="input-group-btn">                            
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add" wire:click="add()"><i class="fa fa-plus-circle"></i> Import</button>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl_santri" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIS</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($santris as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->namalengkap}}</td>
                                    <td>{{$row->nis}}</td>
                                    <td>{{$row->tmplahir.', '.$row->tgllahir}}</td>
                                    <td>{{$row->kelamin }}</td>
                                    <td>{{Str::title($row->alamat)}}</td>
                                    <td>
                                        <label class="badge {{(($row->status=='Aktif') ? 'badge-success' : 'badge-warning')}}">{{$row->status}}</label>
                                    </td>                                    
                                </tr>
                                @endforeach                        
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">                      
                        {{ $santris->links() }}
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
                        <h5 class="modal-title" >Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group custom-file">
                            <input type="file" class="custom-file-input" wire:model="fileimport" id="fileimport" name="fileimport" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                            <label class="custom-file-label" for="fileimport">upload file</label>
                            @error('fileimport') <span class="text-danger">{{ $message }}</span>@enderror
                            <p><small class="text-info">file:.xls / .xlsx, ukuran: 1mb</small></p>                            
                        </div>  
                        <div class="form-group">                            
                            <button type="button" class="btn btn-primary">Download Template</button>
                        </div>            
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </div>

<div>
