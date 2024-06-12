<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='kembali'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md">
        <!-- Navbar -->
        <x-navbars.navs.judul titlePage="Edit Pengembalian Book"></x-navbars.navs.judul>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Edit Penerimaan Book</h4>
                            </div>
                        </div>
                        <br>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            <form class="form-horizontal" action="{{ route('trxkembali.update', $trxBarang->idtrxbrg) }}" id="formupdate" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Tanggal</label>
                                            <input type="date" name="tgltrxbrg" id="tgltrxbrg" class="form-control" value="{{ $trxBarang->tgltrxbrg }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Nota</label>
                                            <input type="text" name="idtrxbrg" id="idtrxbrg" class="form-control" value="{{ $trxBarang->idtrxbrg }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>ID.Supplier</label>
                                        <div class="input-group input-group-static mb-4">
                                            <select name="idspl" id="idspl" class="form-control selectpicker" required>
                                                <option class="text-start" value="">== Pilih Supplier ==</option>
                                                @foreach($suppliers as $suppliers1)
                                                <option value="{{ $suppliers1->idspl }}" {{ $trxBarang->idspl == $suppliers1->idspl ? 'selected' : '' }}>{{ $suppliers1->namaspl }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Stock Umum/Bengkel</label>
                                        <div class="input-group input-group-static mb-4">
                                            <select name="stumum" id="stumum" class="form-control" required>
                                                <option value="">== Untuk ==</option>
                                                <option value="umum" {{ $trxBarang->stumum == 'umum' ? 'selected' : '' }}>Umum</option>
                                                <option value="bengkel" {{ $trxBarang->stumum == 'bengkel' ? 'selected' : '' }}>Bengkel</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="input-group input-group-static mb-4">
                                            <label>PPn</label>
                                            <input type="number" min="0" name="ppnbeli" id="ppnbeli" class="form-control text-end" value="{{ $trxBarang->ppnbeli }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Keterangan</label>
                                            <input type="textarea" name="kettrxbrg" id="kettrxbrg" class="form-control" value="{{ $trxBarang->kettrxbrg }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kode Barang</label>
                                        <div class="input-group input-group-static mb-4">
                                            <select name="idbrg" id="idbrg" class="form-select">
                                                <option value="">==== Pilih Barang/Jasa ====</option>
                                                @foreach($barangJasa as $barangjasas)
                                                <option value="{{ $barangjasas->idbrg }}" data-merk="{{ $barangjasas->merk }}">{{ $barangjasas->idbrg }} - {{ $barangjasas->nmbrg }} - {{ number_format($barangjasas->harga, 2) }} - {{ number_format($barangjasas->hargaj, 2) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Nama</label>
                                            <input type="text" name="nmbrg" id="nmbrg" class="form-control text-start" placeholder="Nama" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Merk</label>
                                            <input type="text" name="merk" id="merk" class="form-control text-start" placeholder="Merk" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Qty Beli</label>
                                            <input type="number" min="0" name="jmlbeli" id="jmlbeli" class="form-control text-end" placeholder="Qty" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Harga Beli</label>
                                            <input type="number" min="0" name="hargabeli" id="hargabeli" class="form-control text-end" placeholder="Harga Beli" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-static mb-4">
                                            <label>Harga Jual</label>
                                            <input type="number" min="0" name="hargajual" id="hargajual" class="form-control text-end" placeholder="Harga Jual" value="0">
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
                                            <th class="text-xs" width="2%">Kode Barang</th>
                                            <th class="text-xs" width="10%">Nama Barang</th>
                                            <th class="text-xs" width="2%">Merk</th>
                                            <th class="text-xs" width="2%">Jumlah</th>
                                            <th class="text-xs" width="4%">Harga Beli</th>
                                            <th class="text-xs" width="4%">Harga Jual</th>
                                            <th class="text-xs" width="4%">Total Beli</th>
                                            <th class="text-xs" width="4%">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="items-table">
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($trxBrgDetails as $trxbrgdetails)
                                        <tr>
                                            <td class="text-xs text-end" scope="row">{{ ++ $no }}</td>
                                            <td class="text-xs text-start" scope="row">{{ $trxbrgdetails->idbrg }}</td>
                                            <td class="text-xs text-start" scope="row">{{ $trxbrgdetails->nmbrg }}</td>
                                            <td class="text-xs text-start" scope="row">{{ $trxbrgdetails->merk }}</td>
                                            <td class="text-xs text-end" scope="row">{{ $trxbrgdetails->jmlbeli }}</td>
                                            <td class="text-xs text-end" scope="row">{{ $trxbrgdetails->hargabeli }}</td>
                                            <td class="text-xs text-end" scope="row">{{ $trxbrgdetails->hargajual }}</td>
                                            <td class="text-xs text-end" scope="row">{{ number_format ($trxbrgdetails->jmlbeli * $trxbrgdetails->hargabeli,2) }}</td>
                                            <td class="text-xs text-end">
                                                <button type="button" class="btn btn-danger remove-item"><i class="fa fa-trash"></i> Del</button>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                                <input type="hidden" name="items" id="items">
                                <hr class="dark horizontal my-0">
                                <br>
                                <a href="{{ route('trxbarang.index') }}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Back </a>
                                <button type="submit" class="btn btn-primary updateconfirm"><i class="fa-solid fa-floppy-disk"></i> Update</button>
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

        var idbrg = $('#idbrg').val();
        var nmbrg = $('#nmbrg').val();
        var jmlbeli = $('#jmlbeli').val();
        var hargabeli = $('#hargabeli').val();
        var hargajual = $('#hargajual').val();
        var merk = $('#merk').val();
        var totalbeli = jmlbeli * hargabeli;
        if (!idbrg || !nmbrg || jmlbeli <= 0 || hargabeli <= 0) {
            Swal.fire('Warning', 'Please fill in all fields correctly.', 'warning');
            return;
        }
        var newRow = `
            <tr>
                <td class="text-xs text-end">${$('#items-table tr').length + 1}</td>
                <td class="text-xs">${idbrg}</td>
                <td class="text-xs">${nmbrg}</td>
                <td class="text-xs">${merk}</td>
                <td class="text-xs text-end">${jmlbeli}</td>
                <td class="text-xs text-end">${hargabeli}</td>
                <td class="text-xs text-end">${hargajual}</td>
                <td class="text-xs text-end">${totalbeli}</td>
                <td class="text-xs text-end">
                    <button type="button" class="btn btn-danger remove-item"><i class="fa fa-trash"></i> Del</button>
                </td>
            </tr>
        `;

        $('#items-table').append(newRow);
        // Clear the form fields
        $('#idbrg').val('').trigger('change');
        $('#nmbrg').val('');
        $('#merk').val('');
        $('#jmlbeli').val(0);
        $('#hargabeli').val(0);
        $('#hargajual').val(0);
    });

    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
        $('#items-table tr').each(function(index) {
            $(this).find('td:eq(0)').text(index + 1);
        });
    });

    $('#idbrg').change(function() {
        var idbrg1 = $('#idbrg').val();

        $.ajax({
            type: 'POST',
            url: `{{ route('trxbarang_hargabeli') }}`,
            data: {
                idbrg1: idbrg1,
                _token: '{{ csrf_token() }}'
            },
            cache: true,
            success: function(response) {
                if (response.error) {
                    $('#nmbrg').val(response.error);
                    $('#merk').val(response.error);
                    $('#hargabeli').val(response.error);
                    $('#hargajual').val(response.error);
                } else {
                    $('#nmbrg').val(response.nmbrg);
                    $('#merk').val(response.merk);
                    $('#hargabeli').val(response.hargabeli);
                    $('#hargajual').val(response.hargajual);
                }
            },
            error: function(response) {
                $('#nmbrg').val('Nama tidak ditemukan');
                $('#merk').val('Merk tidak ditemukan');
                $('#hargabeli').val('Harga tidak ditemukan');
                $('#hargajual').val('Harga tidak ditemukan');
            }
        });
    });

    $('#formupdate').submit(function(e) {
        var items = [];
        $('#items-table tr').each(function() {
            var item = {
                idbrg: $(this).find('td:eq(1)').text(),
                nmbrg: $(this).find('td:eq(2)').text(),
                merk: $(this).find('td:eq(3)').text(),
                jmlbeli: $(this).find('td:eq(4)').text(),
                hargabeli: $(this).find('td:eq(5)').text(),
                hargajual: $(this).find('td:eq(6)').text(),
                totalbeli: $(this).find('td:eq(7)').text()
            };
            items.push(item);
        });
        $('#items').val(JSON.stringify(items));
    });

    // SweetAlert Script
    $('.updateconfirm').click(function(event) {
        var form = $(this).closest("form");
        event.preventDefault(); // Menghentikan form dari pengiriman otomatis
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Pastikan semua data sudah benar sebelum menyimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Mengirim form setelah konfirmasi
                Swal.fire(
                    'Tersimpan!',
                    'Data Anda berhasil diupdate.',
                    'success'
                );
            }
        });
    });

    $('#tgltrxbrg').change(function() {
        var tgltrxbrg1 = $('#tgltrxbrg').val();

        $.ajax({
            type: 'POST',
            url: `{{ route('trxbarang_notabeli') }}`,
            data: {
                tgltrxbrg1: tgltrxbrg1,
                _token: '{{ csrf_token() }}'
            },
            cache: true,
            success: function(response) {
                $('#idtrxbrg').val(response.idtrxbrg);
            }
        });
    });

    $(document).ready(function() {
        var text_val = $(".input-group input").val();
        if (text_val === "") {
            $(".input-group").removeClass('is-filled');
        } else {
            $(".input-group").addClass('is-filled');
        }

        $("#idbrg").select2({
            theme: "classic"
        });

        $("#stumum").select2({
            theme: "classic"
        });

        $("#idspl").select2({
            theme: "classic"
        });

    });
</script>
