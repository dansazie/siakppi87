
<div>
    <x-loading-indicator></x-loading-indicator>
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Pemasukan Santri') }}</h1>
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
                        <h4>Data Pemasukan Santri</h4>
                        <div class="card-header-form">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="cari Santri ..." name="cari" wire:model="cari" id="cari">
                                <div class="input-group-btn">
                                    <button type="button"  onclick="Livewire.emit('clearCari')"  class="btn btn-primary"><i class="fa fa-times-circle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbl_pemasukan" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Santri</th>
                                        <th>Tingkat</th>
                                        <th>Total</th>
                                        <th>Sudah Bayar</th>
                                        <th>Belum Bayar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($santris as $key=> $row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td><a href="{{'/keuangan/pemasukan/detail/pemasukansantri/'.$row->nis}}">{{$row->namalengkap}}</a></td>
                                        <td nowrap>{{$row->tingkat->tingkat}}</td>
                                        <?php $total=0; $sudah=0; $belum=0;?>
                                        @foreach ($row->pemasukans as $pemasukan)
                                            <?php $total=$total+$pemasukan->nominal ?>
                                        @endforeach
                                        <td nowrap>Rp. {{$total}}</td>
                                        <td nowrap>Rp. {{$sudah}}</td>
                                        <?php $belum=$total-$sudah;?>
                                        <td nowrap>Rp. {{$belum}}</td>
                                        <td><label class="badge {{(($belum==0) ? 'badge-success' : 'badge-warning')}}">{{(($belum==0) ? 'Lunas' : 'Belum Lunas')}}</label></td>
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

