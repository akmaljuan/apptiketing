<x-layouts.admin title="Data Lokasi">
    <div class="container mx-auto p-10">

        <div class="card bg-base-100 shadow-sm">
            <div class="card-body">

                <h2 class="card-title text-2xl mb-6">Daftar Lokasi</h2>

                {{-- Alert success --}}
                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Form tambah lokasi --}}
                <form method="POST" action="{{ route('admin.lokasi.store') }}" class="flex gap-2 mb-6">
                    @csrf
                    <input
                        type="text"
                        name="nama_lokasi"
                        placeholder="Contoh: Stadion Utama"
                        class="input input-bordered w-full"
                        required
                    >
                    <button class="btn btn-primary">Tambah</button>
                </form>

                {{-- Tabel lokasi --}}
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lokasis as $lokasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lokasi->nama_lokasi }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-gray-500">
                                        Belum ada data lokasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</x-layouts.admin>
