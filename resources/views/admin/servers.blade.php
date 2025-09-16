<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Server Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(isset($error))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    Error connecting to Hetzner: {{ $error }}
                </div>
            @endif

            <!-- Create Server Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Create New Server</h3>
                    
                    <form id="createServerForm" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="server_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Server Name
                            </label>
                            <input type="text" 
                                   id="server_name" 
                                   name="name" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="my-video-server"
                                   required>
                        </div>
                        
                        <div>
                            <label for="server_type" class="block text-sm font-medium text-gray-700 mb-1">
                                Server Type
                            </label>
                            <select id="server_type" 
                                    name="server_type" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Select Type</option>
                                <option value="cx22">CX22 - 4GB RAM, 2 vCPU</option>
                                <option value="cx32">CX32 - 8GB RAM, 4 vCPU</option>
                                <option value="cx42">CX42 - 16GB RAM, 8 vCPU</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="server_image" class="block text-sm font-medium text-gray-700 mb-1">
                                Operating System
                            </label>
                            <select id="server_image" 
                                    name="image" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Select OS</option>
                                <option value="ubuntu-22.04">Ubuntu 22.04</option>
                                <option value="ubuntu-20.04">Ubuntu 20.04</option>
                                <option value="debian-11">Debian 11</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="server_location" class="block text-sm font-medium text-gray-700 mb-1">
                                Location
                            </label>
                            <select id="server_location" 
                                    name="location" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Select Location</option>
                                <option value="nbg1">Nuremberg</option>
                                <option value="fsn1">Falkenstein</option>
                                <option value="hel1">Helsinki</option>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2 lg:col-span-4">
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                                Create Server
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Servers List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Active Servers</h3>
                    
                    @if(count($servers) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($servers as $server)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $server['name'] }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $server['status'] === 'running' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ ucfirst($server['status']) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $server['server_type']['name'] ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $server['datacenter']['location']['name'] ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $server['public_net']['ipv4']['ip'] ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <button onclick="deleteServer({{ $server['id'] }})" 
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No servers found. Create your first server using the form above.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Server Management Instructions -->
            <div class="mt-6 bg-yellow-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h4 class="text-lg font-semibold text-yellow-800 mb-3">Server Management Notes</h4>
                    <ul class="space-y-2 text-yellow-700">
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Servers are billed hourly by Hetzner Cloud</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Delete servers when not needed to save costs</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>CX22 servers are suitable for light video processing</span>
                        </li>
                        <li class="flex items-start">
                            <span class="font-bold mr-2">•</span>
                            <span>Use CX42 or higher for heavy video conversion tasks</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Create Server
        document.getElementById('createServerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            try {
                const response = await fetch('{{ route('admin.servers.create') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert('Server created successfully!');
                    location.reload();
                } else {
                    alert('Error creating server: ' + result.error);
                }
            } catch (error) {
                alert('Error: ' + error.message);
            }
        });
        
        // Delete Server
        async function deleteServer(serverId) {
            if (!confirm('Are you sure you want to delete this server? This action cannot be undone.')) {
                return;
            }
            
            try {
                const response = await fetch('{{ route('admin.servers.destroy') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ server_id: serverId })
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert('Server deleted successfully!');
                    location.reload();
                } else {
                    alert('Error deleting server: ' + result.error);
                }
            } catch (error) {
                alert('Error: ' + error.message);
            }
        }
    </script>
</x-app-layout>