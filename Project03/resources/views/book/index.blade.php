<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='book'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-md ">
        <!-- Navbar -->
        <x-navbars.navs.judul titlePage="Book"></x-navbars.navs.judul>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-md pt-4 pb-3">
                                <h4 class="text-white text-capitalize ps-3">Book</h4>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2 mt-n4 mx-3">
                            <div class="my-3 text-end">
                                <a href="{{ route('book.create') }}" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="material-icons">add</i>&nbsp;&nbsp;Add</a>
                                <a href="http://localhost:8000/api/documentation" target="_blank" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Add"><i class="material-icons">book</i>&nbsp;&nbsp;Dok-Api</a>
                            </div>
                            <div class="table-responsive p-0">
                                <table id="brgjasatbl1" class="table align-items-center table-hover" width="100%">
                                    <thead class="bg-blue-200">
                                        <tr>
                                            <th width="0.5%" class="text-xs">No</th>
                                            <th width="3%" class="text-xs">Code</th>
                                            <th width="4%" class="text-xs">Title</th>
                                            <th width="2%" class="text-xs">Author</th>
                                            <th width="2%" class="text-xs">Stock</th>
                                            <th width="2%" class="text-xs">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no = 0;
                                        @endphp
                                        @forelse ($book as $datas)
                                        <tr>
                                            <td class="text-xs text-end" scope="row">{{ ++ $no }}</td>
                                            <td class="text-xs">{{ $datas->codeb }}</td>
                                            <td class="text-xs">{{ $datas->title }}</td>
                                            <td class="text-xs">{{ $datas->author }}</td>
                                            <td class="text-xs text-end">{{ number_format($datas->stock,2) }}</td>
                                            <td>
                                                <a href="{{ route('book.show', $datas->codeb) }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i class="fa-solid fa-magnifying-glass"></i></a>
                                                <a href="{{ route('book.edit', $datas->codeb) }}" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                                <form action="{{ route('book.destroy', $datas->codeb) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delconfirm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </br>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>
<script type="text/javascript">
    $(document).ready(function() {
        $(function() {
            var table = $("#brgjasatbl1").DataTable({
                searching: true,
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
        $('#brgjasatbl1').parent().addClass("table-responsive");
    });
</script>
