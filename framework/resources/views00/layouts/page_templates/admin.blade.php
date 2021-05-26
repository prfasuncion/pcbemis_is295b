<div class="wrapper ">
  @include('layouts.navbars.adminsidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.admin')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>