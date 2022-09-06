<!-- Start of Sidebar -->
<div class="col-sm-4 col-md-3 col-lg-2">
    <div class="row">
        <div class="col d-flex justify-content-center p-4">
            <a href="/"><img src="/img/favicon.png" alt="KostKu Logo" width="75" class="img-fluid rounded-circle" /></a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="navbar-toggler p-3 d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-filter-left me-2"></i>
            </button>
        </div>
    </div>

    <hr />
    <div class="row" id="sidebarMenu">
        <div class="d-flex flex-column">

            {{-- Material --}}
            <ul class="list-unstyled p-2">
                <li>
                    <button id="btnSideBar-Personnel" class="btn btn-toggle mt-3 align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#personnel-collapse" aria-expanded="true">
                        <span data-feather="home"></span>&nbsp; Materials &nbsp;<i class="bi bi-caret-down-fill me-3"></i></span>
                    </button>
                    <div id="personnel-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal small">
                            <li>
                                <a href="/dashboard/materials" class="sideBar-link" id="{{ Request::is('dashboard/materials*') ? 'sideBar-KList' : '' }}">
                                    <span data-feather="list"></span>&nbsp; Material List
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/categories" class="sideBar-link" id="{{ Request::is('dashboard/categories*') ? 'sideBar-KList' : '' }}">
                                    <span data-feather="grid"></span>&nbsp; Material Categories
                                </a>
                            </li>
                            <li>
                                <a href="/dashboard/galleries" class="sideBar-link" id="{{ Request::is('dashboard/galleries*') ? 'sideBar-KList' : '' }}">
                                    <span data-feather="image"></span>&nbsp; Material Galleries
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            {{-- Logout --}}
            <div class="p-2">
                <form action="/logout/teacher" method="POST">
                    @csrf
                    <button type="submit" class="sideBar-link rounded border-0" id="sideBar-Logout" style="background-color: white"><span data-feather="log-out"></span>&nbsp; Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Sidebar -->