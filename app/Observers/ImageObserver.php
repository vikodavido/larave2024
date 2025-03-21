<?php

namespace App\Observers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver
{
    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {
        Storage::delete($image->getAttribute('path'));
    }
}