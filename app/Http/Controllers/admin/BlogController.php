<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use function Laravel\Prompts\alert;

class BlogController extends Controller
{
//   public function index() {
//         $blogs = Blog::all();
//         return view('admin.pages.blogs.index', compact('blogs'));
//     }

//     public function create() {
//         return view('admin.pages.blogs.create');
//     }

//     public function store(Request $request) {
//         $blog = new Blog;
//         $blog->title = $request->title;
//         $blog->author = $request->author;
//         $blog->category = $request->category;
//         $blog->status = $request->status;
//         $blog->content = $request->content;

//         if ($request->hasFile('featuredImage')) {
//             $filename = $request->file('featuredImage')->store('blogs', 'public');
//             $blog->featured_image = $filename;
//         }

//         $blog->save();
//         return redirect()->route('admin.blog')->with('success', 'Blog created successfully.');
//     }

//     public function show($id) {
//         $blog = Blog::findOrFail($id);
//         return view('admin.pages.blogs.show', compact('blog'));
//     }

   

 public function index(){
        $blogs=Blog::with('user')->get();
        return view('admin.pages.blogs.index',compact('blogs'));
        
    }
    public function create(){
        $category=ProductCat::all();
        return view('admin.pages.blogs.create',compact('category'));
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'email' => 'nullable|email|exists:users,email',
        'author' => 'nullable|string|max:255',
        'category' => 'required|exists:product_cats,id',
        'status' => 'required|in:draft,published',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user = Auth::user();
    
    $imagePath = null;
    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('images/blogsImages'), $imageName);
        $imagePath = 'images/blogsImages/' . $imageName;
    }

    $blog = new Blog();
    $blog->title = $request->title;
    $blog->slug = Str::slug($request->title);
    $blog->content = $request->content;
    $blog->user_id = $user ? $user->id : null;
    $blog->product_cat_id = $request->category;
    $blog->is_published = $request->status === 'published';
    $blog->published_at = $request->status === 'published' ? now() : null;
    $blog->image = $imagePath;
    $blog->save();

    return redirect()->route('admin.blog')->with('success', 'Blog created successfully!');
}

    
  public function show($id){
    $blogitem = Blog::where('id', $id)->first();
   

    return view('admin.pages.blogs.show', compact('blogitem'));
}


public function edit($id) {
        $blog = Blog::with('product_cat')->findOrFail($id);
        $category=ProductCat::all();
        return view('admin.pages.blogs.edit', compact('blog','category'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'required|exists:product_cats,id',
        'status' => 'required|in:draft,published',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $blog = Blog::findOrFail($id);

    // Update fields
    $blog->title = $request->title;
    $blog->slug = Str::slug($request->title);
    $blog->content = $request->content;
    $blog->product_cat_id = $request->category;
    $blog->is_published = $request->status === 'published';
    $blog->published_at = $request->status === 'published' ? now() : null;

    // Handle new image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }

        $img = $request->file('image');
        $ext = $img->getClientOriginalExtension();
        $imageName = time() . '.' . $ext;
        $img->move(public_path('images/blogsImages'), $imageName);
        $blog->image = 'images/blogsImages/' . $imageName;
    }

    $blog->save();

    return redirect()->route('admin.blog')->with('success', 'Blog updated successfully.');
}


  public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    // Delete image from public folder
    if ($blog->image && file_exists(public_path($blog->image))) {
        unlink(public_path($blog->image));
    }

    $blog->delete();

    return redirect()->route('admin.blog')->with('success','Blog Deleted Successfully');
}

    
}
