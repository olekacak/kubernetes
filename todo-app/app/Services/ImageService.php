<?php

namespace App\Services;

class ImageService
{
    private string $imagePath     = '/shared/image.jpg';
    private string $timestampPath = '/shared/image_timestamp';
    private int    $cacheDuration = 600; // 10 minutes

    public function imagePath(): string
    {
        if ($this->shouldRefresh()) {
            $this->fetchAndCache();
        }

        return $this->imagePath;
    }

    private function shouldRefresh(): bool
    {
        if (!file_exists($this->imagePath) || !file_exists($this->timestampPath)) {
            return true;
        }

        $timestamp = (int) file_get_contents($this->timestampPath);

        return (time() - $timestamp) >= $this->cacheDuration;
    }

    private function fetchAndCache(): void
    {
        $context = stream_context_create([
            'http' => [
                'follow_location' => true,
                'timeout'         => 10,
            ],
        ]);

        $image = file_get_contents('https://picsum.photos/1200', false, $context);

        if ($image !== false) {
            file_put_contents($this->imagePath, $image);
            file_put_contents($this->timestampPath, time());
        }
    }
}
