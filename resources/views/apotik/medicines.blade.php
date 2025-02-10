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
                <th>Id</th>
                <th>Nama Obat</th>
                <th>Harga</td>
            </tr>
        </thead>
        <tbody>
            @forelse($medicines as $index => $medicine)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $medicine['id'] ?? 'Tidak tersedia' }}</td>
                    <td>{{ $medicine['name'] ?? 'Tidak ada deskripsi' }}</td>
                    <td><a href="{{ route('apoteker.medicinePrice', $medicine['id']) }}">Lihat Harga</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data obat</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
    </div>
</x-admint.admin-template>
