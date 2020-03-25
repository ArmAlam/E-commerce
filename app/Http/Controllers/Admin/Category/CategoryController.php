<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }

    public function storeCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
        ]);

        // Using Query builder
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // DB::table('categories')->insert($data);

        // Using Eloquent ORM
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();

        $notification = array(
            'messege' => 'Category added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function editCategory($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit_category', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:55',
        ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        $update = DB::table('categories')->where('id', $id)->update($data);
        if ($update) {
            $notification = array(
                'messege' => 'Category updated  successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('categories')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing to update',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }


    public function deleteCategory($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Category deleted  successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }



    public function brand()
    {
        $brand = Brand::all();
        return view('admin.category.brand', compact('brand'));
    }

    public function storeBrand(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
        ]);
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');
        if ($image) {
            //$image_name = str_random(5);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->insert($data);
            $notification = array(
                'messege' => 'Brand Inserted Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $brand = DB::table('brands')->insert($data);
            $notification = array(
                'messege' => 'Brand Inserted Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function editBrand($id)
    {
        $brand = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.edit_brand', compact('brand'));
    }


    public function updateBrand(Request $request, $id)
    {
        $old_logo = $request->old_logo;
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');
        if ($image) {
            unlink($old_logo);
            $image_name = date('dmy_H_s_i');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path . $image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            $data['brand_logo'] = $image_url;
            $brand = DB::table('brands')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands')->with($notification);
        } else {
            $brand = DB::table('brands')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Brand Inserted Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->route('brands')->with($notification);
        }
    }

    public function deleteBrand($id)
    {
        $data = array();
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;
        unlink($image);
        $brand = DB::table('brands')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function subcategories()
    {
        $category = DB::table('categories')->get();
        $subcat = DB::table('subcategories')
            ->join('categories', 'subcategories.category_id', 'categories.id')
            ->select('subcategories.*', 'categories.category_name')
            ->get();
        return view('admin.category.subcategory', compact('category', 'subcat'));
    }

    public function storeSubcat(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->insert($data);
        $notification = array(
            'messege' => 'Sub-Category added successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function editSubcat($id)
    {
        $subcat = DB::table('subcategories')->where('id', $id)->first();
        $category = DB::table('categories')->get();
        return view('admin.category.edit_subcat', compact('subcat', 'category'));
    }


    public function updateSubcat(Request $request, $id)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Sub-Category Updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('sub.categories')->with($notification);
    }

    public function deleteSubcat($id)
    {
        DB::table('subcategories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Sub-Category Deleted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
