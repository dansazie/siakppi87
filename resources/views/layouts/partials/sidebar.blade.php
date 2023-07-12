<div class="main-sidebar">
            <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="{{ url('/') }}">{{ (!empty(setting('nama_aplikasi')) ? setting('nama_aplikasi') : 'SIASIK') }}</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href="{{ url('/') }}"><img alt="logo" src="{{((empty(setting('logo')) ? 'SAA' : asset('storage/'.setting('logo'))))}}" class="rounded" width="35"  title=""></a>
            </div>
            <ul class="sidebar-menu">
                <li class="nav-item {{ (request()->is('dashboard')) ? 'active' : ''}}">
                    <a href="{{ route('dashboard') }}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
                <li class="menu-header">Main Menu</li>
                <li class="nav-item dropdown {{ (request()->is('master*')) ? 'active' : ''}}">
                    <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-columns"></i> <span>MASTER DATA</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ (request()->is('master/asatidz')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('master.asatidz') }}">Asatidz</a></li>
                        <li class="{{ (request()->is('master/santri')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('master.santri') }}">Santri</a></li>
                        <li class="{{ (request()->is('master/jurusan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('master.jurusan') }}">Jurusan</a></li>
                        <li class="{{ (request()->is('master/rombel')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('master.rombel') }}">Rombel</a></li>
                        <li class="{{ (request()->is('master/mapel')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('master.mapel') }}">Mata Pelajaran</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown {{ (request()->is('akademik*')) ? 'active' : ''}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>AKADEMIK</span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="nav-link" href="layout-default.html">Set JTM</a></li>
                        <li class=""><a class="nav-link" href="layout-default.html">Buat Jadwal</a></li>
                        <li class=""><a class="nav-link" href="layout-default.html">Jadwal Pelajaran</a></li>
                        <li class=""><a class="nav-link" href="layout-default.html">Kenaikan Kelas</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown {{ (request()->is('keuangan*')) ? 'active' : ''}}">
                    <a href="#" class="nav-link has-dropdown " data-toggle="dropdown"><i class="fas fa-columns"></i> <span>KEUANGAN</span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="nav-link" href="layout-default.html">Jurnal</a></li>
                        <li class="{{ (request()->is('keuangan/rencana/pemasukan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('keuangan.rencana.pemasukan') }}">Rencana Pemasukan</a></li>
                        <li class="{{ (request()->is('keuangan/pemasukan/pemasukansantri')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('keuangan.pemasukan.pemasukansantri') }}">Pemasukan Santri</a></li>
                        <li class=""><a class="nav-link" href="layout-default.html">Pemasukan Lainnya</a></li>
                        <li class=""><a class="nav-link" href="layout-default.html">Rencana Pengeluaran</a></li>
                        <li class=""><a class="nav-link" href="layout-default.html">Realisasi Pengeluaran</a></li>
                    </ul>
                </li>
                @hasrole('Admin')
                <li class="nav-item dropdown {{ (request()->is('setting/*')) ? 'active' : ''}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>PENGATURAN</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ (request()->is('setting/pengguna')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('setting.pengguna') }}">Pengguna</a></li>
                        <li class="{{ (request()->is('setting/roles')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('setting.roles') }}">Roles</a></li>
                        <li class=""><a class="nav-link" href="">Permission</a></li>
                        <li class="{{ (request()->is('setting/aplikasi')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('setting.aplikasi') }}">Aplikasi</a></li>
                        <li class="{{ (request()->is('setting/pendidikan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('setting.pendidikan') }}">Pendidikan</a></li>
                        <li class="{{ (request()->is('setting/satuan')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('setting.satuan') }}">Satuan</a></li>
                        <li class="{{ (request()->is('setting/tingkat')) ? 'active' : ''}}"><a class="nav-link" href="{{ route('setting.tingkat') }}">Tingkat</a></li>
                    </ul>
                </li>
                @endhasrole

            </ul>

                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                </a>
                </div>
            </aside>
        </div>
