<?php

namespace App\Http\Controllers;

use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        $file = $request->file('file');
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        $file3 = $request->file('file3');
        $file4 = $request->file('file4');
        if (isset($file) || isset($file1) || isset($file2) || isset($file3) || isset($file4)) {
            if (! file_exists(base_path().'/public/uploads/posts')) {
                mkdir(base_path().'/public/uploads/posts', 0777, true);
            }
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->getTimestamp();
            $filename = null;
            $filename1 = null;
            $filename2 = null;
            $filename3 = null;
            $filename4 = null;
            if (isset($file)) {
                $filename = $currentDateTime.uniqid().'.jpg';
                $file->move(base_path().'/public/uploads/posts', $filename);
            }
            if (isset($file1)) {
                $filename1 = $currentDateTime.uniqid().'.jpg';
                $file1->move(base_path().'/public/uploads/posts', $filename1);
            }
            if (isset($file2)) {
                $filename2 = $currentDateTime.uniqid().'.jpg';
                $file2->move(base_path().'/public/uploads/posts', $filename2);
            }
            if (isset($file3)) {
                $filename3 = $currentDateTime.uniqid().'.jpg';
                $file3->move(base_path().'/public/uploads/posts', $filename3);
            }
            if (isset($file4)) {
                $filename4 = $currentDateTime.uniqid().'.jpg';
                $file4->move(base_path().'/public/uploads/posts', $filename4);
            }

            $post = Post::create([
                'created_by' => $user->id,
                'title' => $request->title,
                'description' => $request->description,
                'subject' => $request->subject,
                'address' => $request->address,
                'event_date' => $request->event_date,
                'main_featured_image_url' => $filename,
                'small_featured_image_url1' => $filename1,
                'small_featured_image_url2' => $filename2,
                'small_featured_image_url3' => $filename3,
                'small_featured_image_url4' => $filename4,
                'type' => $request->type,
            ]);

            return response()->json(['success' => 'Post successfully uploaded']);
        }

        $post = Post::create([
            'created_by' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'subject' => $request->subject,
            'type' => $request->type,
        ]);

        return response()->json(['success' => 'Post successfully uploaded']);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $post = Post::find($request->id);
        $file = $request->file('file');
        $file1 = $request->file('file1');
        $file2 = $request->file('file2');
        $file3 = $request->file('file3');
        $file4 = $request->file('file4');
        if (isset($file) || isset($file1) || isset($file2) || isset($file3) || isset($file4)) {
            if (! file_exists(base_path().'/public/uploads/posts')) {
                mkdir(base_path().'/public/uploads/posts', 0777, true);
            }
            $currentDateTime = new DateTime();
            $currentDateTime = $currentDateTime->getTimestamp();
            $filename = null;
            $filename1 = null;
            $filename2 = null;
            $filename3 = null;
            $filename4 = null;
            if (isset($file)) {
                $filename = $post->main_featured_image_url ?? $currentDateTime.uniqid().'.jpg';
                $file->move(base_path().'/public/uploads/posts', $filename);
                $post->main_featured_image_url = $filename;
            }
            if (isset($file1)) {
                $filename1 = $post->small_featured_image_url1 ?? $currentDateTime.uniqid().'.jpg';
                $file1->move(base_path().'/public/uploads/posts', $filename1);
                $post->small_featured_image_url1 = $filename1;
            }
            if (isset($file2)) {
                $filename2 = $post->small_featured_image_url2 ?? $currentDateTime.uniqid().'.jpg';
                $file2->move(base_path().'/public/uploads/posts', $filename2);
                $post->small_featured_image_url2 = $filename2;
            }
            if (isset($file3)) {
                $filename3 = $post->small_featured_image_url3 ?? $currentDateTime.uniqid().'.jpg';
                $file3->move(base_path().'/public/uploads/posts', $filename3);
                $post->small_featured_image_url3 = $filename3;
            }
            if (isset($file4)) {
                $filename4 = $post->small_featured_image4_url ?? $currentDateTime.uniqid().'.jpg';
                $file4->move(base_path().'/public/uploads/posts', $filename4);
                $post->small_featured_image4_url = $filename4;
            }
        }
        if ($request->removeImage === 'true') {
            if ($post->main_featured_image_url && file_exists(base_path().'/public/uploads/posts/'.$post->main_featured_image_url)) {
                unlink(base_path().'/public/uploads/posts/'.$post->main_featured_image_url);
            }
            $post->main_featured_image_url = null;
        }
        if ($request->removeImage1 === 'true') {
            if ($post->small_featured_image_url1 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url1)) {
                unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url1);
            }
            $post->small_featured_image_url1 = null;
        }
        if ($request->removeImage2 === 'true') {
            if ($post->small_featured_image_url2 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url2)) {
                unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url2);
            }
            $post->small_featured_image_url2 = null;
        }
        if ($request->removeImage3 === 'true') {
            if ($post->small_featured_image_url3 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url3)) {
                unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url3);
            }
            $post->small_featured_image_url3 = null;
        }
        if ($request->removeImage4 === 'true') {
            if ($post->small_featured_image_url4 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url4)) {
                unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url4);
            }
            $post->small_featured_image_url4 = null;
        }

        $post->title = $request->title;
        $post->description = $request->description;
        $post->subject = $request->subject;
        $post->address = $request->address;
        $post->event_date = $request->event_date;
        $post->save();

        return response()->json(['success' => 'Post successfully updated']);
    }

    public function delete(Request $request)
    {
        $post = Post::find($request->id);
        if ($post->main_featured_image_url && file_exists(base_path().'/public/uploads/posts/'.$post->main_featured_image_url)) {
            unlink(base_path().'/public/uploads/posts/'.$post->main_featured_image_url);
        }
        if ($post->small_featured_image_url1 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url1)) {
            unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url1);
        }
        if ($post->small_featured_image_url2 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url2)) {
            unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url2);
        }
        if ($post->small_featured_image_url3 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url3)) {
            unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url3);
        }
        if ($post->small_featured_image_url4 && file_exists(base_path().'/public/uploads/posts/'.$post->small_featured_image_url4)) {
            unlink(base_path().'/public/uploads/posts/'.$post->small_featured_image_url4);
        }
        $post->delete();

        return response()->json(['success' => 'Post Successfully Deleted']);
    }

    public function likes(Request $request)
    {
        $authUserId = auth()->user()->id;
        $post = Post::find($request->id);
        $followers = [];
        $like = true;
        if ($post->followers && count(explode(',', $post->followers)) > 0) {
            $followers = explode(',', $post->followers);
            if (in_array($authUserId, $followers)) {
                $index = array_search($authUserId, $followers);
                array_splice($followers, $index, 1);
                $like = false;
            } else {
                array_push($followers, $authUserId);
            }
        } else {
            array_push($followers, $authUserId);
        }
        $post->followers = implode(',', $followers);
        $post->save();

        return response()->json(['like' => $like, 'followers' => count($followers)]);
    }
}
