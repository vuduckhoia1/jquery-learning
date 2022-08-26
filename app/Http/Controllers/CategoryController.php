<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
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
        $data['categories']=Category::paginate(5);
        return view('categories/index',$data);
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
        $category=Category::whereId($id)->first();
        $this->authorize('edit',$category);
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
        $category=Category::whereId($id)->first();
        $this->authorize('destroy',$category);
        Post::whereCategory_id($id)->delete();
        Category::where(['id'=>$id])->delete();

        return redirect()->route('categories.index')->with(['message'=>'Delete successfully!']);
//        return view('categories/test',$data);
    }
}
