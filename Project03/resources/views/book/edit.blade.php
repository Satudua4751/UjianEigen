<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='book'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
        <!-- Navbar -->
        <x-navbars.navs.judul titlePage="Book"></x-navbars.navs.judul>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-8">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-dark border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Edit Book</h4>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            <form role="form" action="{{ route('book.update',$book->codeb) }}" method="POST" enctype="multipart/form-data" class="text-start">
                                @csrf
                                @method('PUT')
                                </br>
                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="idbrg" class="form-label">Kode </label>
                                        <input type="text" name="code" id="code" class="form-control" value="{{ $book->codeb }}" readonly>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="nmbrg" class="form-label">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="satuan" class="form-label">Author</label>
                                        <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="input-group input-group-outline my-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" class="form-control text-end" value="{{ $book->stock }}" required>
                                    </div>
                                </div>

                                <a href="{{ route('book.index') }}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Back </a>
                                <button type="submit" class="btn btn-primary editconfirm"> Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
<script>
    $(document).ready(function() {
        var text_val = $(".input-group input").val();
        if (text_val === "") {
            $(".input-group").removeClass('is-filled');
        } else {
            $(".input-group").addClass('is-filled');
        }

        $("#jenis").select2({
            theme: "classic"
        });

        // SweetAlert Script
        $('.editconfirm').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault(); // Menghentikan form dari pengiriman otomatis

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pastikan semua data sudah benar sebelum menyimpan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Mengirim form setelah konfirmasi
                    Swal.fire(
                        'Tersimpan!',
                        'Data Anda berhasil disimpan.',
                        'success'
                    );
                }
            });
        });
    });
</script>
