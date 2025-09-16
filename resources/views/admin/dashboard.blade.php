<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Upload Management -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Upload Management</h3>
                        <p class="text-gray-600 mb-4">Upload videos for local or remote conversion</p>
                        <a href="{{ route('admin.upload') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Upload Videos
                        </a>
                    </div>
                </div>

                <!-- Server Management -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Server Management</h3>
                        <p class="text-gray-600 mb-4">Manage Hetzner Cloud servers</p>
                        <a href="{{ route('admin.servers') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Manage Servers
                        </a>
                    </div>
                </div>

                <!-- Conversion Queue -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Conversion Queue</h3>
                        <p class="text-gray-600 mb-4">Monitor video conversion jobs</p>
                        <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded" onclick="alert('Queue monitoring coming soon!')">
                            View Queue
                        </button>
                    </div>
                </div>
            </div>

            <!-- Statistics -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">System Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">0</div>
                            <div class="text-gray-600">Total Videos</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">0</div>
                            <div class="text-gray-600">Active Servers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-yellow-600">0</div>
                            <div class="text-gray-600">Queue Jobs</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-red-600">0</div>
                            <div class="text-gray-600">Failed Jobs</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>