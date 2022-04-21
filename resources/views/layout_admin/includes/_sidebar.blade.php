<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/hama">
                <i class="icon-menu menu-icon"></i>
                <span class="menu-title">Data Hama</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/gejala">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">Data Gejala</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/basisaturan">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Data Basis Aturan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/hasil">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Data Hasil</span>
            </a>
        </li>
        @if(auth()->user()->role == 3)

        @else
        <li class="nav-item">
            <a class="nav-link" href="/user">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Data Pengguna</span>
            </a>
        </li>
        @endif
    </ul>
</nav>