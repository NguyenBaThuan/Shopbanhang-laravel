<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandModel;
session_start();

class BrandProduct extends Controller
{
    public function add_brand_product(){
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $all_brand_product = BrandModel::get();
        return view('admin.all_brand_product',compact('all_brand_product'));
    }

    public function save_brand_product(Request $request){

        $data = new BrandModel();
        $data->brand_name = $request->brand_product_name;
        $data->brand_desc = $request->brand_product_desc;
        $data->brand_status = $request->brand_product_status;
        $data->save();
        Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
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

    public function edit_brand_product($brand_product_id){
        $edit_brand_product=BrandModel::where('brand_id',$brand_product_id)->get();
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
