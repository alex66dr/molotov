<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Video Upload') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-6">Upload Video for Conversion</h3>
                    
                    <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- File Upload -->
                        <div>
                            <label for="video" class="block text-sm font-medium text-gray-700 mb-2">
                                Select Video File
                            </label>
                            <input type="file" 
                                   id="video" 
                                   name="video" 
                                   accept="video/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                   required>
                            @error('video')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Destination
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="upload_type" value="local" class="mr-2" checked>
                                    <span>Local Server</span>
                                    <span class="text-gray-500 text-sm ml-2">(Process on local server)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="upload_type" value="remote" class="mr-2">
                                    <span>Remote Server</span>
                                    <span class="text-gray-500 text-sm ml-2">(Process on Hetzner Cloud servers)</span>
                                </label>
                            </div>
                            @error('upload_type')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center space-x-4">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                                Upload Video
                            </button>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                                Back to Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Upload Instructions -->
            <div class="mt-6 bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-blue-800 mb-3">Upload Instructions</h4>
                    <ul class="space-y-2 text-blue-700">
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Supported formats: MP4, AVI, MOV, WMV</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Maximum file size: 2GB</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Local processing: Files processed on this server</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Remote processing: Files uploaded to Hetzner Cloud servers for conversion</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>