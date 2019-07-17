<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Listings;
use App\Guest;
use App\Categories;
use App\ListingsRelation;


class ListingsController extends Controller
{

    public function listAll(Request $request)
    {
        if ($request->filled('keyword') or $request->filled('cat')) {
            $items = Listings::whereHas('categories', function($q)
            {
                $keyword = Input::get('keyword');
                $category = Input::get('cat');
                if($keyword != '') {
                    $matches[] = ['title', 'like', "%{$keyword}%"];
                }
                if($category != '') {
                    $matches[] = ['category_id', $category];
                }
                $q->where(
                    $matches
                );
            })->get();
        } else {
           $items = Listings::all();
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
        if($user = Auth::user()) {
           $user = $user->id;
        } else {
           $user = null;
        }
        $relation = new ListingsRelation;
        $relation->create(['listing_id' => $model->id, 'category_id' => $category, 'user_id' => $user]);
        if(Auth::guest()) {
            $name = $request->input('name');
            $email = $request->input('email');
            $guest = new Guest;
            $guest->create(['listing_id' => $model->id, 'name' => $name, 'email' => $email]);
        }
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

        ListingsRelation::where('listing_id', $id)->delete();
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