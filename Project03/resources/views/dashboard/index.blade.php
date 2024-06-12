<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
        <!-- Navbar -->
        <x-navbars.navs.judul titlePage="Dashboard"></x-navbars.navs.judul>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @include('dashboard.result')
        </div>
    </main>
</x-layout>
