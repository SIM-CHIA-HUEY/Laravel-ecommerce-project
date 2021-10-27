<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    // ALL THIS HERE IS JUST TO RETURN THE -VIEW- OF BLOG POSTS :

    public function index(){
        // POSSIBILITY 1 : use return like in classic PHP
        /*
        //show all blog posts
        $posts = BlogPost::all(); //fetch all blog posts from DB
        return $posts; //returns the fetched posts
        */

        // POSSIBILITY 2 : use a method that Laravel gives, to return a view. Then do the layout design in View->Blog->index.blade.php
        $posts = BlogPost::all(); //fetch all blog posts from DB
        return view('blog.index', ['posts' => $posts,]); //returns the view with posts
    }

    public function show(BlogPost $blogPost)
    {
        // POSSIBILITY 1 : use return like in classic PHP
        /*
        return $blogPost; //returns the fetched posts
        */

        // POSSIBILITY 2 : use a method that Laravel gives, to return a view. Then View->Blog->show.blade.php
        return view('blog.show', [
            'post' => $blogPost,
        ]); //returns the view with the post
    }

    public function create(){
        //show form to create a blog post
        return view('blog.create');

    }

    public function store (Request $request){
        //save the post to database then redirect user to the created post
        $newPost = BlogPost::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => 1
            /* we are assigning our post to user_id 1.
            You can learn about Laravel authentication later
            to learn how to associate a post with the logged in user*/
        ]);
        // The return value is a redirection that will redirect to our single post route with the ID of the post.
        return redirect('blog/' . $newPost->id);

        // Then go modify our model (BlogPost.php) to prevent unwanted entries.
    }

    public function edit (BlogPost $blogPost){
        //returns the edit view with the post
        return view('blog.edit', [
            'post' => $blogPost
            //to have access to a variable called $post inside our view = the object containing the blog post we want to edit.
        ]);
    }

    public function update (Request $request, BlogPost $blogPost){
        //save the edited post : the $modelInstance->update() method accepts an associative array with keys of the table field
        // and the value will be the data we are updating
        $blogPost->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('blog/' . $blogPost->id);
    }

    public function destroy(BlogPost $blogPost){
        //Here, we are using the $modelInstance->delete() method that will delete the post from database.
        $blogPost->delete();

        return redirect('/blog');
    }
}
