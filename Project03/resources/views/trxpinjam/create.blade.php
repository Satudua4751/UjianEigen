<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='pinjam'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Entri Pinjaman Book"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Entri Pinjaman Book</h4>
                            </div>
                        </div>
                        </br>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            <form class="form-horizontal" action="{{ route('trxpinjam.store') }}" id="formtambah" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-dynamic mb-2">
                                            <span class="input-group-text"></span>
                                            <input type="date" name="tgltrx" id="tgltrx" class="form-control" placeholder="Tanggal" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-dynamic mb-2">
                                            <span class="input-group-text">Nota</span>
                                            <input type="text" name="idtrx" id="idtrx" class="form-control" placeholder="No.Transaksi" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-2">
                                            <select name="codem" id="codem" class="form-control" required>
                                                <option value="">== Pilih Member ==</option>
                                                @foreach($member as $members)
                                                <option value="{{ $members->codem }}">{{ $members->name }} - {{ $members->stts }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-2">
                                            <span class="input-group-text">Name</span>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Name Member" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-2">
                                            <span class="input-group-text">Sangsi (Ya/Tidak)</span>
                                            <input type="text" name="stts" id="stts" class="form-control" placeholder="Status" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Kode Buku</label>
                                        <div class="input-group input-group-static mb-2">
                                            <select name="codeb" id="codeb" class="form-select">
                                                <option value="">==== Pilih Buku ====</option>
                                                @foreach($book as $books)
                                                <option value="{{ $books->codeb }}">{{ $books->title }} - {{ $books->author }} - Stock - {{ $books->stock }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-2">
                                            <label>Title</label>
                                            <input type="text" name="title" id="title" class="form-control text-start" placeholder="Title" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-2">
                                            <label>Author</label>
                                            <input type="text" name="author" id="author" class="form-control text-start" placeholder="Author" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-group input-group-static mb-2">
                                            <label>Qty Pinjam</label>
                                            <input type="number" min="0" name="jmlpinjam" id="jmlpinjam" class="form-control text-end" placeholder="Qty" value="0">
                                            <div id="stockError" class="text-danger text-xxs mt-2" style="display:none;">Stok tidak mencukupi.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" id="additem" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Item</button>
                                    </div>

                                </div>
                                <table id="belidettrx" class="table table-bordered table-striped align-items-center table-hover" width="100%">
                                    <thead class="bg-blue-200 font-weight-bold" style="height: 40px;">
                                        <tr>
                                            <th class="text-xs" width="1%">No</th>
                                            <th class="text-xs" width="2%">Kode</th>
                                            <th class="text-xs" width="10%">Title</th>
                                            <th class="text-xs" width="10%">Author</th>
                                            <th class="text-xs" width="3%">Jumlah</th>
                                            <th class="text-xs" width="6%">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-table">
                                    </tbody>
                                </table>
                                <hr class="dark horizontal my-0">
                                </br>

                                <input type="hidden" name="items" id="items">
                                <a href="{{ route('trxpinjam.index') }}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Back </a>
                                <button type="submit" class="btn btn-primary addconfirm"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
<script type="text/javascript">
    $('#additem').click(function(e) {
        e.preventDefault();
        var codeb = $('#codeb').val();
        var title = $('#title').val();
        var author = $('#author').val();
        var jmlpinjam = $('#jmlpinjam').val();
        var no = $('#items-table tr').length + 1;
        if (no < 2) {
            $('#additem').prop('disabled', false); // Mengaktifkan tombol
        } else {
            $('#additem').prop('disabled', true); // Mengaktifkan tombol
        }
        if (codeb == '') {} else {
            var newRow = `
            <tr>
                <td class="text-xs text-end">${no}</td>
                <td class="text-xs">${codeb}</td>
                <td class="text-xs">${title}</td>
                <td class="text-xs">${author}</td>
                <td class="text-xs text-end">${jmlpinjam}</td>
                    <td class="text-xs text-end">
                        <button type="button" class="btn btn-danger remove-item"><i class="fa fa-trash"></i> Del</button>
                    </td>
            </tr> `;
        }


        $('#items-table').append(newRow);

        // Clear the form fields
        $('#codeb').val('');
        $('#title').val('');
        $('#author').val('');
        $('#jmlpinjam').val(0);
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
        $('#items-table tr').each(function(index) {
            $(this).find('td:eq(0)').text(index + 1);
        });
    });

    /* Member */
    $('#codem').change(function() {
        var codem = $('#codem').val();
        $.ajax({
            type: 'POST',
            url: `{{ route('trxpinjam_getmember') }}`,
            data: {
                codem: codem,
                _token: '{{ csrf_token() }}'
            },
            cache: true,
            success: function(response) {
                if (response.error) {
                    $('#name').val(response.error);
                    $('#stts').val(response.error);
                } else {
                    $('#name').val(response.name);
                    $('#stts').val(response.stts);
                }
            },
            error: function(response) {
                $('#name').val('Name ditemukan');
                $('#stts').val('Status ditemukan');
            }
        });
    });

    /* book */
    $('#codeb').change(function() {
        var codeb = $('#codeb').val();
        $.ajax({
            type: 'POST',
            url: `{{ route('trxpinjam_getbook') }}`,
            data: {
                codeb: codeb,
                _token: '{{ csrf_token() }}'
            },
            cache: true,
            success: function(response) {
                if (response.error) {
                    $('#title').val(response.error);
                    $('#author').val(response.error);
                } else {
                    $('#title').val(response.title);
                    $('#author').val(response.author);
                }
            },
            error: function(response) {
                $('#title').val('Title tidak ditemukan');
                $('#author').val('Author tidak ditemukan');
            }
        });
    });

    $('#jmlpinjam').on('input', function() {
        var qtyOut = $(this).val();
        var codeb = $('#codeb').val();
        $.ajax({
            url: '/checkstock', // URL ke endpoint yang memeriksa stok
            method: 'POST',
            data: {
                codeb: codeb,
                qty: qtyOut,
                _token: '{{ csrf_token() }}' // Token CSRF untuk keamanan
            },
            success: function(response) {
                if (response.valid) {
                    $('#stockError').hide();
                    $('#additem').prop('disabled', false); // Mengaktifkan tombol
                } else {
                    $('#stockError').show();
                    $('#additem').prop('disabled', true); // Mengaktifkan tombol
                }
            }
        });
    });

    // Function to handle form submission
    $('#formtambah').submit(function(e) {
        var items = [];
        $('#items-table tr').each(function() {
            var item = {
                codeb: $(this).find('td:eq(1)').text(),
                title: $(this).find('td:eq(2)').text(),
                author: $(this).find('td:eq(3)').text(),
                jmlpinjam: $(this).find('td:eq(4)').text(),
            };
            items.push(item);
        });
        $('#items').val(JSON.stringify(items));
    });

    // SweetAlert Script
    $('.addconfirm').click(function(event) {
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

    $('#tgltrx').change(function() {
        var tgltrx1 = $('#tgltrx').val();

        $.ajax({
            type: 'POST',
            url: `{{ route('trxpinjam_nota') }}`,
            data: {
                tgltrx1: tgltrx1,
                _token: '{{ csrf_token() }}'
            },
            cache: true,
            success: function(response) {
                $('#idtrx').val(response.idtrx);
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var text_val = $(".input-group input").val();
        if (text_val === "") {
            $(".input-group").removeClass('is-filled');
        } else {
            $(".input-group").addClass('is-filled');
        }

        $("#codem").select2({
            theme: "classic"
        });

        $("#codeb").select2({
            theme: "classic"
        });
    });
</script>
