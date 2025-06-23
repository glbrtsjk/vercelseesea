@extends('layouts.admin')

@section('title', 'Buat Tag Baru')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Header Buat Tag Baru -->
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Buat Tag Baru</h1>
                    <p class="text-cyan-100 font-medium">Tambahkan tag baru untuk mengkategorikan artikel konservasi laut</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.tags.index') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Tag
                    </a>
                </div>
            </div>

            <!-- Navigasi Breadcrumb -->
            <div class="mt-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb flex text-sm text-cyan-100">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="hover:text-white transition-colors">Dasbor</a></li>
                        <li class="breadcrumb-item"><span class="mx-2">›</span></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}" class="hover:text-white transition-colors">Kelola Tag</a></li>
                        <li class="breadcrumb-item"><span class="mx-2">›</span></li>
                        <li class="breadcrumb-item text-white/80" aria-current="page">Buat Tag</li>
                    </ol>
                </nav>
            </div>

            <!-- Enhanced wave animations with brighter colors -->
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>

            <!-- Add subtle particle effect -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <!-- Tag Form Card -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-6 transition duration-300 hover:shadow-xl border-t-4 border-blue-500 relative">
                    <div class="border-b border-gray-200 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Informasi Tag
                        </h2>
                    </div>

                    <!-- Wave background -->
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

                    <form action="{{ route('admin.tags.store') }}" method="POST" id="tagForm" class="relative z-10">
                        @csrf

                        <div class="mb-6">
                            <label for="nama_tag" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Nama Tag <span class="text-red-500">*</span>
                            </label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_tag') border-red-500 @enderror"
                                id="nama_tag" name="nama_tag" value="{{ old('nama_tag') }}" required
                                placeholder="Masukkan nama tag (cth: konservasi-terumbu)">
                            <p class="mt-1 text-sm text-gray-500">
                                Nama tag harus unik dan ringkas. Akan otomatis diubah menjadi format yang ramah URL.
                            </p>
                            @error('nama_tag')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Pratinjau Slug
                            </label>
                            <div class="flex">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">/tags/</span>
                                <input type="text" class="flex-1 px-4 py-2 bg-gray-50 border border-gray-300 rounded-r-lg focus:outline-none text-gray-500" id="slug_preview" disabled
                                    placeholder="pratinjau-slug-tag">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">
                                Ini adalah tampilan URL tag yang akan dibuat secara otomatis.
                            </p>
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                Deskripsi
                            </label>
                            <textarea class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                                id="deskripsi" name="deskripsi" rows="4"
                                placeholder="Berikan deskripsi singkat tentang tag ini...">{{ old('deskripsi') }}</textarea>
                            <div class="flex justify-between mt-1">
                                <p class="text-sm text-gray-500">
                                    Deskripsi yang jelas membantu pengguna memahami kapan menggunakan tag ini.
                                </p>
                                <span class="text-sm text-gray-500" id="charCount">0/500</span>
                            </div>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-between pt-4 border-t border-gray-100">
                            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-md flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Buat Tag
                            </button>
                            <button type="button" class="border border-gray-300 bg-white text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 focus:outline-none transition-all duration-300 flex items-center" onclick="checkSimilarTags()">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Cek Tag Serupa
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div>
                <!-- Similar Tags Card (Initially Hidden) -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden mb-6 transition duration-300 hover:shadow-xl border-t-4 border-yellow-500 hidden relative" id="similarTagsCard">
                    <div class="bg-yellow-50 border-b border-yellow-100 px-6 py-4 relative z-10 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <h3 class="font-semibold text-yellow-700">Tag Serupa Ditemukan</h3>
                    </div>

                    <!-- Wave background -->
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-yellow-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-yellow-500/20 animate-wave-slow opacity-40"></div>

                    <div class="divide-y divide-gray-200" id="similarTagsList" class="relative z-10">
                        <!-- Similar tags will be inserted here by JavaScript -->
                    </div>
                    <div class="px-6 py-4 bg-gray-50 text-sm text-gray-500 relative z-10">
                        Sebaiknya gunakan tag yang sudah ada daripada membuat duplikat.
                    </div>
                </div>

               
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl border-t-4 border-cyan-500 relative">
                    <div class="px-6 py-4 border-b border-gray-200 relative z-10">
                        <h3 class="font-bold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Panduan Pembuatan Tag
                        </h3>
                    </div>

                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-cyan-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-cyan-500/20 animate-wave-slow opacity-40"></div>

                    <div class="p-6 relative z-10">
                        <h4 class="font-medium text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Praktik Terbaik
                        </h4>
                        <ul class="list-disc pl-5 text-sm text-gray-600 mb-5 space-y-1">
                            <li>Gunakan bentuk tunggal (mis. "terumbu", bukan "terumbu-terumbu")</li>
                            <li>Buat nama tag singkat dan deskriptif</li>
                            <li>Gunakan huruf kecil kecuali untuk nama diri</li>
                            <li>Periksa tag serupa sebelum membuat yang baru</li>
                            <li>Tambahkan deskripsi untuk memperjelas penggunaan tag</li>
                        </ul>

                        <h4 class="font-medium text-gray-800 mb-2 pt-4 border-t border-gray-100 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Contoh
                        </h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left text-sm font-medium text-gray-700 pb-2">Tag yang Baik</th>
                                        <th class="text-left text-sm font-medium text-gray-700 pb-2">Tidak Direkomendasikan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">
                                    <tr>
                                        <td class="py-1"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">terumbu-karang</span></td>
                                        <td><span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">TK</span> <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">TerubuKarang</span></td>
                                    </tr>
                                    <tr>
                                        <td class="py-1"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">konservasi</span></td>
                                        <td><span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">konservasis</span> <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">hal konservasi</span></td>
                                    </tr>
                                    <tr>
                                        <td class="py-1"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">ikan-langka</span></td>
                                        <td><span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">IL</span> <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">ikan langka</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
