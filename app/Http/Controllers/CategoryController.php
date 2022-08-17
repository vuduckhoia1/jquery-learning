<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='Categories index';
        $data['user']=User::find(1);
        $data['categories']=Category::all();
        return view('categories/index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title']='Add Category';
        return view('categories/create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate(['name'=>'required']);
        $category=new Category(['name'=>$request->name]);
        $category->save();
        return redirect()->route('categories.index')->with(['message'=>'Create successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['title']='Edit Category';
        $data['category']=Category::findOrFail($id);
        return view('categories/edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $id=$request->category;
//        $data['name']=$request->name;
        Category::where(['id'=>$id])->update(['name'=>$request->name]);
        return redirect()->route('categories.index')->with(['message'=>'Update successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
//        $data['test']=$id;
        Category::where(['id'=>$id])->delete();
        return redirect()->route('categories.index')->with(['message'=>'Delete successfully!']);
//        return view('categories/test',$data);
    }
}
