<div class="sidebar" data-color="danger" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('admin') }}" class="simple-text logo-normal">
      {{ __('PCB admin') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('admin') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management' || $activePage == 'acadyear') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons">account_circle</i>
          <p>{{ __('Accounts & Settings') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
             <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'acadyear' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('acadyear.index') }}">
                <span class="sidebar-mini"> A.Y. </span>
                <span class="sidebar-normal"> {{ __('Academic Year Setting') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'pos' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('positions.index') }}">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> {{ __('Positions') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'dept' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('department.index') }}">
                <span class="sidebar-mini"> D </span>
                <span class="sidebar-normal"> {{ __('Departments') }} </span>
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
      <li class="nav-item{{ $activePage == 'employees' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('employees.index') }}">
          <i class="material-icons">groups</i>
            <p>{{ __('Employees') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'request' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('req.view') }}">
          <i class="material-icons">move_to_inbox</i>
            <p>{{ __('Requests') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'tasks' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('tasks.index') }}">
          <i class="material-icons">new_releases</i>
            <p>{{ __('Tasks') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'designation' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('designations.index') }}">
          <i class="material-icons">assignment_ind</i>
          <p>{{ __('Designations') }}</p>
        </a>
      </li>


      <li class="nav-item{{ $activePage == 'jobopp' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('job_opportunity.index') }}">
          <i class="material-icons">campaign</i>
            <p>{{ __('Job Opportunities') }}</p>
        </a>
      </li>
      
      <li class="nav-item{{ $activePage == 'evaluations' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('evaluations.index') }}">
          <i class="material-icons">fact_check</i>
          <p>{{ __('Evaluations') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'exitapp' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('exit.view') }}">
          <i class="material-icons">follow_the_signs</i>
          <p>{{ __('Exit Management') }}</p>
        </a>
      </li>

    </ul>
  </div>
</div>
