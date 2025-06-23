@extends('layouts.app')

@section('title', $community->nama_komunitas . ' - Komunitas Event')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 relative overflow-hidden">
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
    </div>
   <div class="relative bg-gradient-to-br from-blue-600 via-teal-600 to-emerald-700 text-white overflow-hidden py-20 mb-16">
    <div class="absolute inset-0 z-0">
    
        <div class="bg-scroll-right absolute inset-0 bg-cover bg-no-repeat opacity-40" style="background-image: url('{{asset('storage/' . $community->gambar)}}');"></div>

     
        <div class="ocean-bubbles-container absolute inset-0 overflow-hidden">
            <div class="bubble bubble-1"></div>
            <div class="bubble bubble-2"></div>
            <div class="bubble bubble-3"></div>
            <div class="bubble bubble-4"></div>
            <div class="bubble bubble-5"></div>
            <div class="bubble bubble-6"></div>
            <div class="bubble bubble-7"></div>
            <div class="bubble bubble-8"></div>
            <div class="bubble bubble-9"></div>
            <div class="bubble bubble-10"></div>
            <div class="bubble bubble-11"></div>
            <div class="bubble bubble-12"></div>
            <div class="bubble bubble-13"></div>
            <div class="bubble bubble-14"></div>
            <div class="bubble bubble-15"></div>
        </div>

        <div class="wave-pattern-animated absolute bottom-0 left-0 w-full h-24 opacity-40"></div>
    </div>

       <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row gap-10 items-center">
                <div class="md:w-1/3 fade-in-scale animate-on-scroll perspective-container" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="relative transform hover:rotate-y-2 transition-all duration-700">
                        @if($community->gambar)
                            <div class="rounded-2xl overflow-hidden morphing-shape shadow-2xl border-4 border-cyan-300/30 glow-border-cyan shine-effect">
                                <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="w-full object-cover hover:scale-105 transition-all duration-700" style="max-height: 320px;">
                                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/60 to-transparent"></div>
                            </div>
                        @else
                            <div class="rounded-2xl overflow-hidden morphing-shape shadow-2xl border-4 border-cyan-300/30 glow-border-cyan bg-gradient-to-br from-blue-500/90 via-teal-500/90 to-emerald-600/90 flex items-center justify-center pulse-slow" style="height: 320px;">
                                <i class="fas fa-calendar-alt fa-5x text-white/90"></i>
                            </div>
                        @endif
                        <div class="absolute -bottom-5 -right-5 w-24 h-24 rounded-full bg-gradient-to-br from-cyan-400 to-teal-400 blur-lg opacity-60 animate-pulse-slow"></div>
                    </div>
                </div>

                 <div class="md:w-2/3 text-center md:text-left" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1000">
                    <div class="inline-flex items-center bg-white/15 backdrop-blur-sm rounded-full px-6 py-2 mb-4 border border-cyan-300/30 shadow-glow-cyan">
                        <div class="w-2 h-2 bg-cyan-300 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-cyan-100 font-medium tracking-wider">{{ __('Event Komunitas') }}</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 text-reveal words-reveal  ocean-gradient-text" data-aos="fade-right" data-aos-delay="500">
                        <span class="word relative inline-block">
                            {{ $community->nama_komunitas }}
                            <span class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-cyan-300 to-teal-400 rounded-full"></span>
                        </span>

                    </h1>
                                <div class="relative p-4 bg-gradient-to-r from-cyan-800/30 to-teal-700/30 backdrop-blur-sm rounded-xl shadow-inner transform hover:scale-102 transition-all duration-300">
                    <p class="text-xl text-white font-medium mb-8 max-w-2xl leading-relaxed text-shadow-lg" data-aos="fade-up" data-aos-delay="700">
                        Bergabunglah dalam kegiatan konservasi laut, lokakarya edukasi, pembersihan pantai, dan pertemuan komunitas yang fokus pada perlindungan ekosistem laut kita.
                    </p>
                </div>  
                    <div class="flex flex-wrap gap-5 justify-center md:justify-start items-center mt-8" data-aos="fade-up" data-aos-delay="900">
                        <a href="{{ route('communities.show', $community) }}" class="group bg-white/20 hover:bg-white/90 backdrop-blur-sm border border-cyan-300/30 text-white hover:text-teal-700 px-8 py-3 rounded-full font-medium transition-all duration-300 flex items-center shadow-lg hover:shadow-xl">
                            <i class="fas fa-chevron-left mr-2 group-hover:transform group-hover:-translate-x-1 transition-transform"></i> {{ __('Kembali ke Komunitas') }}
                        </a>

                        @if(auth()->check() && (auth()->user()->role === 'admin' || (isset($isModeratorOrAdmin) && $isModeratorOrAdmin)))
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createEventModal" class="group bg-gradient-to-r from-cyan-500 to-teal-600 hover:from-cyan-600 hover:to-teal-700 text-white px-8 py-3 rounded-full font-medium transition-all duration-300 shadow-xl transform hover:-translate-y-1 flex items-center relative overflow-hidden">
                                <span class="relative z-10 flex items-center">
                                    <i class="fas fa-plus-circle mr-2 group-hover:rotate-90 transition-transform duration-500"></i> {{ __('Buat Acara Baru') }}
                                </span>
                                <span class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-teal-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-t from-cyan-50 to-transparent"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 relative z-10 pb-24">
        <div class="bg-gradient-to-r from-white/90 to-white/80 backdrop-blur-xl rounded-2xl p-8 shadow-lg mb-12 flex flex-wrap items-center justify-between border border-blue-100 transform hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center space-x-5">
                <div class="bg-gradient-to-br from-blue-500 to-teal-600 text-white rounded-2xl w-16 h-16 flex flex-col items-center justify-center shadow-lg relative overflow-hidden">
                    <div class="absolute inset-0 bg-grid-pattern opacity-20"></div>
                    <i class="fas fa-calendar-alt text-2xl relative z-10"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">Kalender Event</h3>
                    <p class="text-blue-600">Aktivitas Event yang akan datang</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-4 mt-4 md:mt-0">
                <div class="relative filter-container">
                    <select id="event-filter" class="appearance-none bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 text-blue-800 rounded-xl py-3 px-5 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm hover:shadow-md transition-all duration-300">
                        <option value="all">Semua Event</option>
                        <option value="upcoming">Mendatang</option>
                        <option value="past">Lampau</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-blue-700">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>

                <div class="relative month-picker-container">
                    <input type="month" id="month-picker" class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 text-blue-800 rounded-xl py-3 px-5 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm hover:shadow-md transition-all duration-300">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse($events as $event)
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl border border-blue-100 overflow-hidden group hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 event-card">
                    <div class="relative h-56 overflow-hidden">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-50 group-hover:opacity-70 transition-opacity duration-300"></div>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500/80 via-cyan-500/80 to-teal-600/80 flex items-center justify-center group-hover:from-blue-600/90 group-hover:to-teal-700/90 transition-all duration-500">
                                <i class="fas fa-calendar-day text-white text-5xl group-hover:scale-110 transition-transform duration-500"></i>
                            </div>
                        @endif
                        <div class="absolute top-5 left-5 bg-white/95 backdrop-blur-sm text-blue-800 rounded-xl overflow-hidden shadow-lg transform rotate-3 group-hover:rotate-0 transition-transform duration-300">
                            <div class="bg-gradient-to-r from-blue-600 to-teal-600 text-white py-1 px-4 text-sm font-bold">
                                {{ App\Helpers\IndonesiaTimeHelper::FormatDateMonth($event->event_date) }}
                            </div>
                            <div class="py-3 px-4 font-bold text-2xl text-center">
                                {{ \App\Helpers\IndonesiaTimeHelper::FormatDateJam($event->event_date) }}
                            </div>
                        </div>

                        @if(auth()->check() && (auth()->user()->role === 'admin' || (isset($isModeratorOrAdmin) && $isModeratorOrAdmin)))
                            <div class="absolute top-5 right-5 flex space-x-2">
                                <a href="{{ route('communities.events.edit', ['community' => $community, 'event' => $event]) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white p-2.5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('communities.events.delete', ['community' => $community, 'event' => $event]) }}" method="POST" class="inline delete-event-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2.5 rounded-full delete-event-btn shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-blue-700 transition-colors duration-300">{{ $event->title }}</h3>

                        <p class="text-gray-600 mb-5 line-clamp-2">{{ Str::limit($event->description, 100) }}</p>

                        <div class="flex flex-wrap gap-2 mb-5">
                            @if($event->start_time && $event->end_time)
                                <span class="text-xs bg-blue-100 text-blue-800 px-4 py-1.5 rounded-full flex items-center shadow-sm">
                                    <i class="fas fa-clock mr-1.5"></i> {{ $event->start_time }} - {{ $event->end_time }}
                                </span>
                            @endif

                            @if($event->location)
                                <span class="text-xs bg-teal-100 text-teal-800 px-4 py-1.5 rounded-full flex items-center shadow-sm">
                                    <i class="fas fa-map-marker-alt mr-1.5"></i> {{ $event->location }}
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-blue-100">
                            <span class="text-xs text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                                {{ App\Helpers\IndonesiaTimeHelper::diffForHumans($event->event_date) }}
                            </span>

                            <button type="button" data-bs-toggle="modal" data-bs-target="#viewEventModal"
                                    data-event-title="{{ $event->title }}"
                                    data-event-description="{{ $event->description }}"
                                    data-event-date="{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}"
                                    data-event-time="{{ $event->start_time && $event->end_time ? $event->start_time.' - '.$event->end_time : 'All day' }}"
                                    data-event-location="{{ $event->location ?? 'Location TBD' }}"
                                    data-event-image="{{ $event->image ? asset('storage/'.$event->image) : '' }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center view-event-btn group">
                                Lihat Detail
                                <i class="fas fa-chevron-right ml-1.5 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-12 text-center border border-blue-50">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-cyan-200 text-cyan-600 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <i class="fas fa-calendar-times text-4xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">Tidak ada event</h3>
                    <p class="text-blue-600 mb-8 max-w-lg mx-auto">Tidak ada event yang ditemukan. Jangan khawatir, Anda dapat menunggu event diadakan</p>

                    @if(auth()->check() && (auth()->user()->role === 'admin' || (isset($isModeratorOrAdmin) && $isModeratorOrAdmin)))
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createEventModal" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-8 py-4 rounded-full font-medium inline-flex items-center shadow-xl transform transition-all duration-300 hover:-translate-y-1">
                            <i class="fas fa-plus-circle mr-2 animate-pulse"></i> BUat Event Pertama
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        @if($events->hasPages())
            <div class="mt-12">
                <div class="flex justify-center">
                    {{ $events->links('pagination::tailwind') }}
                </div>
            </div>
        @endif
    </div>

    <div class="absolute bottom-0 left-0 w-full z-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
            <path fill="#0099ff" fill-opacity="0.2" d="M0,224L48,213.3C96,203,192,181,288,186.7C384,192,480,224,576,218.7C672,213,768,171,864,165.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(element => {
                const position = element.getBoundingClientRect();
                if(position.top < window.innerHeight) {
                    element.classList.add('in-view');
                }
            });
        };

        animateOnScroll();
        window.addEventListener('scroll', animateOnScroll);

        const viewEventModal = document.getElementById('viewEventModal');
        if (viewEventModal) {
            viewEventModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const title = button.getAttribute('data-event-title');
                const description = button.getAttribute('data-event-description');
                const date = button.getAttribute('data-event-date');
                const time = button.getAttribute('data-event-time');
                const location = button.getAttribute('data-event-location');
                const image = button.getAttribute('data-event-image');

                document.getElementById('viewEventTitle').textContent = title;
                document.getElementById('viewEventDescription').textContent = description;
                document.getElementById('viewEventDate').textContent = date;
                document.getElementById('viewEventTime').textContent = time;
                document.getElementById('viewEventLocation').textContent = location;

                const imageContainer = document.getElementById('viewEventImage');
                if (image && image !== '') {
                    imageContainer.style.backgroundImage = `url('${image}')`;
                    imageContainer.style.backgroundSize = 'cover';
                    imageContainer.style.backgroundPosition = 'center';
                    imageContainer.innerHTML = '';
                } else {
                    imageContainer.style.backgroundImage = '';
                    imageContainer.innerHTML = '<i class="fas fa-calendar-day text-white text-5xl"></i>';
                }
            });
        }

        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                if (fileName) {
                    const parent = this.closest('.border-dashed');
                    const icon = parent.querySelector('i');
                    const text = parent.querySelector('p:not(.text-xs)');

                    icon.classList.remove('fa-cloud-upload-alt');
                    icon.classList.add('fa-check-circle');
                    text.textContent = `Selected: ${fileName}`;
                }
            });
        });

        const deleteButtons = document.querySelectorAll('.delete-event-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
                    this.closest('form').submit();
                }
            });
        });

        const eventFilter = document.getElementById('event-filter');
        if (eventFilter) {
            const urlParams = new URLSearchParams(window.location.search);
            const currentFilter = urlParams.get('filter');
            if (currentFilter) {
                eventFilter.value = currentFilter;
            }

            eventFilter.addEventListener('change', function() {
                const filterValue = this.value;
                let url = new URL(window.location);
                url.searchParams.set('filter', filterValue);

                this.classList.add('animate-pulse');
                this.disabled = true;

                window.location = url;
            });
        }

        const monthPicker = document.getElementById('month-picker');
        if (monthPicker) {
            monthPicker.addEventListener('change', function() {
                const monthValue = this.value;
                let url = new URL(window.location);
                url.searchParams.set('month', monthValue);

                this.classList.add('animate-pulse');
                this.disabled = true;

                window.location = url;
            });

            const urlParams = new URLSearchParams(window.location.search);
            const currentMonth = urlParams.get('month');

            if (currentMonth) {
                monthPicker.value = currentMonth;
            } else {
                const today = new Date();
                const month = today.getMonth() + 1;
                const year = today.getFullYear();
                monthPicker.value = `${year}-${month.toString().padStart(2, '0')}`;
            }
        }
    });
