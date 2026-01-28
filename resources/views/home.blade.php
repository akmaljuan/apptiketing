<x-layouts.app>
    <!-- HERO -->
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-indigo-900 to-black">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative z-10 text-center text-white px-6">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                Amankan Tiket Event Favoritmu <br class="hidden md:block">
                <span class="text-blue-400">Tanpa Ribet</span>
            </h1>

            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-200 mb-8">
                BengTix adalah platform beli tiket event dengan proses cepat,
                aman, dan pastinya auto asik 🎉
            </p>

            <a href="#event"
               class="inline-block px-8 py-4 bg-blue-600 hover:bg-blue-700 transition
                      rounded-full font-semibold text-white shadow-lg">
                Jelajahi Event
            </a>
        </div>
    </section>

    <!-- EVENT SECTION -->
    <section id="event" class="max-w-7xl mx-auto py-16 px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h2 class="text-3xl font-extrabold uppercase tracking-wide">
                    Event Terbaru
                </h2>
                <p class="text-gray-500 mt-2">
                    Pilih event sesuai minatmu dan pesan sekarang
                </p>
            </div>

            <!-- Category Filter -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home') }}">
                    <x-user.category-pill
                        label="Semua"
                        :active="!request('kategori')" />
                </a>

                @foreach($categories as $kategori)
                    <a href="{{ route('home', ['kategori' => $kategori->id]) }}">
                        <x-user.category-pill
                            :label="$kategori->nama"
                            :active="request('kategori') == $kategori->id" />
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Event Grid -->
        @if($events->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($events as $event)
                    <x-user.event-card
                        :title="$event->judul"
                        :date="$event->tanggal_waktu"
                        :location="$event->lokasi?->nama_lokasi"
                        :price="$event->tikets_min_harga"
                        :image="$event->gambar"
                        :href="route('events.show', $event)" />
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 text-gray-500">
                <p class="text-lg font-semibold">
                    Event belum tersedia 😢
                </p>
                <p class="mt-2">
                    Silakan cek kembali di lain waktu
                </p>
            </div>
        @endif
    </section>

    <!-- FOOTER PROMO -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-5xl mx-auto text-center px-6">
            <h3 class="text-2xl md:text-3xl font-bold mb-4">
                Jangan Sampai Kehabisan Tiket!
            </h3>
            <p class="text-gray-600 mb-6">
                Event populer cepat habis. Pesan sekarang sebelum terlambat.
            </p>
            <a href="#event"
               class="inline-block px-8 py-3 bg-blue-600 hover:bg-blue-700 transition
                      text-white rounded-lg font-semibold">
                Lihat Event
            </a>
        </div>
    </section>
</x-layouts.app>
