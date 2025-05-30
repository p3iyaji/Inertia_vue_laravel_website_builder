<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroImagesController extends Controller
{
    public function destroy(HeroImage $image)
    {
        Storage::delete($image->image);
        $image->delete();
        return response()->noContent();
    }
}
