<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::select(
            'posts.id', 'users.name AS name', 'posts.title', 'posts.content', 'posts.created_at', 'posts.updated_at')
            ->leftjoin('users', 'posts.editor_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'DESC')
            ->paginate(4);

        if (!$posts) {
            abort(404);
        }

        return view('blog.index',compact('posts'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        /*VALIDATE DATA BEFORE SAVE TO DATABASE*/
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:20'],
            'content' => ['required', 'string', 'min:3']
        ]);

        /*SAVE TO DATABASE*/
        $insert = BlogPost::create($request->only('title', 'content'));

        /*DISPLAY SUCCESS AND ERROR MESSAGE*/
        if($insert){
            $status = 'success';
            $message = 'Your blog is posted! ';
        }else{
            $status = 'unsuccessful';
            $message = 'There is an error occurred. Please contact administrator';
        }

        /*RETURN TO MAIN FORM PAGE*/
        return redirect()->route('blog.index')->with($status, $message);
    }

    public function show(BlogPost $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function edit(BlogPost $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog){
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:20'],
            'content' => ['required', 'string', 'min:3']
        ]);

        $update = $blog->fill($request->post())->save();

        if ($update){
            return redirect()->back()->with('success','Blog updated successfully');
        }

        return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');

    }

    public function destroy(BlogPost $blog)
    {
        $delete = $blog->delete();

        if ($delete){
            return redirect()->back()->with('success','Blog delete.');
        }

        return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');
    }
}
