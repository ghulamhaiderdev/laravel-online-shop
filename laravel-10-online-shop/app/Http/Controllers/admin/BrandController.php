<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::latest();
        if(!empty($request->get('keyword')))
        {
            $brands = $brands->where('name', 'like', '%'.$request->get('keyword').'%');
        }
        $brands =  $brands->paginate(10);
        return view('admin.brand.index',compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories'
        ]);

        if ($validator->passes())
        {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();


            $request->session()->flash('success', 'Brand added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully'
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
        $brand = Brand::find($categoryId);
        if(empty($brand))
        {
            return redirect()->route('brand.index');
        }
        return view('admin.brand.edit', compact('brand'));
    }

    public function update($brandId, Request $request)
    {
        $brand = Brand::find($brandId);
        if(empty($brand))
        {
            $request->session()->flash('error', 'Brand not found');
            return response()->json([
                'status'=> false,
                'notFound', true,
                'message' => 'Brand not found'
            ]);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brand->id.',id'
        ]);

        if ($validator->passes())
        {
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();



            $request->session()->flash('success', 'Brand updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Brand updated successfully'
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
        $brand = Brand::find($categoryId);
        if(empty($brand))
        {
            $request->session()->flash('error', 'Brand not found');
            return response()->json([
                'status' => true,
                'message' => 'Brand deleted successfully'
            ]);
//            return redirect()->route('categories.index');
        }

        $brand->delete();
        $request->session()->flash('success', 'Brand deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully'
        ]);
    }
}
