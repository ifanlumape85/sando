<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/" class="navbar-brand">
            <div class="d-flex justify-content-between">
                <img src="/bakti.png" class="img-sm mt-2 mr-2" />
                <div>
                    <div class="text-bold">DINAS KESEHATAN</div>
                    <div class="text-secondary text-sm">PEMERINTAH KABUPATEN BOLAANG MONGONDOW TIMUR</div>
                </div>
            </div>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a href="/" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard-stunting') }}" class="nav-link">Dashboard Stunting</a>
                </li>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="/login" role="button">
                        Masuk
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /.navbar -->