@keyframes wave {
  0% {
    transform: translateX(-100%) translateZ(0) scaleY(1);
  }
  50% {
    transform: translateX(-30%) translateZ(0) scaleY(0.8);
  }
  100% {
    transform: translateX(0) translateZ(0) scaleY(1);
  }
}

@keyframes wave-slow {
  0% {
    transform: translateX(0) translateZ(0) scaleY(1);
  }
  50% {
    transform: translateX(-50%) translateZ(0) scaleY(0.8);
  }
  100% {
    transform: translateX(-100%) translateZ(0) scaleY(1);
  }
}

.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important;
}

.bg-gradient-to-r.min-h-screen::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        45deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.03) 50%,
        rgba(255, 255, 255, 0) 100%
    )};

/* Fixed bubble animation */
.admin-bubble {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%,
                               rgba(255,255,255,0.8),
                               rgba(255,255,255,0.3) 30%,
                               rgba(255,255,255,0.1) 60%);
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.4),
                inset 0 0 6px rgba(255, 255, 255, 0.4);
    opacity: 0.3;
    z-index: 1;
    animation: bubble-float 15s ease-in infinite;
    pointer-events: none;
    will-change: transform, opacity;
}

@keyframes bubble-float {
    0% {
        transform: translateY(0) translateX(0) scale(0.4);
        opacity: 0;
    }
    10% {
        opacity: 0.3;
        transform: translateY(-20vh) translateX(5px) scale(0.6);
    }
    40% {
        opacity: 0.4;
        transform: translateY(-40vh) translateX(-10px) scale(0.8);
    }
    70% {
        opacity: 0.3;
        transform: translateY(-70vh) translateX(10px) scale(0.9);
    }
    90% {
        opacity: 0.2;
    }
    100% {
        transform: translateY(-100vh) translateX(-5px) scale(0.7);
        opacity: 0;
    }
}

.animate-wave {
    animation: wave 8s linear infinite;
} 

.animate-wave-slow {
    animation: wave-slow 12s linear infinite;
}

.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}


.particle {
    position: absolute;
    background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    opacity: 0.3;
}

.particle-1 {
    width: 80px;
    height: 80px;
    top: 10%;
    left: 10%;
    animation: float 20s infinite ease-in-out;
}

.particle-2 {
    width: 50px;
    height: 50px;
    top: 20%;
    right: 20%;
    animation: float 15s infinite ease-in-out reverse;
}
.particle-3 {
    width: 35px;
    height: 35px;
    bottom: 30%;
    left: 30%;
    animation: float 25s infinite ease-in-out 5s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0);
    }
    25% {
        transform: translateY(-15px) translateX(15px);
    }
    50% {
        transform: translateY(8px) translateX(-8px);
    }
    75% {
        transform: translateY(-5px) translateX(10px);
    }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
    animation: fadeIn 0.4s ease-out forwards;
}


