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
                        <h4 class="mb-sm-0">Edit Data Dokter</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adm.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('adm.dokter')}}">Dokter</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form action="{{route('adm.dokter.update')}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="hidden" name="user_id" value="{{old('user_id',encrypt($dataDokter->id) ?? "")}}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                    <label for="nip" class="form-label">NIP<span
                                                            class="text-danger"> *</span></label>
                                                    <input name="nip" type="text"
                                                           class="form-control @if($errors->has('nip')) is-invalid @endif"
                                                           id="nip" value="{{old('nip',$dataDokter->karyawandokter->nip ?? "")}}"
                                                           placeholder="Masukkan NIP" >
                                            </div>
                                            <div class="col-lg-6">
                                                    <label for="email" class="form-label">Email <span
                                                            class="text-danger"> *</span></label>
                                                    <input name="email" type="email"
                                                           class="form-control @if($errors->has('email')) is-invalid @endif"
                                                           id="email" value="{{old('email',$dataDokter->email ?? "")}}"
                                                           placeholder="Masukkan Email" >
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                    <label for="name" class="form-label">Nama Lengkap <span
                                                            class="text-danger"> *</span></label>
                                                    <input name="name" type="text"
                                                           class="form-control @if($errors->has('name')) is-invalid @endif"
                                                           id="name" value="{{old('name',$dataDokter->name ?? "")}}"
                                                           placeholder="Masukkan Nama Lengkap" >
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <label for="izin" class="form-label">Nomor Izin <span
                                                        class="text-danger"> *</span></label>
                                                <input name="izin" type="text"
                                                       class="form-control @if($errors->has('izin')) is-invalid @endif"
                                                       id="izin" value="{{old('izin',$dataDokter->karyawandokter->dokter->no_izin)}}"
                                                       placeholder="Nomor Izin" >
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <label for="poli_id" class="form-label">Poliklinik <span
                                                        class="text-danger"> *</span></label>
                                                <select name="poli_id" class="form-control select" id="poli">
                                                    @foreach($dataPoliklinik as $poli)
                                                        <option value="{{base64_encode($poli->id)}}" @if(base64_encode($poli->id) == old('poli_id',base64_encode($dataDokter->karyawandokter->dokter->poliklinik_id ?? "")))selected @endif>{{strtoupper($poli->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="phone" class="form-label">Phone </label>
                                                    <input name="phone" type="text"
                                                           class="form-control @if($errors->has('phone')) is-invalid @endif"
                                                           id="phone" value="{{old('phone',$dataDokter->karyawandokter->phone ?? "")}}"
                                                           placeholder="Phone" >
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                    <label for="sex" class="form-label">Jenis Kelamin </label>
                                                    <select name="sex" id="sex" class="form-control select">
                                                        <option value="L" @if("L" == old('sex',$dataDokter->karyawandokter->sex ?? "")) selected @endif>Pria</option>
                                                        <option value="P" @if("P" == old('sex',$dataDokter->karyawandokter->sex ?? "")) selected @endif>Wanita</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-12">
                                                <label for="alamat" class="form-label">Alamat </label>
                                                <textarea name="alamat" class="form-control @if($errors->has('alamat')) is-invalid @endif" id="alamat" cols="30" rows="10">{{old('alamat',$dataDokter->karyawandokter->alamat ?? "")}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <span class="text-small text-danger">( * ) Wajib diisi</span>
                                    </div>
                                    <div class="col-lg-12">
                                        <span class="text-small text-danger">Password tidak berubah saat diupdate, hanya user yang bisa merubah password!</span>
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
                                        <a href="{{route('adm.dokter')}}">
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
            let nip = document.getElementById("nip");
            let email = document.getElementById("email");
            let name = document.getElementById("name");
            let role = document.getElementById("role");
            let sex = document.getElementById("sex");
            let phone = document.getElementById("phone");
            let alamat = document.getElementById("alamat");

            removeClassWhenKeypress(nip);
            removeClassWhenKeypress(email);
            removeClassWhenKeypress(name);
            removeClassWhenChange(role);
            removeClassWhenChange(sex);
            removeClassWhenChange(phone);
            removeClassWhenChange(alamat);

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
