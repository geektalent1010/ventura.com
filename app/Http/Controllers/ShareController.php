<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ShareController extends Controller
{
    public function index()
    {
        $data['user'] = auth()->user();

        $fileNames = [];
        $url = 'images/ads/';
        $path = public_path($url);

        $files = File::allFiles($path);

        foreach ($files as $file) {
            $fileNames[] = [
                'name' => pathinfo($file)['basename'],
                'src' => $url.pathinfo($file)['basename'],
            ];
        }
        $data['fileNames'] = $fileNames;

        return view('panel.share.index', $data);
    }

    public function link()
    {
        $data['user'] = auth()->user();

        return view('panel.share.link', $data);
    }

    public function download(Request $request)
    {
        $filepath = public_path('images/ads/').$request->filename;
        $resized_filepath = public_path('images/logo/').$request->filename;

        $maxWidth = 1080;
        $img = Image::make($filepath);
        $width = $img->width();
        if ($width != $maxWidth) {
            // Resize the image to 1080x1080
            $image = Image::make($filepath)->fit(1080, 1080);
            $image->save($resized_filepath);

            return Response::download($resized_filepath)->deleteFileAfterSend(true);
        } else {
            $filepath = public_path('images/ads/').$request->filename;

            return Response::download($filepath);
        }
    }
}
