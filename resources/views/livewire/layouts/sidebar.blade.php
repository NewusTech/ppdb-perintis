<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <?php $role = auth()
                    ->user()
                    ->roles->first()->name;
                ?>
                <li>
                    <a href="{{ url('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @if ($role !== 'siswa' && $role !== 'pimpinan')
                    <li>
                        <a href="{{ url('pendaftaran-awal') }}" class="mt-2 waves-effect">
                            <i class="ri-user-add-line"></i>
                            <span>Pendaftaran Awal</span>
                        </a>
                    </li>
                @endif

                <li class="{{ request()->is('formulir-pendaftaran*') ? 'mm-active' : '' }}">
                    <a href="{{ url('formulir-pendaftaran') }}"
                        class="mt-2 waves-effect {{ request()->is('formulir-pendaftaran*') ? 'active' : '' }}">
                        <i class="ri-file-edit-line"></i>
                        <span>Formulir Pendaftaran</span>
                    </a>
                </li>

                @if ($role == 'siswa' || $role == 'admin wawancara' || $role == 'super admin')
                    <li class="{{ request()->is('wawancara*') ? 'mm-active' : '' }}">
                        <a href="{{ url('wawancara') }}"
                            class="mt-2 waves-effect {{ request()->is('wawancara*') ? 'active' : '' }}">
                            <i class="ri-mic-line"></i>
                            <span>Wawancara</span>
                        </a>
                    </li>
                @endif

                @if ($role == 'siswa' || $role == 'admin daftar ulang' || $role == 'super admin')
                    <li class="{{ request()->is('daftar-ulang*') ? 'mm-active' : '' }}">
                        <a href="{{ url('daftar-ulang') }}"
                            class="mt-2 waves-effect {{ request()->is('daftar-ulang*') ? 'active' : '' }}">
                            <i class="ri-file-copy-2-line"></i>
                            <span>Daftar Ulang</span>
                        </a>
                    </li>
                @endif

                @if ($role == 'siswa' || $role == 'super admin')
                    <li class="{{ request()->is('biodata*') ? 'mm-active' : '' }}">
                        <a href="{{ url('biodata') }}"
                            class="mt-2 waves-effect {{ request()->is('biodata*') ? 'active' : '' }}">
                            <i class="ri-profile-line"></i>
                            <span>Biodata</span>
                        </a>
                    </li>
                @endif

                @if ($role == 'pimpinan' || $role == 'super admin' || $role == 'pimpinan')
                    <li>
                        <a href="{{ url('laporan') }}" class="mt-2 waves-effect">
                            <i class="ri-article-line"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                @endif

                @if ($role == 'super admin' || $role == 'pimpinan')
                    <li>
                        <a href="{{ url('daftar-siswa') }}" class="mt-2 waves-effect">
                            <i class="ri-user-follow-line"></i>
                            <span>Daftar Siswa</span>
                        </a>
                    </li>
                @endif

                @if ($role == 'super admin')
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-share-line"></i>
                            <span>Pengaturan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                <a href="{{ url('daftar-admin') }}" class="mt-2 waves-effect">
                                    <i class="ri-shield-user-line"></i>
                                    <span>Daftar Admin</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('setting-biaya') }}" class="mt-2 waves-effect">
                                    <i class="ri-money-dollar-circle-line"></i>
                                    <span>Setting Biaya</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('tata-tertib') }}" class="mt-2 waves-effect">
                                    <i class="ri-file-list-line"></i>
                                    <span>Tata Tertib</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
