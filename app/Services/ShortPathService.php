<?php
namespace App\Services;

use Illuminate\Support\Str;
use App\Models\ShortPath;
use Cache;

class ShortPathService {
    public function findOrCreateShortUrl($original_url) {
        $record = ShortPath::where('original_url', $original_url)->first();

        if(!$record) {
            $record = ShortPath::create(['original_url' => $original_url, 'short_path' => Str::random(10)]);
        }

        return url($record->short_path);
    }

    public function findOriginalUrl($short_path) {
        $record = Cache::remember($short_path, 300, function () use ($short_path) {
            return ShortPath::where('short_path', $short_path)->first();
        });

        if(!$record) {
            return null;
        }

        return $record->original_url;
    }
}