@media (max-width: 640px) {
    .lg\:col-span-2 {
        grid-column: span 1 / span 1;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi untuk kartu pada saat halaman dimuat
    const cards = document.querySelectorAll('.rounded-2xl, .rounded-xl');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });

    const nameInput = document.getElementById('nama_tag');
    const slugPreview = document.getElementById('slug_preview');
    const descInput = document.getElementById('deskripsi');
    const charCount = document.getElementById('charCount');

    nameInput.addEventListener('input', function() {
        slugPreview.value = generateSlug(this.value);
    });

    descInput.addEventListener('input', function() {
        const count = this.value.length;
        charCount.innerText = `${count}/500`;

        if (count > 450) {
            charCount.classList.add('text-yellow-600');
            charCount.classList.remove('text-gray-500');
        } else {
            charCount.classList.remove('text-yellow-600');
            charCount.classList.add('text-gray-500');
        }

        if (count > 490) {
            charCount.classList.add('text-red-600');
            charCount.classList.remove('text-yellow-600', 'text-gray-500');
        } else {
            charCount.classList.remove('text-red-600');
        }
    });

    if (descInput.value) {
        charCount.innerText = `${descInput.value.length}/500`;
    }

    if (nameInput.value) {
        slugPreview.value = generateSlug(nameInput.value);
    }

    const container = document.querySelector('.bg-gradient-to-r.min-h-screen');
    if (container) {
        for (let i = 0; i < 15; i++) {
            createBubble(container);
        }

        // Buat gelembung baru secara berkala
        setInterval(() => createBubble(container), 2000);
    }

    // Efek ripple pada tombol
    const buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;

            ripple.style.cssText = `
                position: absolute;
                background: rgba(255, 255, 255, 0.7);
                border-radius: 50%;
                pointer-events: none;
                width: 100px;
                height: 100px;
                top: ${y - 50}px;
                left: ${x - 50}px;
                transform: scale(0);
                opacity: 0.5;
                animation: rippleEffect 0.6s linear;
            `;

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});

// Simple slug generator function
function generateSlug(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-')           
        .replace(/[^\w\-]+/g, '')       
        .replace(/^-+/, '')             
        .replace(/-+$/, '');            /
}

// Fungsi untuk membuat gelembung lautan
function createBubble(parent) {
    const bubble = document.createElement('div');
    const size = Math.random() * 60 + 20; 
    const left = Math.random() * 100; 
        const delay = Math.random() * 5;
    const duration = Math.random() * 15 + 10; 

    bubble.className = 'admin-bubble';
    bubble.style.width = `${size}px`;
    bubble.style.height = `${size}px`;
    bubble.style.left = `${left}%`;
    bubble.style.bottom = '-100px'; // Start from bottom
    bubble.style.animationDuration = `${duration}s`;
    bubble.style.animationDelay = `${delay}s`;

    parent.appendChild(bubble);

    setTimeout(() => {
        if (bubble && bubble.parentNode) {
            bubble.parentNode.removeChild(bubble);
        }
    }, (duration + delay) * 1000);
}

function checkSimilarTags() {
    const tagNameInput = document.getElementById('nama_tag');
    const tagName = tagNameInput.value.trim();

    if (!tagName) {
        alert('Silakan masukkan nama tag untuk memeriksa tag serupa.');
        return;
    }

    // Show loading state
    const submitBtn = document.querySelector('button[type="submit"]');
    const checkBtn = document.querySelector('button[onclick="checkSimilarTags()"]');
    submitBtn.disabled = true;
    checkBtn.disabled = true;
    checkBtn.innerHTML = '<svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Memeriksa...';

    fetch(`/admin/tags/check-similar?name=${encodeURIComponent(tagName)}`)
        .then(response => response.json())
        .then(data => {
            const similarTagsCard = document.getElementById('similarTagsCard');
            const similarTagsList = document.getElementById('similarTagsList');

            // Reset list
            similarTagsList.innerHTML = '';

            // Show the card
            similarTagsCard.classList.remove('hidden');

            if (data.length > 0) {
                data.forEach(tag => {
                    const item = document.createElement('a');
                    item.href = `/admin/tags/${tag.tag_id}/edit`;
                    item.classList.add('flex', 'justify-between', 'items-center', 'p-4', 'hover:bg-gray-50', 'relative', 'z-10');
                    item.innerHTML = `
                        <div class="flex-1 pr-4">
                            <div class="font-medium text-blue-600">${tag.nama_tag}</div>
                            <div class="text-sm text-gray-500 mt-1">${tag.deskripsi ? tag.deskripsi.substring(0, 60) + (tag.deskripsi.length > 60 ? '...' : '') : 'Tidak ada deskripsi'}</div>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">${tag.articles_count} artikel</span>
                    `;
                    similarTagsList.appendChild(item);
                });
            } else {
                // No similar tags found
                const item = document.createElement('div');
                item.classList.add('p-6', 'text-center', 'relative', 'z-10');
                item.innerHTML = `
                    <svg class="w-12 h-12 text-green-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-600">Tidak ditemukan tag yang serupa. Anda dapat melanjutkan pembuatan tag ini.</p>
                `;
                similarTagsList.appendChild(item);
            }
        })
        .catch(error => {
            console.error('Error checking similar tags:', error);
            alert('Gagal memeriksa tag serupa. Silakan coba lagi.');
        })
        .finally(() => {
            // Restore buttons
            submitBtn.disabled = false;
            checkBtn.disabled = false;
            checkBtn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Cek Tag Serupa';
        });
}

const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes rippleEffect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(styleSheet);
</script>
@endsection
