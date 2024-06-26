<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth')->except(['home']);
    }

    public function index()
    {
        $contentLimitSetting = Setting::where('key', 'content_limit')->first();
        $contentLimit = $contentLimitSetting ? $contentLimitSetting->value : 50;
    
        $titleLimitSetting = Setting::where('key', 'title_limit')->first();
        $titleLimit = $titleLimitSetting ? $titleLimitSetting->value : 50;
    
        // Используем метод with для загрузки отношения user
        $posts = Post::with('user')->get();
    
        return view('posts.index', compact('posts', 'contentLimit', 'titleLimit'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('posts.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'user_id' => 'required|exists:users,id'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = Storage::url($imagePath);
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imagePath,
            'author' => $request->user_id,
            'user_id' => $request->user_id,
        ]);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $post->load('categories');
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $users = User::all();
        $post->load('categories');
        return view('posts.edit', compact('post', 'categories', 'users'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'nullable|string|max:255',
            'categories' => 'nullable|array',
            'user_id' => 'required|exists:users,id'
        ]);

        $imagePath = $post->image_url;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete(str_replace('/storage/', 'public/', $imagePath));
            }
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = Storage::url($imagePath);
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imagePath,
            'author' => $request->user_id,
            'user_id' => $request->user_id,
        ]);

        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image_url) {
            Storage::delete(str_replace('/storage/', 'public/', $post->image_url));
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    public function home()
    {
        $posts = Post::all();
        $categories = Category::all();
        // return view('home', compact('posts'));
        return view('home', compact('posts', 'categories'));
    }

    public function showByCategory(Category $category)
    {
        $posts = $category->posts()->with('categories', 'user')->get();
        return view('posts.category', compact('category', 'posts'));
    }
}
?>
