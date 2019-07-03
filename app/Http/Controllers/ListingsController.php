<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Listings;
use App\Categories;
use App\ListingsRelation;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ListingsController extends Controller
{

    public function listAll(Request $request)
    {
        $items = Listings::all();
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $items = Listings::where('title', 'like', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%") ->get();
        }
        
        if ($request->has('cat')) {
            $cat = $request->input('keyword');
            //$items = Listings::with('categories')->get();
            //$items = Listings::where('category_id', 'like', "%{$cat}%")->get();
          
            $items = Listings::get(); //::find($post_id);
            $items = Listings::with(['categories' => function ($query) {
                $query->where('id', "1");
            }])->get();
            //$items = $post->categories()->where('category_id', $cat);
            echo "<pre>";
            var_dump($items[0]);
            echo "</pre>";
        }
        return view('classifieds/classified-all', ['item'=> $items]);
    }

    public function add() {
        $categories = Categories::all();
        return view('classifieds/classified-new', ['category'=> $categories]);
    }

    public function edit($id)
    {
        $items = Listings::find($id);
        $categories = Categories::all();
        return view('classifieds/classified-edit', ['item'=> $items, 'categories'=> $categories]);
    }

    public function view($id)
    {
        $items = Listings::find($id);
        return view('classifieds/classified-view', ['item'=> $items]);
    }

    public function create(Request $request)
    {
        $this->validate($request, array(
            'title' => 'Required',
            'description' => 'Required',
            'category' => 'Required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        $model = new Listings;
        $model->title = $request->input('title');
        $model->slug = Str::slug($request->input('title'));
        $model->description = $request->input('description');
        $model->price = $request->input('price');

        if($request->file('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['imagename']);
            
            $model->image = $input['imagename'];
        }
        $category = $request->input('category');
        $model->save();
        $listings = Listings::find($model->id);
        $listings->categories()->attach($category);
        return redirect()->route('classifieds')->with('info', 'You posted successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => 'Required',
            'description' => 'Required',
            'category' => 'Required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));

        if($request->file('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $input['imagename']);
        }    
        
        $data = array(
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        );

        if($request->file('image')) {
            $data = Arr::add($data, 'image', $input['imagename']);
        }
        $category = $request->input('category');
        Listings::where('id', $id)->update($data);
        ListingsRelation::where('listing_id', $id)->update(['category_id'=> $category]);
       
        return redirect()->route('classifieds')->with('info', 'You updated successfully');
    }

    public function delete($id)
    {
        $items = Listings::find($id);

        $image_path = public_path('/uploads/'.$items->image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        Listings::destroy($id);
       

        return redirect()->route('classifieds')->with('info', 'You deleted successfully');
    }

    public function deleteImage($id, $image)
    {
        $data = array(
            'image' =>  null
        );
        Listings::where('id', $id)->update($data);

        $image_path = public_path('/uploads/'.$image);
        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        return redirect(route('editlisting', array($id)));
    }
}