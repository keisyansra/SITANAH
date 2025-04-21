<div class="sidebar">
    

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{url('/')}}" class="nav-link {{($activeMenu == 'dashboard')? 'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        {{-- Menu Khusus Admin --}}
        @if(auth()->user()->role == 'admin')
                <li class="nav-header">Data Pengguna</li>
                <li class="nav-item">
                    <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Data User</p>
                    </a>
                </li>

                <li class="nav-header">Data Tanah Makam</li>
                <li class="nav-item">
                    <a href="{{ url('/lokasi') }}" class="nav-link {{ ($activeMenu == 'lokasi') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Informasi Lokasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/tanah') }}" class="nav-link {{ ($activeMenu == 'tanah') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Informasi Tanah</p>
                    </a>
                </li>
            @endif

            {{-- Menu Khusus Kasir --}}
            @if(auth()->user()->role == 'kasir')
                <li class="nav-header">Data Pengguna</li>
                <li class="nav-item">
                    <a href="{{ url('/nasabah') }}" class="nav-link {{ ($activeMenu == 'nasabah') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Data Nasabah</p>
                    </a>
                </li>

                <li class="nav-header">Data Transaksi</li>
                <li class="nav-item">
                    <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>Data Penjualan</p>
                    </a>
                </li>
            @endif
        <li class="nav-header">Keluar</li>
        <li class="nav-header">Keluar</li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link text-danger" onclick="return confirm('Yakin mau logout?')">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </a>
        </li>
      </ul>
    </nav>
</div>
          