<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    <div class="page-content">
        <div class="container mt-5">
            <h2 class="mb-4">Daftar Resep Dokter</h2>
            @foreach($groupedPrescriptions as $rekamid => $prescriptions)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Rekam ID : {{ $rekamid }} </strong><br>
                        <strong>Nama Pasien : {{ DB::table('rekams')->join('pasiens', 'rekams.pasien_id', '=', 'pasiens.id')->where('rekams.id', $rekamid)->value('pasiens.nama_lengkap') ?? 'Tidak Diketahui' }} </strong><br>
                        <strong>Tanggal Pemeriksaan : {{ DB::table('rekams')->where('rekams.id', $rekamid)->value('created_at') ?? 'Tidak Diketahui' }} </strong>
                    </div><br>

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
                            <button type="submit" class="btn btn-primary">Update Pembayaran</button>
                        </form>

                        {{-- Tombol Cetak Resi --}}
                        <a href="{{ route('apoteker.generateReceipt', $rekamid) }}" class="btn btn-success">Cetak Resi Pembayaran</a>

                        {{-- Tombol Tampil Berkas Dokter --}}
                        <a href="{{ $fileUrl }}" class="btn btn-info" target="_blank">Tampil Berkas Dokter</a>
                    </div>
                    
                    <br>
                    <div class="card-body">
                        <style>
                            table {
                                table-layout: fixed;
                                width: 100%;
                            }

                            th, td {
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;
                            }

                            th:nth-child(1), td:nth-child(1) {
                                width: 5%; /* Kolom No */
                                text-align: center;
                            }

                            th:nth-child(2), td:nth-child(2) {
                                width: 60%; /* Kolom Resep */
                                word-wrap: break-word;
                                white-space: normal;
                            }

                            th:nth-child(3), td:nth-child(3) {
                                width: 15%; /* Kolom Aksi */
                                text-align: center;
                            }
                        </style>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Resep</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;  ?>
                                @foreach($prescriptions as $prescription)
                                     
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td style="word-wrap: break-word; max-width: 200px;">
                                            Nama Obat : {{ $prescription->obat->name }} , Jumlah Obat : 1 ,  Aturan Pakai : {{ $prescription->aturan_pakai }} ,


                                            <!-- {{ $prescription->obat }} ::  {{ $prescription->obat->name }} -->
                                        </td>
                                        <td>
                                                @if($prescription->jumlah > 0)
                                                    {{ $prescription->jumlah }}
                                                @else
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalHarga" 
                                                        data-id="{{ $prescription->id }}">
                                                        Input Harga
                                                    </button>
                                                @endif
                                          
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

    <!-- Modal Input Harga -->
    <div class="modal fade" id="modalHarga" tabindex="-1" aria-labelledby="modalHargaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHargaLabel">Input Harga Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formHarga" method="POST" action="{{ route('apoteker.processCost') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="prescription_id" id="prescription_id">
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modalHarga = document.getElementById('modalHarga');
            modalHarga.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var prescriptionId = button.getAttribute('data-id');
                
                document.getElementById('prescription_id').value = prescriptionId;
                document.getElementById('harga').value = harga || '';
            });
        });
    </script>
</x-admint.admin-template>
