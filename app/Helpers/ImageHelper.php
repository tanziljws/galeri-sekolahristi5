<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getImageUrl($filename)
    {
        // Lokasi yang akan dicek berurutan
        $locations = [
            ['base' => storage_path('app/public/galeri/'), 'asset' => 'storage/galeri/'],
            ['base' => public_path('storage/galeri/'), 'asset' => 'storage/galeri/'],
            ['base' => public_path('images/galeri/'),  'asset' => 'images/galeri/'],
        ];

        // Kumpulan kandidat nama file yang akan diuji
        $candidates = self::generateFilenameCandidates($filename);

        foreach ($locations as $loc) {
            foreach ($candidates as $candidate) {
                $full = rtrim($loc['base'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $candidate;
                if (file_exists($full)) {
                    // Use request()->getSchemeAndHttpHost() to get the correct base URL
                    $baseUrl = request()->getSchemeAndHttpHost();
                    return $baseUrl . '/' . $loc['asset'] . $candidate;
                }
            }
        }

        // Return placeholder jika file tidak ada
        $baseUrl = request()->getSchemeAndHttpHost();
        return $baseUrl . '/images/placeholder.jpg';
    }
    
    public static function getImagePath($filename)
    {
        $locations = [
            ['base' => storage_path('app/public/galeri/'), 'asset' => 'storage/galeri/'],
            ['base' => public_path('storage/galeri/'), 'asset' => 'storage/galeri/'],
            ['base' => public_path('images/galeri/'),  'asset' => 'images/galeri/'],
        ];

        $candidates = self::generateFilenameCandidates($filename);

        foreach ($locations as $loc) {
            foreach ($candidates as $candidate) {
                $full = rtrim($loc['base'], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $candidate;
                if (file_exists($full)) {
                    return $loc['asset'] . $candidate;
                }
            }
        }

        return 'images/placeholder.jpg';
    }

    /**
     * Membuat variasi kandidat nama file untuk toleransi ekstensi/spasi/kapital
     */
    private static function generateFilenameCandidates(string $filename): array
    {
        $filename = trim($filename);
        $candidates = [];

        // Tambahkan original
        if ($filename !== '') {
            $candidates[] = $filename;
        }

        // Normalisasi spasi/underscore dan huruf kecil
        $withoutExt = pathinfo($filename, PATHINFO_FILENAME);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $variants = [];
        $variants[] = $withoutExt;
        $variants[] = str_replace(' ', '_', $withoutExt);
        $variants[] = str_replace('_', ' ', $withoutExt);
        $variants = array_values(array_unique(array_map('strtolower', $variants)));

        // Ekstensi umum yang dicoba jika tidak ada atau salah kapital
        $exts = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
        if ($ext) {
            // juga coba versi lower-case dari ekstensi yang ada
            $exts = array_unique(array_merge([$ext, strtolower($ext), strtoupper($ext)], $exts));
        }

        foreach ($variants as $v) {
            foreach ($exts as $e) {
                $candidates[] = $v . '.' . $e;
            }
        }

        return array_values(array_unique($candidates));
    }
}
