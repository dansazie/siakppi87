<div>
    
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Detail Tagihan Santri') }} : <strong>{{$santri->namalengkap}}</strong></h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('master.santri')}}">Santri</a>->pemasukan
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-3">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image" src="{{((empty($santri->photo) ? asset('theme/img/avatar/avatar-1.png') : asset('storage/'.$santri->photo)))}}" class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Rombel</div>
                                        <div class="profile-widget-item-value">@if (!empty($rombel))
                                            {{$rombel->rombel}}
                                        @endif</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Tingkat</div>
                                        <div class="profile-widget-item-value">{{$santri->tingkat->tingkat}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-primary">
                            <i class="fas fa-rupiah-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Total Tagihan</h4>
                            </div>
                            <div class="card-body">
                              {{number_format($total,0,',','.')}}
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-success">
                            <i class="fas fa-rupiah-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Sudah Dibayar</h4>
                            </div>
                            <div class="card-body">
                              10
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                          <div class="card-icon bg-danger">
                            <i class="fas fa-rupiah-sign"></i>
                          </div>
                          <div class="card-wrap">
                            <div class="card-header">
                              <h4>Belum Dibayar</h4>
                            </div>
                            <div class="card-body">
                              10
                            </div>
                          </div>
                        </div>
                    </div>


                </div>
                <div class="card">
                    <div class="col-12">
                        <div class="card-header">
                            <h4>Tagihan Santri</h4>
                            <div class="card-header-form">
                                <div class="input-group">
                                  <div class="input-group-btn">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add" wire:click="add()"><i class="fa fa-plus-circle"></i> Bayar</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tbl_tagihansantri" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Tagihan</th>
                                            <th>Total</th>
                                            <th>Sudah Bayar</th>
                                            <th>Belum Bayar</th>
                                            <th>Tahun</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pemasukans as $key=> $row)
                                        <tr>
                                            <td>{{$row->kode}}</td>
                                            <td>{{$row->namapemasukan}}</td>
                                            <td nowrap>Rp. {{$row->nominal}}</td>
                                            <td nowrap>Rp. </td>
                                            <td nowrap>Rp. </td>
                                            <td>{{$row->tahunAkademik->tahunakademik}}</td>
                                            <td><label class="badge {{(($row->status=='Aktif') ? 'badge-success' : 'badge-warning')}}">{{$row->status}}</label></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="col-12">
                        <div class="card-header">
                            <h4>Riwayat Pembayaran</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tbl_tagihansantri" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Nominal Bayar</th>
                                            <th>Petugas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pembayarans as $key=> $row)
                                        <tr>
                                            <td>{{$row->kodetransaksi}}</td>
                                            <td nowrap>{{$row->tgl_transaksi}}</td>
                                            <td nowrap>Rp. {{$row->nominal}}</td>
                                            <td>{{$row->petugas}}</td>
                                            <td><label class="badge {{(($row->status=='Aktif') ? 'badge-success' : 'badge-warning')}}">{{$row->status}}</label></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                        <h5 class="modal-title" id="judul-modal">Pembayaran Santri</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="submit" class="form-horizontal">
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="kodebayar">Kode Transaksi</label>
                                <input type="text" name="kodebayar" wire:model.defer="kodebayar" class="form-control" id="kodebayar" readonly>
                                @error('kodebayar') <span class="text-danger">{{ $message }}</span>@enderror
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
                        <input type="hidden" name="santri_id" wire:model="santri_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
