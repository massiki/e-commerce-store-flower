<div>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-pink-50 via-white to-pink-100 overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-30 bg-[url('https://www.transparenttextures.com/patterns/dust.png')]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20 pb-24 md:pt-32 md:pb-40">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-center md:text-left">
                    <span class="inline-block py-1 px-3 rounded-full bg-pink-100 text-pink-600 text-sm font-semibold mb-4 animate-bounce">
                        🌸 Spesial Valentine Diskon 20%
                    </span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                        Kirim Bunga <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-400">Terindah</span> Untuk Orang Tersayang
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto md:mx-0">
                        Ungkapkan perasaanmu melalui rangkaian bunga premium kami. Pengiriman cepat, aman, dan dijamin segar sampai di tujuan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="{{ route('products.index') }}" wire:navigate class="btn-pink px-8 py-4 text-lg">
                            Mulai Belanja
                        </a>
                        <a href="#featured" class="btn-pink-outline px-8 py-4 text-lg bg-white/50 backdrop-blur-sm">
                            Lihat Koleksi
                        </a>
                    </div>
                </div>
                <div class="relative hidden md:block">
                    <!-- Decor elements -->
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-pink-300 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-rose-300 rounded-full mix-blend-multiply filter blur-2xl opacity-50 animate-blob animation-delay-2000"></div>
                    
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl transform rotate-3 hover:rotate-0 transition-all duration-500 border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1563241527-3004b7be0ffd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Beautiful Flower Bouquet" class="w-full h-[500px] object-cover" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features / Why Choose Us -->
    <section class="py-16 bg-white relative -mt-10 mx-4 sm:mx-8 md:mx-16 rounded-3xl shadow-xl z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center p-6 border-b md:border-b-0 md:border-r border-pink-50 last:border-0 hover:bg-pink-50/50 rounded-2xl transition-colors">
                    <div class="w-16 h-16 mx-auto bg-pink-100 text-pink-500 rounded-2xl flex items-center justify-center mb-4 transform -rotate-6 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-500 text-sm">Same day delivery untuk menjaga kesegaran bunga.</p>
                </div>
                <div class="text-center p-6 border-b md:border-b-0 md:border-r border-pink-50 last:border-0 hover:bg-pink-50/50 rounded-2xl transition-colors">
                    <div class="w-16 h-16 mx-auto bg-pink-100 text-pink-500 rounded-2xl flex items-center justify-center mb-4 transform rotate-3 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Kualitas Premium</h3>
                    <p class="text-gray-500 text-sm">Bunga segar pilihan terbaik langsung dari kebun.</p>
                </div>
                <div class="text-center p-6 border-b md:border-b-0 md:border-r border-pink-50 last:border-0 hover:bg-pink-50/50 rounded-2xl transition-colors">
                    <div class="w-16 h-16 mx-auto bg-pink-100 text-pink-500 rounded-2xl flex items-center justify-center mb-4 transform -rotate-3 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-500 text-sm">Transaksi aman terjamin via Midtrans Payment Gateway.</p>
                </div>
                <div class="text-center p-6 hover:bg-pink-50/50 rounded-2xl transition-colors">
                    <div class="w-16 h-16 mx-auto bg-pink-100 text-pink-500 rounded-2xl flex items-center justify-center mb-4 transform rotate-6 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Customer Support</h3>
                    <p class="text-gray-500 text-sm">Layanan pelanggan kami siap melayani Anda 24/7.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="featured" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="section-title">Koleksi Terpopuler</h2>
                <p class="section-subtitle">Pilihan karangan bunga terbaik yang paling disukai pelanggan kami.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                    <div class="card-product group relative flex flex-col h-full bg-white">
                        <a href="{{ route('products.show', $product->slug) }}" wire:navigate class="block relative aspect-square overflow-hidden bg-gray-100">
                            <!-- Placeholder Image if DB is empty -->
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=fdf2f8&color=ec4899&size=400" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            
                            @if($product->badge === 'best_seller')
                                <span class="badge-bestseller">Best Seller</span>
                            @elseif($product->badge === 'new')
                                <span class="badge-new">New</span>
                            @endif
                            
                            <!-- Quick add to cart overlay -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <span class="btn-pink-sm px-6 py-2 shadow-xl transform scale-90 group-hover:scale-100">
                                    Lihat Detail
                                </span>
                            </div>
                        </a>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="text-xs text-pink-500 font-semibold uppercase tracking-wider mb-1">{{ $product->category->name }}</div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition-colors line-clamp-2">
                                <a href="{{ route('products.show', $product->slug) }}" wire:navigate>{{ $product->name }}</a>
                            </h3>
                            
                            <div class="flex items-center mb-4">
                                <div class="flex text-yellow-400">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4 {{ $i < floor($product->rating) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-500 ml-2">({{ $product->rating }})</span>
                            </div>
                            
                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-xl font-extrabold text-gray-900">{{ $product->formatted_price }}</span>
                                <button type="button" class="w-10 h-10 rounded-full bg-pink-50 text-pink-500 flex items-center justify-center hover:bg-pink-500 hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('products.index') }}" wire:navigate class="btn-pink-outline px-8 py-3">
                    Lihat Semua Koleksi
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-20 bg-pink-500 text-white relative overflow-hidden">
        <!-- SVG Decor -->
        <svg class="absolute top-0 left-0 transform -translate-x-1/2 -translate-y-1/2 opacity-10" width="404" height="404" fill="none" viewBox="0 0 404 404"><defs><pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="0" y="0" width="4" height="4" fill="currentColor"></rect></pattern></defs><rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)"></rect></svg>
        <svg class="absolute bottom-0 right-0 transform translate-x-1/2 translate-y-1/2 opacity-10" width="404" height="404" fill="none" viewBox="0 0 404 404"><defs><pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="0" y="0" width="4" height="4" fill="currentColor"></rect></pattern></defs><rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)"></rect></svg>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Apa Kata Mereka?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20">
                    <div class="flex text-yellow-300 mb-4">★★★★★</div>
                    <p class="text-pink-50 mb-6 italic">"Bunganya sangat segar dan wangi. Pengirimannya juga on time banget pas di hari ibu. Mama seneng banget! Thank you Toko Bunga."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Sarah+A&background=fff&color=ec4899" alt="Sarah" class="w-12 h-12 rounded-full border-2 border-white" />
                        <div>
                            <h4 class="font-bold">Sarah A.</h4>
                            <span class="text-pink-200 text-sm">Customer</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20 transform md:-translate-y-4">
                    <div class="flex text-yellow-300 mb-4">★★★★★</div>
                    <p class="text-pink-50 mb-6 italic">"Pesan bunga anniversary super mendadak jam 10 pagi, jam 2 siang udah sampe! Packingnya mewah banget, istri lgsg melted 🥰."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Budi+W&background=fff&color=ec4899" alt="Budi" class="w-12 h-12 rounded-full border-2 border-white" />
                        <div>
                            <h4 class="font-bold">Budi W.</h4>
                            <span class="text-pink-200 text-sm">Customer</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 border border-white/20">
                    <div class="flex text-yellow-300 mb-4">★★★★★</div>
                    <p class="text-pink-50 mb-6 italic">"Suka banget sama customer servicenya yg ramah pas bantu pilih bunga untuk wisuda temen. Rangkaiannya cantik persis seperti di foto."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://ui-avatars.com/api/?name=Nadia+P&background=fff&color=ec4899" alt="Nadia" class="w-12 h-12 rounded-full border-2 border-white" />
                        <div>
                            <h4 class="font-bold">Nadia P.</h4>
                            <span class="text-pink-200 text-sm">Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Custom styling just for blob animation on home -->
    <style>
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</div>
