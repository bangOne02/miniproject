<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    @push('customCss')
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
                        <h4 class="mb-sm-0">Tambah Data Obat</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('adm.obat')}}">Data Obat</a></li>
                                <li class="breadcrumb-item active">Add</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{route('adm.obat.save')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="namaObat" class="form-label">Nama Obat <span
                                                            class="text-danger">*</span></label>
                                                    <input name="name" type="text"
                                                           class="form-control @if($errors->has('name')) is-invalid @endif"
                                                           id="namaObat" value="{{old('name')}}"
                                                           placeholder="Masukkan Nama Obat" required>
                                                </div>

                                            </div>
                                            <div class="col-lg-3">
                                                <div>
                                                    <label for="golonganObat" class="form-label">Golongan Obat <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select @if($errors->has('golongan_id')) is-invalid @endif" name="golongan_id"
                                                            id="golonganObat" required>
                                                        <option value="">Pilih Golongan</option>
                                                        @foreach($optionGolongan as $golongan)
                                                            <option value="{{base64_encode($golongan->id)}}"
                                                                    @if(base64_encode($golongan->id) == old('golongan_id')) selected @endif>{{$golongan->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div>
                                                    <label for="kategoriObat" class="form-label">Kategori Obat <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select @if($errors->has('kategori_id')) is-invalid @endif" name="kategori_id"
                                                            id="kategoriObat" required>
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach($optionKategori as $kategori)
                                                            <option value="{{base64_encode($kategori->id)}}"
                                                                    @if(base64_encode($kategori->id) == old('kategori_id')) selected @endif>{{$kategori->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="produsen_id" class="form-label">Produsen <span
                                                            class="text-danger">*</span></label>
                                                    <select name="produsen_id" class="form-control select @if($errors->has('produsen_id')) is-invalid @endif" id="produsen_id" required>
                                                        <option value="">Pilih Produsen Obat</option>
                                                        @foreach($optionProdusen as $produsen)
                                                            <option value="{{base64_encode($produsen->id)}}"
                                                                    @if(base64_encode($produsen->id) == old('produsen_id')) selected @endif>{{$produsen->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-3">
                                                <div>
                                                    <label for="tipeObat" class="form-label">Tipe Obat <span
                                                            class="text-danger">*</span></label>
                                                    <select name="type" class="form-control select @if($errors->has('type')) is-invalid @endif" id="tipeObat" required>
                                                        <option value="">Pilih Tipe</option>
                                                        <option value="serbuk" @if(old('type') == "serbuk") selected @endif>Serbuk</option>
                                                        <option value="kapsul" @if(old('type') == "kapsul") selected @endif>Kapsul</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div>
                                                    <label for="hargaObat" class="form-label">Harga <span
                                                            class="text-danger">*</span></label>
                                                    <input name="price" type="number"
                                                           class="form-control @if($errors->has('price')) is-invalid @endif"
                                                           id="hargaObat"
                                                           placeholder="0"  required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div>
                                                    <label for="stockObat" class="form-label">Stok <span
                                                            class="text-danger">*</span></label>
                                                    <input name="stock" type="number" class="form-control @if($errors->has('stock')) is-invalid @endif"
                                                           id="stockObat" placeholder="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card card-animate bg-primary">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-medium text-white-50 mb-0">Total Data Obat</p>
                                                        <h2 class="mt-4 ff-secondary fw-semibold text-white"><span
                                                                class="counter-value" data-target="{{$jumlahObat}}">{{$jumlahObat}}</span> Item</h2>
                                                        <p class="mb-0 text-white-50"><span
                                                                class="badge bg-white bg-opacity-25 text-white mb-0"><i
                                                                    class="ri-arrow-down-line align-middle"></i> 0 % </span>
                                                            vs. previous month</p>
                                                    </div>
                                                    <div>
                                                        <div class="avatar-sm flex-shrink-0">
                                                    <span
                                                        class="avatar-title bg-white bg-opacity-25 rounded-circle fs-2">
                                                        <i data-feather="clock" class="text-white"></i>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div> <!-- end card-->
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit"
                                                class="btn btn-success btn-label waves-effect waves-light"><i
                                                class="ri-save-2-fill label-icon align-middle fs-16 me-2"></i> SIMPAN
                                        </button>
                                        <a href="{{route('adm.obat')}}">
                                            <button type="button" class="btn btn-danger m-1">BATAL</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
        <!-- container-fluid -->
    </div>

    @push('customJs')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
            let namaObat = document.getElementById("namaObat");
            let hargaObat = document.getElementById("hargaObat");
            let stockObat = document.getElementById("stockObat");
            let golonganObat = document.getElementById("golonganObat");
            let kategoriObat = document.getElementById("kategoriObat");
            let tipeObat = document.getElementById("tipeObat");

            removeClassWhenKeypress(namaObat);
            removeClassWhenKeypress(hargaObat);
            removeClassWhenKeypress(stockObat);
            removeClassWhenChange(golonganObat);
            removeClassWhenChange(kategoriObat);
            removeClassWhenChange(tipeObat);

            setTimeout(function () {
                    $('.alert').fadeOut('slow');
                }, 2000
            );

            function removeClassWhenKeypress(Object)
            {
                Object.addEventListener('keypress', function () {
                    if (Object.classList.contains("is-invalid")) {
                        Object.classList.remove("is-invalid");
                    }
                });
            }

            function removeClassWhenChange(Object)
            {
                Object.addEventListener('change', function () {
                    if (Object.classList.contains("is-invalid")) {
                        Object.classList.remove("is-invalid");
                    }
                });
            }

        </script>
    @endpush
</x-admint.admin-template>
