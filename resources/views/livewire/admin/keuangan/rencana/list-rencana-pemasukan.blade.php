
<div>
    
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Rencana Pemasukan') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Pemasukan</a>
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
                        <h4>Data Rencana Pemasukan</h4>
                        <div class="card-header-form">
                            <div class="input-group">
                              <div class="input-group-btn">
                                <button class="btn btn-primary" wire:click="add()"><i class="fa fa-plus-circle"></i> Tambah</button>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="frmPemasukan" wire:ignore class="card card-body col-md-12">
                            <form wire:submit.prevent="submit" class="form-horizontal">
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" name="kode" wire:model.defer="kode" class="form-control" id="kode" {{(($update_mode) ? "readonly":"")}}>
                                            @error('kode') <span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="namapemasukan">Nama Pemasukan</label>
                                            <input type="text" name="namapemasukan" wire:model.defer="namapemasukan" class="form-control" id="namapemasukan">
                                            @error('namapemasukan') <span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-6">
                                    <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col col-md-6">
                                                        <div class="form-group " style="align-items:left;">
                                                            <label for="pemasukansantri">Jenis Pemasukan</label> <br>
                                                            <input type="checkbox" wire:click="checkpemasukansantri" name="pemasukansantri" wire:model.defer="pemasukansantri" class="">
                                                            <span>Pemasukan <b>Santri</b> ?</span>
                                                        </div>
                                                    </div>
                                                    <div class="col col-md-6" id="divTingkat" wire:ignore>
                                                            <div class="form-group" >
                                                                <select class="selectpicker form-control " name="pilihtingkat" id='pilihtingkat' wire:model.defer="pilihtingkat"  multiple data-style="btn-info" data-selected-text-format="count">
                                                                    @foreach($alltingkats as $key=>$row)
                                                                        <option  value={{$row->id}}>{{ $row->tingkat}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                    </div>
                                                </div>

                                    </div>

                                </div>
                                <div class="col col-md-6">
                                    <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col col-md-12">
                                                        <div class="form-group">
                                                            <label for="nominal">Nominal</label>
                                                            <input type="text" name="nominal" wire:model.defer="nominal" class="form-control" id="nominal">
                                                            @error('nominal') <span class="text-danger">{{ $message }}</span>@enderror
                                                        </div>
                                                    </div>

                                                <!--<div class="col col-md-6 " style="align-items:center;">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select wire:model.defer="status" name="status" class="form-control" id="status">
                                                                <option value="">pilih status</option>
                                                                <option value="Aktif">Aktif</option>
                                                                <option value="Non-Aktif">Non-Aktif</option>
                                                            </select>
                                                            @error('status') <span class="text-danger">{{ $message }}</span>@enderror
                                                        </div>
                                                    </div>-->
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-whitesmoke br">
                                <input type="hidden" name="pemasukan_id" wire:model="pemasukan_id">
                                <button type="button" class="btn btn-secondary" wire:click="clearForm()">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                        <div class="table-responsive">

                            <table id="tbl_pemasukan" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Pemasukan</th>
                                        <th>Nominal</th>
                                        <th>Pemasukan <br> Santri?</th>
                                        <th>Tingkat</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemasukans as $key=> $row)
                                    <tr>
                                        <td>{{$row->kode}}</td>
                                        <th>{{$row->namapemasukan}}</th>
                                        <td nowrap>Rp. {{$row->nominal}}</td>
                                        <td>{{(($row->is_pemasukansantri==1)? 'Ya' : 'Bukan')}}</td>
                                        <td style="text-align:justify;vertical-align:justify;" >@foreach ($row->tingkats as $tingkats )
                                            <label class="badge badge-primary">{{$tingkats->tingkat}}</label>
                                        @endforeach</td>
                                        <td nowrap>{{$row->tahunAkademik->tahunakademik}}</td>
                                        <td><label class="badge {{(($row->status=='Aktif') ? 'badge-success' : 'badge-warning')}}">{{$row->status}}</label></td>
                                        <td nowrap>
                                            @hasrole('Admin')
                                            <button type="button" wire:click="{!!(($row->status=='Non-Aktif')? 'lock('.$row->id.')' : 'unlock('. $row->id.')')!!}" class="btn btn-warning btn-sm mr-2"><i class="fa {!!(($row->status=='Aktif')? 'fa-lock' : 'fa-unlock' )!!} "></i> </button>
                                            @endhasrole
                                            <button type="button" data-toggle="modal" data-target="#modal-add" wire:click="edit({{ $row->id }})" class="btn btn-info btn-sm mr-2" {!!(($row->status=="Aktif")? "disabled" : "" )!!}><i class="fa fa-pen-square"></i> </button>
                                            <button type="button" data-toggle="modal" data-target="#modal-delete" wire:click="confirmHapus({{ $row->id }})"  class="btn btn-danger btn-sm" {!!(($row->status=="Aktif")? "disabled" : "" )!!}><i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                    </div>
                </div>
            </div>
        </section>


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

    @push('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('#frmPemasukan').hide();
            $('#divTingkat').hide();

            Livewire.on('pemasukansantri', () => {
                if($('input[type="checkbox"]').prop("checked") == true){
                    $('#divTingkat').show();
                    $(".selectpicker").selectpicker("refresh");
                } else if($('input[type="checkbox"]').prop("checked") == false) {
                    $('#divTingkat').hide();
                }
            });

            Livewire.on('showform', () => {
                $('#frmPemasukan').show();
            });

            Livewire.on('hideform', () => {
                $('#frmPemasukan').hide();
            });

            $('input[type="checkbox"]').click(function() {
                if($(this).prop("checked") == true){
                    $('#divTingkat').show();
                    $(".selectpicker").selectpicker("refresh");
                } else if($(this).prop("checked") == false) {
                    $('#divTingkat').hide();
                }
            });
        });
    </script>
    @endpush

