<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
              @if (Auth::user()->role == 'admin')
              <li class="nav-item dropdown {{ (request()->routeIs('admin.kriteria*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i> <span>Kriteria</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.kriteria') }}">Kriteria</a></li>
                    <li><a class="nav-link" href="{{ route('admin.rel_kriteria') }}">Nilai Bobot Kriteria</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown {{ (request()->routeIs('admin.alternative*')) ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i> <span>Alternative</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.alternative') }}">Alternative</a></li>
                    <li><a class="nav-link" href="{{ route('admin.rel_alternative') }}">Nilai Bobot Alternative</a></li>
                </ul>
              </li>
              <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="{{ route('admin.perhitungan') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                  <i class="fas fa-rocket"></i> Perhitungan
                </a>
              </div>
              @endif

              @if (Auth::user()->role == 'user')
              <li class="nav-item">
                <a href="{{ route('user.home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              @endif
            </ul>

            
        </aside>
      </div>