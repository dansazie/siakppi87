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
                <form>
                    <div class="card">
                        <div class="card-header">
                           <h4> Daftar Santri </h4>
                        </div>

                        <div class="card-body">
                            <table class="table" id="tbl_santri">
                                <thead>
                                <tr>
                                    <th>Nama Santri</th>
                                    <th>NIS</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($santris as $index => $santri)
                                    <tr>
                                        <td>$santri->namalengkap</td>
                                        <td>$santri->NIS</td>
                                        <td>
                                            <a href="#" wire:click.prevent="removeSantri({{$index}})">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br />
                </div>
            </div> 
        </div>
    </section>

        <!-- modal -->  
        <div wire:ignore.self class="modal fade" role="dialog" id="modal-add" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judul-modal">Tambah Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="satuan">Nama Santri</label>
                                <select name="addsantris[{{$index}}][santri_id]"
                                        wire:model="addsantris.{{$index}}.santri_id"
                                        class="form-control">
                                    <option value="">pilih santri</option>
                                    @foreach ($allProducts as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->name }} (${{ number_format($product->price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
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

</div>  
