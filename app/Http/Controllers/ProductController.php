<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\CategoryModel;
session_start();

class ProductController extends Controller
{
    public function add_product(){
        $cate_product = CategoryModel::orderby('category_id','desc')->get();
        $brand_product = BrandModel::orderby('brand_id','desc')->get();
        return view('admin.add_product',compact('cate_product','brand_product'));
    }

    public function all_product(){
        $category_model = new CategoryModel;
        $all_product = ProductModel::orderby('product_id','desc')->get();
        return view('admin.all_product',compact('all_product'));
    }

    public function save_product(Request $request){
        $data =array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');
            if($get_image){
                
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();// lấy đuôi mở rộng
                $get_image->move('public/uploads/product',$new_image);
                $data['product_image'] = $new_image;
                ProductModel::insert($data);
                Session::put('message','thêm sản phẩm thành công');
                return Redirect::to('/add-product');
            }
        $data['product_image'] = '';
        ProductModel::insert($data);
        Session::put('message','thêm sản phẩm thành công');
        return Redirect::to('/add-product');
    }

    public function unactive_brand_product($brand_product_id){
        BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function edit_product($product_id){
        // $cate_product = CategoryModel::orderby('category_id','desc')->get();
        // $brand_product = BrandModel::orderby('brand_id','desc')->get();
        $edit_product=ProductModel::where('product_id',$product_id)->get(); 
        return view('admin.edit_brand_product',compact('edit_brand_product'));
    }
    
    public function update_brand_product($brand_product_id,Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        BrandModel::where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        BrandModel::where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
}
