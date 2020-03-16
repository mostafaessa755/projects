<?php

namespace App\Http\Controllers;
use App\blog;
use Illuminate\Http\Request;

class blogcont extends Controller
{
    public function index(){
        $blogs = blog::all();
        return view('index',compact('blogs'));
    }
    public function show(blog $id){
        return view('showBlog')->with('blog',$id);
    }
    public function create(){
        return view('createBlog');
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:6',
            'desc'  => 'required'
        ]);
        $blogs = new blog();

        $blogs->title = $request->title;
        $blogs->description = $request->desc;
        $blogs->save();
        $request->session()->flash('done','Blog has created');
        return redirect('/');
    }
    public function edit(blog $id){
        return view('updateBlog')->with('blog',$id);
    }
    public function update(Request $request,blog $id){

        $this->validate($request,[
            'title'=>'required|min:6',
            'desc'=>'required'
        ]);

        $id->title = $request->input('title');
        $id->description = $request->get('desc');
        $id->save();
        $request->session()->flash('done','Blog has updated');
        return redirect('/');

    }
    public function delete(blog $id){
        $id->delete();
        session()->flash('done','Blog has deleted');
        return redirect('/');
    }
    public function complited(blog $id){
        if($id->complited){
            $id->complited= false;
            session()->flash('done','Blog not complited');

        }else{
            $id->complited= true;
            session()->flash('done','Blog has complited');

        }

        $id->save();
        return redirect('/');
    }
}
