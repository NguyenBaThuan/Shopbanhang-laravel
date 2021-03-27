<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryModel;
session_start();
class CategoryProduct extends Controller
{
    public function add_category_product(){
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $all_category_product = CategoryModel::get();
        return view('admin.all_category_product',compact('all_category_product'));
    }

    public function save_category_product(Request $request){

        $data = new CategoryModel();
        $data->category_name = $request->category_product_name;
        $data->category_desc = $request->category_product_desc;
        $data->category_status = $request->category_product_status;
        $data->save();
        // DB::table('tbl_category_product')->insert($data);
        Session::put('message','thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');


    }

    public function unactive_category_product($category_product_id){
        CategoryModel::where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function active_category_product($category_product_id){
        CategoryModel::where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function edit_category_product($category_product_id){
        $edit_category_product=CategoryModel::where('category_id',$category_product_id)->get();
        return view('admin.edit_category_product',compact('edit_category_product'));
    }
    
    public function update_category_product($category_product_id,Request $request){
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        CategoryModel::where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function delete_category_product($category_product_id){
        CategoryModel::where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }
}
