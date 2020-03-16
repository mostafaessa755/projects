<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::all();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        //validate
        $request->validate([
            'name'        => 'required',
            'price'       => 'required',
            'description' => 'required',
            'image'       => 'image|required'
        ]);
        //uploade file
        if($request->hasFile('image'))
        {
            $image = $request->image;
            $image->move('uploads',$image->getClientOriginalName());
        }
        //save database
        product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $request->image->getClientOriginalName()
        ]);
        //session message
        $request->session()->flash('msg','product has been added');
        //redirct
        return redirect('admin/products/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::find($id);
        return view('admin.products.details',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find by id
        $product = product::find($id);
        //redirect
        return view('admin.products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //find product
        $product = product::find($id);
        //validtion
        $request->validate([
            'name'       => 'required',
            'price'      => 'required',
            'description'=>'required'
        ]);
        //check if image exist
        if($request->hasFile('image'))
        {
            //check if the old image exist
            if(file_exists(public_path('/uploads/').$product->image))
            {
                unlink(public_path('uploads/').$product->image);
            }
            //upload new image
            $image = $request->image;
            $image->move('uploads',$image->getClientOriginalName());
            $product->image =$request->image->getClientOriginalName();
        }
        //update product
        $product->update([
            'name'       => $request->name,
            'price'      => $request->price,
            'description'=> $request->description,
            'image'      =>$product->image
        ]);
        //session msg
        session()->flash('msg','product has updated');
        //redirect
        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete from database
        product::destroy($id);
        //session message
        session()->flash('msg','product has been deleted');
        //redirect
        return redirect('admin/products');
    }
}
