<x-admint.admin-template :title="$title" :first-menu="$firstMenu" :second-menu="$secondMenu">
    <div class="page-content">
        <div class="container">
            <h2 class="mt-4 mb-3">Daftar Obat</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama Obat</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicines as $index => $medicine)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $medicine['id'] ?? 'Tidak tersedia' }}</td>
                            <td>{{ $medicine['name'] ?? 'Tidak ada deskripsi' }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="showPriceModal('{{ $medicine['id'] }}')">
                                    Lihat Harga
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data obat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="priceModalLabel">Harga Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Harga</th>
                                <th>Mulai</th>
                                <th>Berakhir</th>
                            </tr>
                        </thead>
                        <tbody id="priceList">
                            <!-- Data akan dimasukkan lewat JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Menampilkan Modal -->
    <script>
        function showPriceModal(medicineId) {
            let url = "{{ route('apoteker.medicinePrice', ':id') }}".replace(':id', medicineId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    let priceList = document.getElementById('priceList');
                    priceList.innerHTML = ""; // Kosongkan isi modal sebelum diisi

                    if (data.prices.length > 0) {
                        data.prices.forEach(price => {
                            let row = `
                                <tr>
                                    <td>Rp ${price.unit_price}</td>
                                    <td>${price.start_date}</td>
                                    <td>${price.end_date}</td>
                                </tr>
                            `;
                            priceList.innerHTML += row;
                        });
                    } else {
                        priceList.innerHTML = "<tr><td colspan='3' class='text-center'>Tidak ada harga tersedia</td></tr>";
                    }

                    new bootstrap.Modal(document.getElementById('priceModal')).show();
                })
                .catch(error => {
                    console.error('Error fetching medicine price:', error);
                    alert('Gagal mengambil harga obat.');
                });
        }
    </script>
</x-admint.admin-template>
