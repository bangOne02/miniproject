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
                        <h4 class="mb-sm-0">Pendaftaran Pasien</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('front.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pendaftaran Pasien</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form action="{{route('front.pendaftaran')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-xl-4 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <p class="fw-medium text-muted mb-0">Nomor Antrian Ke:</p>
                                                    <h2 class="mt-4 ff-secondary fw-semibold"><span
                                                            class="counter-value" data-target="{{$onProsesAntrian}}">{{$onProsesAntrian}}</span></h2>
                                                    <p class="mb-0 text-muted">Sisa antrian <span
                                                            class="badge bg-light text-success mb-0"><i
                                                                class="ri-arrow-up-line align-middle"></i> {{$totalAntrian}} </span></p>
                                                </div>
                                                <div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                                    <i data-feather="users" class="text-info"></i>
                                                </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="kodePasien" class="form-label">KODE PASIEN <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="text" name="kode_pasien"
                                                   class="form-control @if($errors->has('kode_pasien')) is-invalid @endif"
                                                   aria-label="Check Pasien" id="kodePasien" placeholder="AUTO GENERATE"
                                                   value="{{old('kode_pasien',$dataPasien->kode_pasien ??"")}}"
                                                   readonly>
                                            <button class="btn btn-outline-success" type="button" id="check"
                                                    data-bs-toggle="modal" data-bs-target="#modalPasien"><i
                                                    class="ri-search-2-line"></i></button>
                                            <button class="btn btn-outline-primary" type="button" id="newPasien"><i
                                                    class="ri-add-box-fill"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <label for="namaLengkap" class="form-label">NAMA LENGKAP <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap"
                                               class="form-control @if($errors->has('nama_lengkap')) is-invalid @endif"
                                               placeholder="NAMA LENGKAP" id="namaLengkap"
                                               value="{{old('nama_lengkap',$dataPasien->nama_lengkap ??"")}}">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <label for="tempat_lahir" class="form-label ">TEMPAT LAHIR <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir"
                                               class="form-control @if($errors->has('tempat_lahir')) is-invalid @endif"
                                               placeholder="TEMPAT LAHIR" id="tempat_lahir"
                                               value="{{old('tempat_lahir',$dataPasien->tempat_lahir ??"")}}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="tanggal_lahir" class="form-label">TANGGAL LAHIR <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="tanggal_lahir" class="form-control @if($errors->has('tanggal_lahir')) is-invalid @endif"
                                               placeholder="TANGGAL LAHIR"
                                               id="tanggal_lahir"
                                               value="{{old('tanggal_lahir',$dataPasien->tanggal_lahir ??"")}}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="sex" class="form-label">JENIS KELAMIN </label>
                                        <select name="sex" id="sex" class="form-control select">
                                            <option value="L"
                                                    @if("L" == old('sex',$dataPasien->sex ?? "")) selected @endif>Pria
                                            </option>
                                            <option value="P"
                                                    @if("P" == old('sex',$dataPasien->sex ?? "")) selected @endif>
                                                Wanita
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <label for="agama" class="form-label">AGAMA </label>
                                        <select name="agama" id="agama" class="form-control select">
                                            <option value="ISLAM"
                                                    @if("ISLAM" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                ISLAM
                                            </option>
                                            <option value="KATOLIK"
                                                    @if("KATOLIK" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                KATOLIK
                                            </option>
                                            <option value="KRISTEN"
                                                    @if("KRISTEN" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                KRISTEN
                                            </option>
                                            <option value="HINDU"
                                                    @if("HINDU" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                HINDU
                                            </option>
                                            <option value="BUDHA"
                                                    @if("BUDHA" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                BUDHA
                                            </option>
                                            <option value="KONGHUCU"
                                                    @if("KONGHUCU" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                KONGHUCU
                                            </option>
                                            <option value="KEPERCAYAAN"
                                                    @if("KEPERCAYAAN" == old('agama',$dataPasien->agama ?? "")) selected @endif>
                                                KEPERCAYAAN
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="pendidikan" class="form-label">PENDIDIKAN </label>
                                        <select name="pendidikan" id="pendidikan" class="form-control select">
                                            <option value="SD"
                                                    @if("SD" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                SD
                                            </option>
                                            <option value="SMP"
                                                    @if("SMP" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                SMP
                                            </option>
                                            <option value="SMA/SMK"
                                                    @if("SMA/SMK" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                SMA/SMK
                                            </option>
                                            <option value="D1/D2/D3"
                                                    @if("D1/D2/D3" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                D1/D2/D3
                                            </option>
                                            <option value="S1"
                                                    @if("S1" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                S1
                                            </option>
                                            <option value="S2"
                                                    @if("S2" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                S2
                                            </option>
                                            <option value="S3"
                                                    @if("S3" == old('pendidikan',$dataPasien->pendidikan ?? "")) selected @endif>
                                                S3
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="golongan_darah" class="form-label">GOLONGAN DARAH </label>
                                        <select name="golongan_darah" id="golongan_darah" class="form-control select">
                                            <option value="A"
                                                    @if("A" == old('golongan_darah',$dataPasien->gol_darah ?? "")) selected @endif>
                                                A
                                            </option>
                                            <option value="B"
                                                    @if("B" == old('golongan_darah',$dataPasien->gol_darah ?? "")) selected @endif>
                                                B
                                            </option>
                                            <option value="AB"
                                                    @if("AB" == old('golongan_darah',$dataPasien->gol_darah ?? "")) selected @endif>
                                                AB
                                            </option>
                                            <option value="O"
                                                    @if("O" == old('golongan_darah',$dataPasien->gol_darah ?? "")) selected @endif>
                                                O
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <label for="phone" class="form-label">PHONE </label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                               placeholder="PHONE" value="{{old('phone',$dataPasien->phone ?? "")}}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="pekerjaan" class="form-label">PEKERJAAN </label>
                                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control"
                                               placeholder="PEKERJAAN"
                                               value="{{old('pekerjaan',$dataPasien->pekerjaan ?? "")}}">
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-12">
                                        <label for="alamat" class="form-label">ALAMAT </label>
                                        <textarea name="alamat" class="form-control" id="alamat" cols="30"
                                                  rows="3">{{old('alamat',$dataPasien->alamat ?? "")}}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!--end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="tekanan_darah" class="form-label">TEKANAN DARAH (TD) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="tekanan_darah" id="tekanan_darah"
                                               class="form-control @if($errors->has('tekanan_darah')) is-invalid @endif" placeholder="mmHg" value="{{old('tekanan_darah')}}" maxlength="3">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label for="dokter_id" class="form-label">POLIKLINIK</label>
                                        <select name="dokter_id" id="dokter_id" class="form-control select @if($errors->has('dokter_id')) is-invalid @endif">
                                            @foreach($dataPoli as $poli)
                                                <option value="{{base64_encode($poli->dokter->id ?? "")}}" @if(base64_encode($poli->dokter->id) == old('dokter_id') ) selected @endif>{{$poli->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label for="rate" class="form-label">RATE <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="rate" name="rate" class="form-control @if($errors->has('rate')) is-invalid @endif" placeholder="x/min" value="{{old('rate')}}" maxlength="3">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label for="suhu_badan" class="form-label">SUHU <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="suhu_badan" name="suhu_badan" class="form-control @if($errors->has('suhu_badan')) is-invalid @endif" placeholder="*C" value="{{old('suhu_badan')}}" maxlength="3">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label for="berat_badan" class="form-label">BERAT BADAN <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="berat_badan" name="berat_badan" class="form-control @if($errors->has('berat_badan')) is-invalid @endif" placeholder="kg" value="{{old('berat_badan')}}" maxlength="3">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label for="tinggi_badan" class="form-label">TINGGI BADAN <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control @if($errors->has('tinggi_badan')) is-invalid @endif" placeholder="cm" value="{{old('tinggi_badan')}}" maxlength="3">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <label for="keluhan_utama" class="form-label">KELUHAN <span
                                                class="text-danger">*</span></label>
                                        <textarea name="keluhan_utama" class="form-control @if($errors->has('keluhan_utama')) is-invalid @endif" id="keluhan_utama" cols="30" rows="3">{{old('keluhan_utama')}}</textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <button class="btn btn-sm btn-success" type="submit">SIMPAN</button>
                                        <a href="{{route('front.pendaftaran')}}">
                                            <button class="btn btn-sm btn-danger" type="button">RESET</button>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!--end row-->
            </form>
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
            const modalPasien = document.getElementById('modalPasien');
            const kodePasien = document.getElementById('kodePasien');
            const namaPasien = document.getElementById('namaLengkap');
            const tempatLahir = document.getElementById('tempat_lahir');
            const tanggalLahir = document.getElementById('tanggal_lahir');
            const sex = document.getElementById('sex');
            const agama = document.getElementById('agama');
            const pendidikan = document.getElementById('pendidikan');
            const golonganDarah = document.getElementById('golongan_darah');
            const phone = document.getElementById('phone');
            const pekerjaan = document.getElementById('pekerjaan');
            const alamat = document.getElementById('alamat');
            const tekananDarah = document.getElementById('tekanan_darah');
            const rate = document.getElementById('rate');
            const suhuBadan = document.getElementById('suhu_badan');
            const beratBadan = document.getElementById('berat_badan');
            const tinggiBadan = document.getElementById('tinggi_badan');
            const keluhanUtama = document.getElementById('keluhan_utama');
            const dokterId = document.getElementById('dokter_id');

            function generateNewCode() {
                let urlGenerateCode = '{{route('front.ajax.getCode')}}';
                if (kodePasien.classList.contains("is-invalid")) {
                    kodePasien.classList.remove("is-invalid");
                }
                removeClassArray([kodePasien, namaPasien, tempatLahir,tanggalLahir,tekananDarah,rate,suhuBadan,beratBadan,tinggiBadan,keluhanUtama,dokterId]);
                $.ajax({
                    url: urlGenerateCode,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        kodePasien.value = response;
                        clearInput();
                    },
                    error: function (request, error) {
                        console.log(error);
                    }
                });
            }

            function removeClassWithEvent(Object, event) {
                for (let i = 0; i < Object.length; i++) {
                    Object[i].addEventListener(event, function () {
                        removeClass(Object[i]);
                    });
                }
            }

            function removeClassArray(Object) {
                for (let i = 0; i < Object.length; i++) {
                    removeClass(Object[i]);
                }
            }

            function removeClass(Object) {
                if (Object.classList.contains("is-invalid")) {
                    Object.classList.remove("is-invalid");
                }
            }

            function clearInput() {
                namaPasien.value = "";
                tempatLahir.value = "";
                tanggalLahir.value = "";
                sex.value = "L";
                agama.value = "ISLAM";
                pendidikan.value = "SD";
                golonganDarah.value = "A";
                phone.value = "";
                pekerjaan.value = "";
                alamat.value = "";
            }

            setTimeout(function () {
                    $('.alert').fadeOut('slow');
                }, 2000
            );

            $(document).on("click", ".open-selected", function (e) {
                e.preventDefault();
                let fid = $(this).data('id');
                window.location.href = "{{ route('front.pendaftaran')."?pasien="}}" + fid;
            })

            $('.modal').on('hidden.bs.modal', function (e) {
                e.preventDefault();
                let errorInput = $('.errorInput');
                let errorLabel = $('.errorLabel');
                errorInput.removeClass('is-invalid');
                errorLabel.removeClass('text-danger');
            });

            $(document).ready(function () {

                removeClassWithEvent([namaPasien, tempatLahir,tekananDarah,rate,suhuBadan,beratBadan,tinggiBadan,keluhanUtama], 'keypress');
                removeClassWithEvent([tanggalLahir,dokterId], 'change');

                flatpickr(tanggalLahir, {
                    altInput: false,
                    altFormat: "F j, Y",
                    dateFormat: "Y-m-d",
                });

                let base_url = "{{route('front.ajax.getdatapasien')}}";
                let buttonNew = document.getElementById('newPasien');
                buttonNew.addEventListener("click", generateNewCode);

                $('#tablePasien').DataTable({
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
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {data: 'kode_pasien', class: 'text-left', width: '10%'},
                        {data: 'nama_lengkap', class: 'text-left'},
                        {data: 'alamat', class: 'text-left'},
                        {data: 'phone', class: 'text-center', width: '5%'},
                        {data: 'action', class: 'text-center', width: '10%', orderable: false},
                    ],
                    "bDestroy": true
                });
            });
        </script>

    @endpush
</x-admint.admin-template>
