<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
              <!-- <li class="menu-header">Dashboard</li> -->
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <!-- dropdown menu -->
              <li class="nav-item has-dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-columns"></i> <span>Kriteria</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.kriteria') }}">Kriteria</a></li>
                    <li><a class="nav-link" href="{{ route('admin.nilai_bobot_kriteria') }}">Nilai Bobot Kriteria</a></li>
                </ul>
              </li>
            </ul>
<!-- 
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div> -->
        </aside>
      </div>