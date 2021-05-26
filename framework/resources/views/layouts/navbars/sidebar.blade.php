<div class="sidebar" data-color="danger" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('PCB EMIS') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li class="nav-item {{ ($activePage == 'userprofile' || $activePage == 'profile' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons">account_circle</i>
          <p>{{ __('Accounts & Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
             <li class="nav-item{{ $activePage == 'userprofile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('userprofile.index') }}">
                <i class="material-icons">face</i>
                <span class="sidebar-normal">{{ __('Profile') }} </span>
              </a>
              </li>
               <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                      <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="material-icons">face</i>
                        <span class="sidebar-normal">{{ __('Account Settings') }} </span>
                      </a>
              </li>
              <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" >
                        <i class="material-icons">logout</i>
                        <span class="sidebar-normal">{{ __('Log Out') }} </span>
                      </a>
              </li>
            
         
          </ul>
        </div>
      </li>


     
      <li class="nav-item{{ $activePage == 'directory' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('directory') }}">
          <i class="material-icons">groups</i>
            <p>{{ __('PCB Directory') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'request' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('request.index') }}">
          <i class="material-icons">move_to_inbox</i>
            <p>{{ __('Self-Services') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'usertask' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('usertask.index') }}">
          <i class="material-icons">new_releases</i>
            <p>{{ __('Tasks') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'designation' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user_designation.index') }}">
          <i class="material-icons">assignment_ind</i>
          <p>{{ __('Designations') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'jobopp' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user_jobopportunity.index') }}">
          <i class="material-icons">campaign</i>
            <p>{{ __('Job Opportunities') }}</p>
        </a>
      </li>
  
      <li class="nav-item{{ $activePage == 'evaluation' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user_evaluation.index') }}">
          <i class="material-icons">fact_check</i>
          <p>{{ __('Evaluations') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'exitapp' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('user_exitapplication.index') }}">
          <i class="material-icons">follow_the_signs</i>
          <p>{{ __('Exit Management') }}</p>
        </a>
      </li>

    </ul>
  </div>
</div>
