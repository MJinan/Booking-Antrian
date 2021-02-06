<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">RSUD Tidar</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">RSDT</a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> <span>Home</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('vcard') }}">
                    <i class="fas fa-id-card"></i> <span>KIB Pasien</span>
                </a>
            </li>
            <!-- <li>
                <a class="nav-link" href="#">
                    <i class="fas fa-calendar"></i> <span>Jadwal Dokter</span>
                </a>
            </li> -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-stethoscope"></i> <span>Daftar</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('dftr.klinik') }}">Daftar Klinik</a></li>
                    <li><a class="nav-link" href="{{ route('dftr.dokter') }}">Daftar Dokter</a></li>
                </ul>
            </li>

            @if (Auth::id() == true)
                <li>
                    <a class="nav-link" href="{{ route('rwyt.booking') }}">
                        <i class="fas fa-envelope-open-text"></i> <span>History Pesanan</span>
                    </a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-history"></i> <span>Riwayat</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('rwyt.rajal') }}">Rawat Jalan</a></li>
                        <li><a class="nav-link" href="{{ route('rwyt.ranap') }}">Rawat Inap</a></li>
                    </ul>
                </li> --}}
            @endif

            <li>
                <a class="nav-link" href="http://103.105.253.182:8090/infobed">
                    <i class="fas fa-bed"></i> <span>Informasi Bed</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="http://103.105.253.182:8090/poliku">
                  <i class="fas fa-sort-numeric-down"></i> <span>Antrian Poli</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="http://rsudtidar.magelangkota.go.id/">
                    <i class="fas fa-globe"></i> <span>Web RSUD Tidar</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
