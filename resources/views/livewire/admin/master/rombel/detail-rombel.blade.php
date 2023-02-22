<div>
<x-loading-indicator></x-loading-indicator> 
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Detail Rombongan Belajar') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('master.rombel') }}">Rombel </a><div class="bullet"></div> Detail
                </div>                                              
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-6">
                            <div class="form-group ">
                                Rombel
                                <input type="text" name="rombel" class="form-control"
                                    wire:model="rombel" readonly>
                            </div>
                            <div class="form-group">
                                Wali Kelas
                                <input type="text" name="walikelas" class="form-control"
                                    wire:model="walikelas" readonly>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="form-group ">
                                Tingkat
                                <input type="text" name="tingkat" class="form-control"
                                    wire:model="tingkat" readonly>
                            </div>
                            <div class="form-group">
                                Tahun Akademik
                                <input type="text" name="tahunakademik" class="form-control"
                                    wire:model="tahunakademik" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4> Daftar Santri </h4>
                            <div class="card-header-form">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add" onclick="Livewire.emit('showData')"><i class="fa fa-plus-circle"></i> Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered" id="tbl_santri">
                                <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    <th>NIS</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($santris as $index => $row)
                                    <tr>
                                        <td>{{$row['namasantri']}}</td>
                                        <td>{{$row['nis']}}</td>
                                        <td>
                                            <a href="#" wire:click.prevent="removeSantri({{$index}})">Hapus</a>
                                        </td>
                                    </tr>                                   
                                @endforeach
                                </tbody>
                            </table> 
                        </div>
                        <div class="card-footer ">
                                <button type="button" class="btn btn-primary" wire:click.prevent="simpan">Simpan</button>
                        </div>
                    </div>
                    <br />
                </div>
            </div> 
        </div>
    </section>

        <!-- modal -->  
        <div wire:ignore.self class="modal fade" role="dialog" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judul-modal">Data Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="list_santri" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama Santri</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datasantris as $key=>$row)
                                    <tr>
                                        <td>{{$row['nis']}}</td>
                                        <td>{{$row['namalengkap']}}</td>
                                        <td> @csrf <button type="button" wire:click="addSantri({{ $key }})" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambahkan</button> </td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>               
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
            </div>   

        </div>

</div>  
