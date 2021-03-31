<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\CategoryProductModel;
session_start();

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = CategoryProductModel::orderby('category_id','desc')->get();
        $brand_product = BrandModel::orderby('brand_id','desc')->get();
        return view('admin.add_product',compact('cate_product','brand_product'));
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand.brand_name')
        ->orderby('product_id','desc')
        ->get();
        return view('admin.all_product',compact('all_product'));
    }

    public function save_product(Request $request){
        $this->AuthLogin();
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

    public function unactive_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Ẩn sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function active_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = CategoryProductModel::orderby('category_id','desc')->get();
        $brand_product = BrandModel::orderby('brand_id','desc')->get();
        $edit_product=ProductModel::where('product_id',$product_id)->get(); 
        return view('admin.edit_product',compact('edit_product','cate_product','brand_product'));
    }
    
    public function update_product($product_id,Request $request){
        $this->AuthLogin();
        $data =array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;
        $get_image=$request->file('product_image');
        if($get_image){
                
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =$name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();// lấy đuôi mở rộng
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            ProductModel::where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('/all-product');
        }
 
        ProductModel::where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        ProductModel::where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('/all-product');
    }

    // End function admin pages
    public function details_product($product_id){
        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)
        ->get();

        foreach($details_product as $key => $value)
        {
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->limit(3)
        ->get();
        return view('pages.product.show_detail',compact('cate_product','brand_product','details_product','related_product'));
    }
}