</script>
@endsection

@section('styles')
<style>
    .ocean-waves {
        background: linear-gradient(90deg,
            transparent,
            rgba(56, 189, 248, 0.15) 25%,
            rgba(6, 182, 212, 0.15) 50%,
            rgba(20, 184, 166, 0.15) 75%,
            transparent
        );
        background-size: 200% 100%;
        animation: oceanFlow 15s ease-in-out infinite;
    }

    .floating-particles {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(56, 189, 248, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 40% 40%, rgba(20, 184, 166, 0.15) 2px, transparent 2px);
        background-size: 100px 100px, 150px 150px, 200px 200px;
        animation: floatParticles 30s linear infinite;
    }

    .ocean-bubbles {
        background-image:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.8) 0.5px, transparent 0.5px),
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.7) 1px, transparent 1px),
            radial-gradient(circle at 30% 80%, rgba(255, 255, 255, 0.6) 0.8px, transparent 0.8px),
            radial-gradient(circle at 70% 40%, rgba(255, 255, 255, 0.7) 1.2px, transparent 1.2px);
        background-size: 100px 100px;
        animation: bubbleRise 25s linear infinite;
    }

    .wave-pattern {
        background-image:
            linear-gradient(135deg, transparent 45%, rgba(255, 255, 255, 0.1) 45%, rgba(255, 255, 255, 0.1) 55%, transparent 55%);
        background-size: 20px 20px;
        animation: waveMove 10s linear infinite;
    }

    .bg-grid-pattern {
        background-image:
            linear-gradient(to right, rgba(255, 255, 255, 0.1) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 10px 10px;
    }

    .perspective-container {
        perspective: 1000px;
    }

    .event-card {
        transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .event-card:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 150, 0.1);
    }

    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 100%
        );
        transform: skewX(-25deg);
        transition: all 0.75s;
    }

    .shine-effect:hover::before {
        animation: shine 1.5s;
    }

    .pulse-slow {
        animation: pulseSlow 4s infinite ease-in-out;
    }

    .gradient-text {
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        background-image: linear-gradient(to right, #0369a1, #0d9488);
    }

    .text-shadow-sm {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    @keyframes oceanFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes floatParticles {
        0% { background-position: 0 0, 0 0, 0 0; }
        100% { background-position: 100px 100px, -150px 150px, 200px -200px; }
    }

    @keyframes bubbleRise {
        0% { background-position: 0 100%; }
        100% { background-position: 100px 0; }
    }

    @keyframes waveMove {
        0% { background-position: 0 0; }
        100% { background-position: 40px 0; }
    }

    @keyframes shine {
        100% { left: 150%; }
    }

    @keyframes pulseSlow {
        0%, 100% { opacity: 0.9; }
        50% { opacity: 1; }
    }

    @keyframes textReveal {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes rotate-y-2 {
        0%, 100% { transform: rotateY(0deg); }
        50% { transform: rotateY(2deg); }
    }

    .transform:hover .rotate-y-2 {
        animation: rotate-y-2 3s ease-in-out infinite;
    }

    .fade-in-scale {
        opacity: 0;
        transform: scale(0.9);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .fade-in-scale.in-view {
        opacity: 1;
        transform: scale(1);
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    input:focus, textarea:focus, select:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
    }

    .shadow-glow {
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
    }

    .ocean-bubbles-container {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        pointer-events: none;
    }

    .bubble {
        position: absolute;
        bottom: -100px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        opacity: 0;
        background: radial-gradient(
            circle at 70% 30%,
            rgba(255, 255, 255, 0.8) 0%,
            rgba(255, 255, 255, 0.5) 25%,
            rgba(255, 255, 255, 0.2) 50%,
            rgba(255, 255, 255, 0.1) 75%,
            transparent 100%
        );
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        animation: float-bubble 12s infinite ease-in;
    }

    .bubble-1 {
        left: 10%;
        width: 15px;
        height: 15px;
        animation-delay: 0s;
        animation-duration: 12s;
    }

    .bubble-2 {
        left: 20%;
        width: 20px;
        height: 20px;
        animation-delay: 1s;
        animation-duration: 15s;
    }

    .bubble-3 {
        left: 35%;
        width: 10px;
        height: 10px;
        animation-delay: 2s;
        animation-duration: 10s;
    }

    .bubble-4 {
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 0.5s;
        animation-duration: 14s;
    }

    .bubble-5 {
        left: 65%;
        width: 30px;
        height: 30px;
        animation-delay: 2.5s;
        animation-duration: 13s;
    }

    .bubble-6 {
        left: 80%;
        width: 18px;
        height: 18px;
        animation-delay: 1.5s;
        animation-duration: 16s;
    }

    .bubble-7 {
        left: 90%;
        width: 22px;
        height: 22px;
        animation-delay: 3s;
        animation-duration: 11s;
    }

    .bubble-8 {
        left: 15%;
        width: 28px;
        height: 28px;
        animation-delay: 4s;
        animation-duration: 13s;
    }

    .bubble-9 {
        left: 40%;
        width: 12px;
        height: 12px;
        animation-delay: 0.8s;
        animation-duration: 9s;
    }

    .bubble-10 {
        left: 60%;
        width: 24px;
        height: 24px;
        animation-delay: 1.2s;
        animation-duration: 12s;
    }

    .bubble-11 {
        left: 75%;
        width: 14px;
        height: 14px;
        animation-delay: 2.8s;
        animation-duration: 10s;
    }

    .bubble-12 {
        left: 25%;
        width: 32px;
        height: 32px;
        animation-delay: 3.5s;
        animation-duration: 15s;
    }

    .bubble-13 {
        left: 55%;
        width: 18px;
        height: 18px;
        animation-delay: 4.2s;
        animation-duration: 11s;
    }

    .bubble-14 {
        left: 30%;
        width: 26px;
        height: 26px;
        animation-delay: 2.2s;
        animation-duration: 14s;
    }

    .bubble-15 {
        left: 70%;
        width: 16px;
        height: 16px;
        animation-delay: 1.8s;
        animation-duration: 13s;
    }

    @keyframes float-bubble {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 0.7;
        }
        50% {
            transform: translateY(-100vh) translateX(20px);
            opacity: 0.3;
        }
        100% {
            transform: translateY(-200vh) translateX(-20px);
            opacity: 0;
        }
    }

    .wave-pattern-animated {
        background-image:
            linear-gradient(135deg, transparent 45%, rgba(255, 255, 255, 0.2) 45%, rgba(255, 255, 255, 0.2) 55%, transparent 55%);
        background-size: 20px 20px;
        animation: waveMove 10s linear infinite;
    }

    .water-shine-effect {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background: linear-gradient(
            to bottom,
            transparent,
            rgba(255, 255, 255, 0.05) 50%,
            rgba(255, 255, 255, 0.1) 100%
        );
        opacity: 0.4;
        animation: water-shine 5s ease-in-out infinite alternate;
    }

    @keyframes water-shine {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 0.4; }
    }


</style>
@endsection
