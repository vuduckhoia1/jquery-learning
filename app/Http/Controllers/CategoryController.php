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
        $data['title'] = 'Categories index';
        $data['user'] = User::find(1);
        $data['categories'] = Category::all();
        return view('categories/index', $data);
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
        $category = Category::whereId($id)->first();
        $this->authorize('edit', $category);
        $data['title'] = 'Edit Category';
        $data['category'] = Category::findOrFail($id);
        return view('categories/edit', $data);
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
        $id = $request->category;
        //        $data['name']=$request->name;
        Category::where(['id' => $id])->update(['name' => $request->name]);
        return redirect()->route('categories.index')->with(['message' => 'Update successfully!']);
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
        $category = Category::whereId($id)->first();
        $this->authorize('destroy', $category);
        Post::whereCategory_id($id)->delete();
        Category::where(['id' => $id])->delete();

        return redirect()->route('categories.index')->with(['message' => 'Delete successfully!']);
        //        return view('categories/test',$data);
    }

    public function allCate(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
            0 => 'id',
            1 => 'name',
            2 => 'created_at',
        );

        $totalDataRecord = Category::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $categories = Category::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $categories =  Category::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order, $dir_val)
                ->get();

            $totalFilteredRecord = Category::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = array();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                // $datashow =  "#";
                // $dataedit =  route('categories.edit', $category->id);

                $postnestedData['id'] = $category->id;
                $postnestedData['name'] = $category->name;
                $postnestedData['created_at'] = date('j M Y h:i a', strtotime($category->created_at));
                // $postnestedData['options']= "&emsp;<a href='{$datashow}'class='showdata' title='SHOW DATA' ><span class='showdata glyphicon glyphicon-list'></span></a>&emsp;<a href='{$dataedit}' class='editdata' title='EDIT DATA' ><span class='editdata glyphicon glyphicon-edit'></span></a>";
                $data_val[] = $postnestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );

        return json_encode($get_json_data);
    }
}
