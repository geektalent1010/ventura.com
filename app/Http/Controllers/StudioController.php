<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class StudioController extends Controller
{
    public function index()
    {
        $data['user'] = $user = auth()->user();

        return view('panel.studio.index', $data);
    }

    public function edit()
    {
        $data['user'] = $user = auth()->user();

        return view('panel.studio.edit', $data);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $profile = Profile::find($request->id);

        $profile->studio_header1 = $request->header1;
        $profile->studio_content1 = $request->content1;
        $profile->studio_footer1 = $request->footer1;
        $profile->studio_header2 = $request->header2;
        $profile->studio_content2 = $request->content2;
        $profile->studio_footer2 = $request->footer2;
        $profile->studio_header3 = $request->header3;
        $profile->studio_content3 = $request->content3;
        $profile->studio_footer3 = $request->footer3;
        $profile->studio_header4 = $request->header4;
        $profile->studio_content4 = $request->content4;
        $profile->studio_footer4 = $request->footer4;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateMode1(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->darken_mode_1 = $request->darken_mode_1;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateMode2(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->darken_mode_2 = $request->darken_mode_2;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateMode3(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->darken_mode_3 = $request->darken_mode_3;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function updateMode4(Request $request)
    {
        $profile = Profile::find($request->id);
        $profile->darken_mode_4 = $request->darken_mode_4;
        $profile->save();

        return response()->json(['success' => 'Profile successfully updated']);
    }

    public function uploadImage(Request $request)
    {
        $profile = auth()->user()->profile;
        $img_src = $request->img_src;
        switch ($request->field) {
            case 'studio-image-1':
                $profile->studio_image1 = $img_src;
                break;
            case 'studio-image-2':
                $profile->studio_image2 = $img_src;
                break;
            case 'studio-image-3':
                $profile->studio_image3 = $img_src;
                break;
            case 'studio-image-4':
                $profile->studio_image4 = $img_src;
                break;
        }

        $profile->save();

        return response()->json(['success' => 'Studio image successfully uploaded']);
    }

    public function removeImage(Request $request)
    {
        $profile = auth()->user()->profile;

        switch ($request->field) {
            case 'studio-image-1':
                $filename = $profile->studio_image1;
                $profile->studio_image1 = null;
                break;
            case 'studio-image-2':
                $filename = $profile->studio_image2;
                $profile->studio_image2 = null;
                break;
            case 'studio-image-3':
                $filename = $profile->studio_image3;
                $profile->studio_image3 = null;
                break;
            case 'studio-image-4':
                $filename = $profile->studio_image4;
                $profile->studio_image4 = null;
                break;
        }

        $profile->save();

        return response()->json(['success' => 'Studio image successfully removed']);
    }

    public function download(Request $request)
    {
        $filepath = public_path('images/avatar/') . $request->filename;
        $resized_filepath = public_path('images/logo/') . $request->filename;

        // Resize the image to 1080x1080
        $image = Image::make($filepath)->fit(1080, 1080);
        $image->save($resized_filepath);

        return Response::download($resized_filepath)->deleteFileAfterSend(true);
    }
}
