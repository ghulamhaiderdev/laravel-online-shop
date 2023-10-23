<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
//        DB::enableQueryLog();
        $categories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
                                   ->latest('id')
                                   ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');
        if(!empty($request->get('keyword')))
        {
            $categories = $categories->where('name', 'like', '%'.$request->get('keyword').'%');
        }
        $subCategories =  $categories->paginate(10);
//        $queries = DB::getQueryLog();

//        dd($subCategories);
        return view('admin.subcategory.index',compact('subCategories'));
    }

    public function create()
    {
        return view('admin.subcategory.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category_id' => 'required'
        ]);
        if ($validator->passes())
        {
            $subSategory = new SubCategory();
            $subSategory->name = $request->name;
            $subSategory->slug = $request->slug;
            $subSategory->status = $request->status;
            $subSategory->category_id = $request->category_id;
            $subSategory->show_home = $request->show_home;
            $subSategory->save();


            $request->session()->flash('success', 'Sub Category added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Sub Category added successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function edit($categoryId, Request $request)
    {
        $subCategory = SubCategory::find($categoryId);
        if(empty($subCategory))
        {
            return redirect()->route('subcategories.index');
        }
        return view('admin.subcategory.edit', compact('subCategory'));
    }

    public function update($categoryId, Request $request)
    {
        $subCategory = SubCategory::find($categoryId);
        if(empty($subCategory))
        {
            $request->session()->flash('error', 'Sub Category not found');
            return response()->json([
                'status'=> false,
                'notFound', true,
                'message' => 'Sub Category not found'
            ]);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$subCategory->id.',id'
        ]);

        if ($validator->passes())
        {
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category_id;
            $subCategory->show_home = $request->show_home;
            $subCategory->save();



            $request->session()->flash('success', 'Sub Category updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Sub Category updated successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId, Request $request)
    {
        $subCategory = SubCategory::find($categoryId);
        if(empty($subCategory))
        {
            $request->session()->flash('error', 'Sub Category not found');
            return response()->json([
                'status' => true,
                'message' => 'Sub Category deleted successfully'
            ]);
//            return redirect()->route('categories.index');
        }

        $subCategory->delete();
        $request->session()->flash('success', 'Sub Category deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Sub Category deleted successfully'
        ]);
    }
}
