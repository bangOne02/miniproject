<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    @push('customCss')
        <!--datatable css-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
        <!--picker-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            .select option {
                color: whitesmoke !important;
                background: #3b439d !important;
            }
        </style>
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
                        <h4 class="mb-sm-0">Pemeriksaan Pasien</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dokter.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pemeriksaan Pasien</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
                <div class="row">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Total Pasien</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$dataRekam->count()}}">{{$dataRekam->count()}}</span></h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-4">
                                                    <i class="ri-ticket-2-line"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Antrian Menunggu</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$dataRekam->where('status',0)->count()}}">{{$dataRekam->where('status',0)->count()}}</span></h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-4">
                                                    <i class="mdi mdi-timer-sand"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Pasien Telah Ditangani </p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="{{$totalSelesai}}">{{$totalSelesai}}</span></h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-4">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="fw-medium text-muted mb-0">Total Income</p>
                                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="0">0</span></h2>
                                    </div>
                                    <div>
                                        <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-4">
                                                    <i class="ri-delete-bin-line"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div>
                    <!--end col-->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="ticketsList">
                            <div class="card-header border-0">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-0 flex-grow-1">DAFTAR PASIEN</h5>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex flex-wrap gap-2">
                                            <a href="{{route('dokter.pemeriksaan.proses')}}"><button class="btn btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> PROSES PASIEN</button></a>
                                            <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end card-body-->
                            <div class="card-body">
                                <div class="table-responsive table-card mb-4">
                                    <table class="table align-middle table-nowrap mb-0" id="ticketTable">
                                        <thead>
                                        <tr>
                                            <th class="sort text-center" data-sort="id" style="width: 15%">ID</th>
                                            <th class="sort text-center" data-sort="keluhan" >KELUHAN SAKIT</th>
                                            <th class="sort text-center" data-sort="nama_pasien" style="width: 10%">NAMA PASIEN</th>
                                            <th class="sort text-center" data-sort="golongan_darah"  style="width: 5%">GOL-DARAH</th>
                                            <th class="sort text-center" data-sort="usia" style="width: 5%">USIA</th>
                                            <th class="sort text-center" data-sort="status" style="width: 15%">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all" id="ticket-list-data">
                                        @foreach($dataRekam as $row)
                                        <tr>
                                                <td class="id" ><a href="#" class="fw-medium link-primary">#{{$row->pasien->kode_pasien ?? "0"}}</a></td>
                                                <td class="text-start">{{$row->keluhan_utama ?? ""}}</td>
                                                <td class="text-start">{{$row->pasien->nama_lengkap ?? ""}}</td>
                                                <td class="text-center">{{$row->pasien->gol_darah ?? ""}}</td>
                                                <td class="text-center">{{$row->pasien->age ?? ""}}</td>

                                                <td class="text-center"><span class="badge bg-warning-subtle text-warning text-uppercase">Waiting</span></td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#8c68cd,secondary:#4788ff" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted mb-0">We've searched more than 150+ Tickets We did not find any Tickets for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Previous
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Next
                                        </a>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body p-5 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#8c68cd,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                                <div class="mt-4 text-center">
                                                    <h4>You are about to delete a order ?</h4>
                                                    <p class="text-muted fs-14 mb-4">Deleting your order will remove all of your information from our database.</p>
                                                    <div class="hstack gap-2 justify-content-center remove">
                                                        <button class="btn btn-link link-primary fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</button>
                                                        <button class="btn btn-danger" id="delete-record">Yes, Delete It</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end modal -->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                </div>

        </div>
        <!-- container-fluid -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Temukan Pasien</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tablePasien"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th data-ordering="false" class="text-center">No.</th>
                            <th data-ordering="false" class="text-center">KODE PASIEN</th>
                            <th data-ordering="false" class="text-center">NAMA</th>
                            <th data-ordering="false" class="text-center">ALAMAT</th>
                            <th data-ordering="false" class="text-center">PHONE</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    @push('customJs')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!--datatable js-->
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
        <!--picker-->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>

        </script>

    @endpush
</x-admint.admin-template>
