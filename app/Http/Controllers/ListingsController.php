<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listings;
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
            'description' => 'Required'
        ));
        $model = new Listings;
        $model->title = $request->input('title');
        $model->description = $request->input('description');
        $model->price = $request->input('price');
        if($request->input('image')) {
        $model->image = $request->input('image');
        }
        $model->save();

        return redirect('/classifieds')->with('info', 'You posted successfully');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => 'Required',
            'description' => 'Required'
        ));
        $data = array(
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image' => $request->input('image')
            );
        Listings::where('id', $id)->update($data);
        return redirect('/classifieds')->with('info', 'You updated successfully');
    }

    public function delete($id)
    {
       Listings::where('id', $id)->delete();
       return redirect('/classifieds')->with('info', 'You deleted successfully');
    }
}