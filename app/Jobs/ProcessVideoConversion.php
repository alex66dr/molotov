<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessVideoConversion implements ShouldQueue
{
    use Queueable;

    public $timeout = 3600; // 1 hour timeout
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public string $videoPath,
        public string $uploadType,
        public string $originalName
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Starting video conversion', [
            'video_path' => $this->videoPath,
            'upload_type' => $this->uploadType,
            'original_name' => $this->originalName
        ]);

        try {
            if ($this->uploadType === 'local') {
                $this->processLocalConversion();
            } else {
                $this->processRemoteConversion();
            }

            Log::info('Video conversion completed successfully', [
                'video_path' => $this->videoPath
            ]);
        } catch (\Exception $e) {
            Log::error('Video conversion failed', [
                'video_path' => $this->videoPath,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Process video conversion locally.
     */
    private function processLocalConversion(): void
    {
        // Simulate video conversion process
        Log::info('Processing video conversion locally', [
            'video_path' => $this->videoPath
        ]);

        // In a real implementation, you would use FFmpeg or similar
        // Example: shell_exec("ffmpeg -i {$this->videoPath} -c:v h264 -c:a aac output.mp4");
        
        // For now, just simulate processing time
        sleep(5); // Simulate conversion time
        
        // Create a "converted" file marker
        $convertedPath = str_replace('.', '_converted.', $this->videoPath);
        Storage::disk('public')->put($convertedPath, 'Converted video placeholder');
        
        Log::info('Local video conversion completed', [
            'original_path' => $this->videoPath,
            'converted_path' => $convertedPath
        ]);
    }

    /**
     * Process video conversion on remote server.
     */
    private function processRemoteConversion(): void
    {
        // Simulate remote video conversion process
        Log::info('Processing video conversion remotely', [
            'video_path' => $this->videoPath
        ]);

        // In a real implementation, you would:
        // 1. Upload the file to a remote Hetzner server
        // 2. Trigger conversion via SSH/API
        // 3. Download the converted file
        // 4. Clean up remote files
        
        // For now, just simulate processing time
        sleep(10); // Simulate longer remote processing time
        
        // Create a "converted" file marker
        $convertedPath = str_replace('.', '_remote_converted.', $this->videoPath);
        Storage::disk('public')->put($convertedPath, 'Remote converted video placeholder');
        
        Log::info('Remote video conversion completed', [
            'original_path' => $this->videoPath,
            'converted_path' => $convertedPath
        ]);
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('Video conversion job failed permanently', [
            'video_path' => $this->videoPath,
            'error' => $exception->getMessage()
        ]);
    }
}
