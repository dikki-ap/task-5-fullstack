<nav class="navbar navbar-expand-lg" style="background-color: #D3E4CD">
    <div class="container">
      <a class="navbar-brand" href="/">Studify</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          {{-- Request Link untuk menambahkan class 'active' agar text menjadi BOLD --}}
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('materials') ? 'active' : '' }}" href="/materials">Material</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('teachers') ? 'active' : '' }}" href="/teachers">Teacher</a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">

          {{-- Navbar Admin --}}
          @if (Auth::guard('admin')->check())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>&nbsp; {{ auth('admin')->user()->name }} (Admin)
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard/materials" style="color: #99A799"><i class="bi bi-filetype-pdf"></i></i>&nbsp; Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout/admin" method="POST">
                  @csrf
                  
                  <button type="submit" class="dropdown-item" style="color: #a52b2a"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout</button>
              </li>
              </ul>
            </li>

          {{-- Navbar Teacher --}}
          @elseif(Auth::guard('teacher')->check())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>&nbsp; {{ auth('teacher')->user()->name }} (Teacher)
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/dashboard/materials" style="color: #99A799"><i class="bi bi-filetype-pdf"></i></i>&nbsp; Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form action="/logout/teacher" method="POST">
                  @csrf
                  
                  <button type="submit" class="dropdown-item" style="color: #a52b2a"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout</button>
              </li>
              </ul>
            </li>

          {{-- Navbar Student --}}
          @elseif(Auth::guard('student')->check())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>&nbsp; {{ auth('student')->user()->name }} (Student)
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <form action="/logout/student" method="POST">
                  @csrf
                  
                  <button type="submit" class="dropdown-item" style="color: #a52b2a"><i class="bi bi-box-arrow-right"></i>&nbsp; Logout</button>
              </li>
              </ul>
            </li>

          {{-- Navbar Guest --}}
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Login
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="/login/teacher"><i class="bi bi-box-arrow-in-right"></i>&nbsp; Login as Teacher</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/login/student"><i class="bi bi-box-arrow-in-right"></i>&nbsp; Login as Student</a></li>
              </ul>
            </li>
          @endif 
        </ul>
        
      </div>
    </div>
</nav>