<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    @push('customCss')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
        <!--datatable responsive css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    @endpush
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <x-admint.error-message-component/>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-transparent">
                        <h4 class="mb-sm-0">Data Obat</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data Obat</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('adm.obat.add')}}">
                            <button class="btn btn-sm btn-primary">
                                ADD
                            </button></a>
                        </div>
                        <div class="card-body">
                            <table id="tableObat"
                                   class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th data-ordering="false" class="text-center">No.</th>
                                    <th data-ordering="false" class="text-center">CODE</th>
                                    <th data-ordering="false" class="text-center">NAME</th>
                                    <th data-ordering="false" class="text-center">KATEGORI</th>
                                    <th data-ordering="false" class="text-center">GOLONGAN</th>
                                    <th data-ordering="false" class="text-center">PRODUSEN</th>
                                    <th data-ordering="false" class="text-center">STOCK</th>
                                    <th data-ordering="false" class="text-center">HARGA</th>
                                    <th data-ordering="false" class="text-center">CREATED AT</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

        </div>
        <!-- container-fluid -->
    </div>

    <!-- Start: Modal HAPUS-->
    <div class="modal fade" id="modalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">
                <form action="{{route('adm.obat.delete')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="hidden" name="obat_id" id="obat_id_delete">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-12 text-center">
                                <p>Apakah anda ingin menghapus data ini?</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- End: Modal HAPUS-->

    @push('customJs')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <script>

            let input = $('.inputForm');

            input.keyup(function () {
                let val = $(this).val().toLowerCase();
                $(this).val(val);
            })

            setTimeout(function () {
                    $('.alert').fadeOut('slow');
                }, 2000
            );

            $(document).on("click", ".open-hapus", function (e) {
                e.preventDefault();
                let fid = $(this).data('id');
                $('#obat_id_delete').val(fid);
            })

            $('.modal').on('hidden.bs.modal', function (e) {
                e.preventDefault();
                let errorInput = $('.errorInput');
                let errorLabel = $('.errorLabel');
                errorInput.removeClass('is-invalid');
                errorLabel.removeClass('text-danger');
            });

            $(document).ready(function () {
                let base_url = "{{route('adm.obat')}}";
                $('#tableObat').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        type: 'GET',
                        url: base_url,
                        async: true,
                        dataType: 'json',
                    },
                    columns: [
                        {
                            data: 'index',
                            class: 'text-center',
                            defaultContent: '',
                            orderable: false,
                            searchable: false,
                            width: '5%',
                            render: function (data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1; //auto increment
                            }
                        },
                        {data: 'code', class: 'text-left',width: '10%'},
                        {data: 'name', class: 'text-left'},
                        {data: 'kategori', class: 'text-center',width: '15%'},
                        {data: 'golongan', class: 'text-center',width: '15%'},
                        {data: 'produsen', class: 'text-center',width: '10%'},
                        {data: 'stock', class: 'text-center',width: '5%'},
                        {data: 'price', class: 'text-left',width: '10%'},
                        {data: 'created_at', class: 'text-center', width: '10%'},
                        {data: 'action', class: 'text-center', width: '15%', orderable: false},
                    ],
                    "bDestroy": true
                });
            });

        </script>
    @endpush
</x-admint.admin-template>
