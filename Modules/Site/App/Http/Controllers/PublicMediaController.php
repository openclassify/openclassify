<?php

namespace Modules\Site\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Site\App\Support\LocalMedia;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PublicMediaController extends Controller
{
    public function show(Request $request, string $path): StreamedResponse
    {
        abort_unless(Storage::disk(LocalMedia::disk())->exists($path), 404);

        return Storage::disk(LocalMedia::disk())->serve($request, $path);
    }
}
