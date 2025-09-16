<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Welcome to Molotov Video Management System</h3>
                    <p class="text-gray-600 mb-6">
                        Manage your video uploads, conversions, and Hetzner Cloud servers from this dashboard.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Admin Access -->
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-blue-800 mb-2">
                                Admin Panel
                            </h4>
                            <p class="text-blue-600 mb-4">
                                Access video upload, server management, and conversion monitoring tools.
                            </p>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Go to Admin Panel
                            </a>
                        </div>
                        
                        <!-- Quick Stats -->
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h4 class="text-lg font-semibold text-green-800 mb-2">
                                System Status
                            </h4>
                            <div class="space-y-2 text-green-600">
                                <div class="flex justify-between">
                                    <span>Server Status:</span>
                                    <span class="font-semibold">Active</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Queue Jobs:</span>
                                    <span class="font-semibold">0</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Remote Servers:</span>
                                    <span class="font-semibold">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
