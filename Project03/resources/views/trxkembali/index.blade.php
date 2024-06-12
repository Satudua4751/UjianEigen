<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='kembali'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
        <!-- Navbar -->
        <x-navbars.navs.judul titlePage="Pengembalian Buku"></x-navbars.navs.judul>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Daftar Kembali Buku</h4>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            <div class="me-3 my-3 text-end">
                                <a class="btn btn-dark mb-0" href="{{ route('trxkembali.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add" data-container="body" data-animation="true"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add</a>
                            </div>
                            <table id="trxkembali" class="table align-items-center table-hover" width="100%">
                                <thead class="bg-blue-200">
                                    <tr>
                                        <th width="0.5%" class="text-xs">No</th>
                                        <th width="3%" class="text-xs">Nota</th>
                                        <th width="3%" class="text-xs">Tanggal</th>
                                        <th width="1%" class="text-xs">Code</th>
                                        <th width="4%" class="text-xs">Member</th>
                                        <th width="2%" class="text-xs">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 0;
                                    @endphp
                                    @forelse ($trxkembali as $trxpjm)
                                    <tr>
                                        <td class="text-xs text-end" scope="row">{{ ++ $no }}</td>
                                        <td class="text-xs">{{ $trxpjm->idtrx }}</td>
                                        <td class="text-xs">{{ $trxpjm->tgltrx }}</td>
                                        <td class="text-xs">{{ $trxpjm->codem }}</td>
                                        <td class="text-xs">{{ $trxpjm->name }}</td>
                                        <td class="text-xs">
                                            <a href="#" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-container="body" data-animation="true"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <form action="{{ route('trxkembali.destroy', $trxpjm->idtrx) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delconfirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"> <i class="fa-solid fa-trash"></i> </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    </br>
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Daftar Buku</h4>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            </br>
                            <table id="booktbl" class="table align-items-center table-hover" width="100%">
                                <thead class="bg-blue-200">
                                    <tr>
                                        <th width="0.5%" class="text-xs">No</th>
                                        <th width="3%" class="text-xs">Kode</th>
                                        <th width="3%" class="text-xs">Title</th>
                                        <th width="3%" class="text-xs">Author</th>
                                        <th width="2%" class="text-xs">Jumlah Awal</th>
                                        <th width="2%" class="text-xs">Pinjam</th>
                                        <th width="2%" class="text-xs">Kembali</th>
                                        <th width="2%" class="text-xs">Jumlah Akhir</th>
                                        <th width="4%" class="text-xs">Status di Kembalikan </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 0;
                                    @endphp
                                    @forelse ($book1 as $books)
                                    <tr>
                                        <td class="text-xs text-end" scope="row">{{ ++ $no }}</td>
                                        <td class="text-xs">{{ $books->codeb }}</td>
                                        <td class="text-xs">{{ $books->title }}</td>
                                        <td class="text-xs">{{ $books->author }}</td>
                                        <td class="text-xs text-end">{{ $books->stock }}</td>
                                        <td class="text-xs text-end">{{ $books->keluar }}</td>
                                        <td class="text-xs text-end">{{ $books->masuk }}</td>
                                        <td class="text-xs text-end">{{ $books->stock + $books->masuk - $books->keluar }}</td>
                                        @php
                                        $stkembali = (( $books->stock + $books->masuk - $books->keluar )== 0) ? 'belum' : 'ya';
                                        @endphp
                                        <td class="text-xs">{{ $stkembali }}</td>
                                    </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    </br>
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Dafar Member</h4>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            </br>
                            <table id="membertbl" class="table align-items-center table-hover" width="100%">
                                <thead class="bg-blue-200">
                                    <tr>
                                        <th width="0.5%" class="text-xs">No</th>
                                        <th width="3%" class="text-xs">Kode</th>
                                        <th width="3%" class="text-xs">Name</th>
                                        <th width="3%" class="text-xs">Sts.Sangsi</th>
                                        <th width="2%" class="text-xs">Jml Buku yg di kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 0;
                                    @endphp
                                    @forelse ($member1 as $members)
                                    <tr>
                                        <td class="text-xs text-end" scope="row">{{ ++ $no }}</td>
                                        <td class="text-xs">{{ $members->codem }}</td>
                                        <td class="text-xs">{{ $members->name }}</td>
                                        <td class="text-xs">{{ $members->stts }}</td>
                                        <td class="text-xs text-end">{{ $members->total_jmlkembali }}</td>
                                    </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $("#trxkembali").DataTable({
            searching: false,
            bDestroy: true,
            responsive: true,
            processing: true,
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12't>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                extend: 'pageLength',
                text: '<i class="fa fa-book-open"></i> ',
                className: 'btn btn-secondary waves-effect'
            }],
            lengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            // full_numbers,full,simple_numbers,simple,numbers,first_last_numbers
            pagingType: "full_numbers"
        });

        // Function to attach delete confirmation event
        function attachDeleteConfirmation() {
            $('.delconfirm').off('click').on('click', function(event) {
                var form = $(this).closest("form");
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah anda Yakin?',
                    text: 'Anda tidak dapat mengembalikan data!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Data Telah dihapus.',
                            'success'
                        );
                    }
                });
            });
        }

        // Initial attachment of event handler
        attachDeleteConfirmation();

        // Reattach event handler on every draw event
        table.on('draw.dt', function() {
            attachDeleteConfirmation();
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $("#booktbl").DataTable({
            searching: false,
            bDestroy: true,
            responsive: true,
            processing: true,
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12't>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                extend: 'pageLength',
                text: '<i class="fa fa-book-open"></i> ',
                className: 'btn btn-secondary'
            }],
            lengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            // full_numbers,full,simple_numbers,simple,numbers,first_last_numbers
            pagingType: "full_numbers"
        });

        var table = $("#membertbl").DataTable({
            searching: false,
            bDestroy: true,
            responsive: true,
            processing: true,
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12't>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                extend: 'pageLength',
                text: '<i class="fa fa-book-open"></i> ',
                className: 'btn btn-secondary'
            }],
            lengthMenu: [
                [10, 20, -1],
                [10, 20, "All"]
            ],
            // full_numbers,full,simple_numbers,simple,numbers,first_last_numbers
            pagingType: "full_numbers"
        });
    });
</script>
