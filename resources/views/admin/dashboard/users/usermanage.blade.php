<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\dashboard\usermanage.blade.php -->
@extends('layouts.admin')

@section('title', 'User Management Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">User Management Dashboard</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Back to Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                View All Users
            </a>
        </div>
    </div>

    <!-- User Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Users</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">New This Month</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $newUsers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Active Today</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $activeToday }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Banned Users</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $bannedUsers }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- User Growth Chart -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <h2 class="text-lg font-medium text-gray-800 mb-4">User Growth</h2>
        <div class="h-64">
            <canvas id="userGrowthChart"></canvas>
        </div>
    </div>

    <!-- Recent Users and Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Users -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-800">Recently Joined Users</h2>
                <a href="{{ route('admin.users.index', ['filter' => 'recent']) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
            </div>

            <div class="space-y-4">
                @foreach($recentUsers as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover"
                                 src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                                 alt="{{ $user->name }}">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.show', $user->user_id) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- User Activity -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-800">Recent User Activity</h2>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
            </div>

            <div class="space-y-4">
                @foreach($recentActivity as $activity)
                      @php
            $borderColorClass = 'border-gray-200'; // Default border color

            // Set border color based on activity type
               switch($activity['type']) {
                case 'article':
                    $borderColorClass = 'border-blue-500';
                    break;
                case 'comment':
                    $borderColorClass = 'border-green-500';
                    break;
                case 'join':
                    $borderColorClass = 'border-purple-500';
                    break;
            }
        @endphp
                        <div class="flex items-center">
                            <img class="h-8 w-8 rounded-full object-cover"
                                 src="{{ $activity['user']->foto_profil ? Storage::url($activity['user']->foto_profil) : asset('img/default-avatar.png') }}"
                                 alt="{{ $activity['user']->name }}">
                            <div class="ml-3">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">{{ $activity['user']->name }}</span>
                                    {{ $activity['description'] }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $activity['time']->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Content Metrics -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Top Contributors -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Top Contributors</h2>

            <div class="space-y-4">
                @foreach($topContributors as $user)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover"
                                 src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                                 alt="{{ $user->name }}">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->articles_count }} articles</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.show', $user->user_id) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Most Active Communities -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Active Communities</h2>

            <div class="space-y-4">
                @foreach($activeCommunities as $community)
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $community->nama }}</p>
                            <p class="text-xs text-gray-500">{{ $community->members_count }} members</p>
                        </div>
                        <a href="{{ route('admin.communities.show', $community->community_id) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Banned Users -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-800">Recently Banned Users</h2>
                <a href="{{ route('admin.users.index', ['filter' => 'banned']) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
            </div>

            <div class="space-y-4">
                @if(count($recentBannedUsers) > 0)
                    @foreach($recentBannedUsers as $user)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="h-10 w-10 rounded-full object-cover"
                                     src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                                     alt="{{ $user->name }}">
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-500">Banned {{ $user->banned_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.users.show', $user->user_id) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                <form action="{{ route('admin.users.unban', $user->user_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 text-sm">Unban</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4 text-gray-500">
                        No banned users found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('userGrowthChart').getContext('2d');

        const userGrowthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($userGrowthLabels) !!},
                datasets: [{
                    label: 'New Users',
                    data: {!! json_encode($userGrowthData) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection
