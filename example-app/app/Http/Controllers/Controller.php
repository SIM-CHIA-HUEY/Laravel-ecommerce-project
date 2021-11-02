<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

/*
A controller has 7 signature methods that enables crud operations:

index() – to fetch all the resources e.g. all blog posts available.
show() – to fetch a single resource e.g. a single blog post, say, post 5.
create() – shows the form to use to create a resource (not available for API controllers).
store() – to commit the resource to database e.g. save blog post.
index() – to show the form to edit the resource (not available for API controllers).
update() – to commit the edited resource to database.
destroy() – to delete a resource from database.
 */
