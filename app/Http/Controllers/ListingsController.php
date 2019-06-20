<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Listings;
use Illuminate\Support\Str;
class ListingsController extends Controller
{
    public function listAll()
    {
        $items = Listings::all();
        return view('classifieds/classified-all', ['item'=> $items]);
    }

    public function edit($id)
    {
        $items = Listings::find($id);
        return view('classifieds/classified-edit', ['item'=> $items]);
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));
        $model = new Listings;
        $model->title = $request->input('title');
        $model->slug = Str::slug($request->input('title'));
        $model->description = $request->input('description');
        $model->price = $request->input('price');

        if($request->input('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
            
            $model->image = $input['imagename'];
        }

        $model->save();

        return redirect('/classifieds')->with('info', 'You posted successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => 'Required',
            'description' => 'Required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ));
        $input['imagename'] = null;
        if($request->file('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
        }    
            
        $data = array(
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' =>  $input['imagename']
            );
        Listings::where('id', $id)->update($data);
        return redirect('/classifieds')->with('info', 'You updated successfully');
    }

    public function delete($id)
    {
        $items = Listings::find($id);
        $image_path = public_path('/images/'.$items->image);
        if(File::exists($image_path)) {
          File::delete($image_path);
        }
       Listings::where('id', $id)->delete();
       return redirect('/classifieds')->with('info', 'You deleted successfully');
      
    }


    public function deleteImage($id, $image)
    {
        $data = array(
            'image' =>  null
            );
        Listings::where('id', $id)->update($data);

       $image_path = public_path('/images/'.$image);
       if(File::exists($image_path)) {
         File::delete($image_path);
        }
        return redirect(route('editlisting', array($id)))->with('info', 'Image removed');
    }

    

}