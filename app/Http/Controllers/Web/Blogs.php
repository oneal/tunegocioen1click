<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Blogs extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::all();

        $activeBlog = true;

        $posts = Blog::orderBy('created_at', 'desc')->get();

        $data = getSeo(7);
        $title = $data['title'];
        $description =  $data['description'];

        return view('web.blog', compact('categories', 'posts', 'activeBlog', 'title', 'description'));
    }

    public function blogsCategory(Request $request, $category)
    {
        $category = BlogCategory::where('name_slug', $category)->first();

        $posts = null;
        if(isset($category)) {
            $posts = Blog::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
        }

        $data = getSeo(7);
        $title = $data['title'];
        $description =  $data['description'];

        return  view('web.blogs-category', compact('category', 'posts', 'title', 'description'));
    }

    public function post(Request $request, $slug)
    {
        $post = Blog::where('name_slug', $slug)->first();

        if(isset($post)) {
            $postAd = null;
            $dateNow = Carbon::now()->format('Y-m-d');
            if(isset($post->blogAd) && $post->blogAd->visible) {
                if(!isset($post->blogAd->invoice) && !isset($post->blogAd->date_start) && !isset($post->blogAd->date_end)) {
                    $postAd = $post->blogAd;
                } else if (!isset($post->blogAd->invoice) && isset($post->blogAd->date_start) && isset($post->blogAd->date_end)
                    && ($post->blogAd->date_start<=$dateNow && $post->blogAd->date_end >= $dateNow )) {
                    $postAd = $post->blogAd;
                } else if (isset($post->blogAd->invoice) && isset($post->blogAd->date_start) && isset($post->blogAd->date_end)
                    && ($post->blogAd->date_start<=$dateNow && $post->blogAd->date_end>= $dateNow )) {
                    $postAd = $post->blogAd;
                }
            }

            $title = $post['title'];
            $description =  substr(strip_tags($post['name']), 0,200);

            return  view('web.blog-post', compact('post', 'postAd', 'title', 'description'));
        }
        return redirect('/blog');
    }
}
