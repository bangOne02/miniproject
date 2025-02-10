<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    <div class="page-content">
        <div class="container mt-5">
            <h2 class="mb-4">Daftar Resep Dokter</h2>
            @foreach($groupedPrescriptions as $rekamid => $prescriptions)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Rekam ID: {{ $rekamid }} </strong><br>
                        <strong>Nama Pasien: {{ DB::table('rekams')
                    ->join('pasiens', 'rekams.pasien_id', '=', 'pasiens.id')
                    ->where('rekams.id', $rekamid)
                    ->value('pasiens.nama_lengkap') ?? 'Tidak Diketahui' }} </strong>
                    </div><br>
                    <!-- <div>
                    @php
                        $filePath = DB::table('rekams')
                            ->join('berkas_pemeriksaan', 'rekams.id', '=', 'berkas_pemeriksaan.rekam_id')
                            ->where('rekams.id', $rekamid)
                            ->value('berkas_pemeriksaan.file_path');

                        $fileUrl = $filePath ? asset('storage/' . $filePath) : '#';
                    @endphp

                        &nbsp;<a>
                        <form action="{{ route('apoteker.processPayment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="rekam_id" value="{{ $rekamid }}">
                            <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
                        </form>
                        </a>
                        &nbsp;<a href="{{ route('apoteker.generateReceipt', $rekamid) }}" class="btn btn-success">Cetak Resi</a>
                        &nbsp;<a href="{{ $fileUrl }}" class="btn btn-success">Tampil Berkas Dokter</a>
                    </div> -->

                    <div class="d-flex gap-2">
                        @php
                            $filePath = DB::table('rekams')
                                ->join('berkas_pemeriksaan', 'rekams.id', '=', 'berkas_pemeriksaan.rekam_id')
                                ->where('rekams.id', $rekamid)
                                ->value('berkas_pemeriksaan.file_path');

                            $fileUrl = $filePath ? asset('storage/' . $filePath) : '#';
                        @endphp

                        {{-- Tombol Proses Pembayaran --}}&nbsp;&nbsp;
                        <form action="{{ route('apoteker.processPayment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="rekam_id" value="{{ $rekamid }}">
                            <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
                        </form>

                        {{-- Tombol Cetak Resi --}}
                        <a href="{{ route('apoteker.generateReceipt', $rekamid) }}" class="btn btn-success">Cetak Resi</a>

                        {{-- Tombol Tampil Berkas Dokter --}}
                        <a href="{{ $fileUrl }}" class="btn btn-info" target="_blank">Tampil Berkas Dokter</a>
                    </div>
                    
                    <br>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Obat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;  ?>
                                @foreach($prescriptions as $prescription)
                                     
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td style="word-wrap: break-word; max-width: 200px;">
                                            Nama Obat : {{ $prescription->obat->name }} , Type Obat : {{ $prescription->obat->type }} , Harga Obat : {{ $prescription->obat->price }}  


                                            <!-- {{ $prescription->obat }} ::  {{ $prescription->obat->name }} -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-admint.admin-template>
