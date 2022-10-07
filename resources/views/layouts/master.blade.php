      @include('layouts.header')
      <!-- include sidebar blade command -->
      @include('layouts.sidebar')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <!-- <div class="section-header">
            <h1>Blank Page</h1>
          </div>

          <div class="section-body">
          </div> -->
            @yield('content')
        </section> 
      </div>
      @include('layouts.footer')