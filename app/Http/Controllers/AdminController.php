<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Jobs\ProcessVideoConversion;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard(): View
    {
        return view('admin.dashboard');
    }

    /**
     * Show the file upload form.
     */
    public function upload(): View
    {
        return view('admin.upload');
    }

    /**
     * Handle file upload.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov,wmv|max:2048000', // Max 2GB
            'upload_type' => 'required|in:local,remote',
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            if ($request->upload_type === 'local') {
                $path = $file->storeAs('videos', $filename, 'public');
            } else {
                $path = $file->storeAs('videos/remote', $filename, 'public');
            }

            // Dispatch the video conversion job
            ProcessVideoConversion::dispatch(
                $path,
                $request->upload_type,
                $file->getClientOriginalName()
            );

            return redirect()->route('admin.upload')->with('success', 'Video uploaded successfully and queued for conversion!');
        }

        return redirect()->route('admin.upload')->with('error', 'Failed to upload video.');
    }
}
