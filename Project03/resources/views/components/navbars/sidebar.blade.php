@props(['activePage'])
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-md my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <span class="ms-2 font-weight-bold text-white">Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">UJIAN</h6>
            </li>
            <hr class="light horizontal my-0">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'book' ? 'active bg-gradient-primary' : '' }} " href="{{ route('book.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="material-icons opacity-10 ps-2 pe-2">inventory_2</i>
                    </div>
                    <span class="nav-link-text ms-1">Buku</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'pinjam' ? 'active bg-gradient-primary' : '' }} " href="{{ route('trxpinjam.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="material-icons opacity-10 ps-2 pe-2">inventory_2</i>
                    </div>
                    <span class="nav-link-text ms-1">Pinjam</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'kembali' ? 'active bg-gradient-primary' : '' }} " href="{{ route('trxkembali.index')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="material-icons opacity-10 ps-2 pe-2">inventory_2</i>
                    </div>
                    <span class="nav-link-text ms-1">Kembali</span>
                </a>
            </li>
        </ul>
    </div>
    <hr class="light horizontal my-0">
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            <a class="btn bg-gradient-primary w-100" href="#" target="_blank">---------</a>
        </div>
    </div>

</aside>
