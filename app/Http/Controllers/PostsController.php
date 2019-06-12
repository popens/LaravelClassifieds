<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{

    //list all classifieds
    public function listAll()
    {
        $classifieds = Post::all();
        return url('classifieds', ['classifieds'=> $classifieds]);
    }
    //Create Classified
    public function create(Request $request)
    {
        # code...
        $this->validate($request, array(
            'title' => 'Required',
            'description' => 'Required'
        ));
        $model = new Post;
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->price = $request->input('price');
        if($request->input('image')) {
        $model->image = $request->input('image');
        }
        $model->save();

        return redirect('/classifieds')->with('info', 'You posted successfully');
    }

    //update classified
    public function update(Request $request)
    {
        # code...
    }

    //Delete
    public function delete()
    {
        # code...
    }
}
