<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title']='New feeds';
        $data['posts']=Post::orderBy('updated_at', 'DESC')->paginate(2);

        return view('posts/index',$data);

    }

    public function query(Request $request){
        $input = $request->category;
        $data = Category::select("name")
            ->where("name", "LIKE", "%{$input}%")->get();
        return response()->json($data);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content'=>'required_without:image',
            'image'=>'required_without:content'
        ]);
        $category=$request->category;
        $result=Category::whereName( $category)->get();
        if($result->isEmpty()) {
            $category_new = new Category(['name' => $category ]);
            $category_new->save();
        }
        $result2=Category::whereName($category)->get();
        $id=$result2->first()->id;

        $filename=null;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);

        }

//        dd($filename);
        $post_new= new Post(['content'=>$request->content,'images'=>$filename,
                        'user_id'=>auth()->user()->id,'category_id'=>$id]);
        $post_new->save();
        return back();





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
        $post=Post::whereId($id)->first();


        $this->authorize('update', $post);
        $request->validate([
            'content'=>'required_without:image',
            'image'=>'required_without:content'
        ]);
        $category=$request->category;
        $result=Category::whereName( $category)->get();
        if($result->isEmpty()) {
            $category_new = new Category(['name' => $category ]);
            $category_new->save();
        }
        $result2=Category::whereName($category)->get();
        $cate_id=$result2->first()->id;

        $filename=null;
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);

        }

//        dd($filename);

        Post::whereId($id)->update(['content'=>$request->content,'images'=>$filename,
            'user_id'=>auth()->user()->id,'category_id'=>$cate_id]);
        return back();
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
        $post=Post::whereId($id)->first();
        $this->authorize('destroy', $post);

        Post::whereId($id)->delete();
        return response()->json();
    }
}
