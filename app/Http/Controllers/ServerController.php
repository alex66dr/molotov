<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Client;

class ServerController extends Controller
{
    private string $hetznerToken = 'q7IqPovKJQZAUU1cpCkOfTa0aF79wWd6nPkUkYlizhlqWNnPvCRulT0E2iq4xnEk';
    private string $hetznerApiUrl = 'https://api.hetzner-cloud.com/v1';

    /**
     * Display the server management page.
     */
    public function index(): View
    {
        try {
            $servers = $this->getServers();
            return view('admin.servers', compact('servers'));
        } catch (\Exception $e) {
            return view('admin.servers', ['servers' => [], 'error' => $e->getMessage()]);
        }
    }

    /**
     * Get all servers from Hetzner Cloud.
     */
    private function getServers(): array
    {
        $client = new Client();
        $response = $client->get($this->hetznerApiUrl . '/servers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->hetznerToken,
                'Content-Type' => 'application/json',
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['servers'] ?? [];
    }

    /**
     * Create a new server.
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'server_type' => 'required|string',
            'image' => 'required|string',
            'location' => 'required|string',
        ]);

        try {
            $client = new Client();
            $response = $client->post($this->hetznerApiUrl . '/servers', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->hetznerToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'name' => $request->name,
                    'server_type' => $request->server_type,
                    'image' => $request->image,
                    'location' => $request->location,
                    'ssh_keys' => [], // Add SSH keys if needed
                    'networks' => [], // Add networks if needed
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return response()->json(['success' => true, 'server' => $data['server']]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete a server.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validate([
            'server_id' => 'required|integer',
        ]);

        try {
            $client = new Client();
            $response = $client->delete($this->hetznerApiUrl . '/servers/' . $request->server_id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->hetznerToken,
                ]
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
