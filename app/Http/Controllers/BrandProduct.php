<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\BrandModel;
use App\Models\CategoryProductModel;

session_start();

class BrandProduct extends Controller
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

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = BrandModel::get();
        return view('admin.all_brand_product',compact('all_brand_product'));
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = new BrandModel();
        $data->brand_name = $request->brand_product_name;
        $data->brand_desc = $request->brand_product_desc;
        $data->brand_slug =  $request->brand_slug;
        $data->brand_status = $request->brand_product_status;
        $data->save();
        Session::put('message','thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Ẩn thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        BrandModel::where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product=BrandModel::where('brand_id',$brand_product_id)->get();
        return view('admin.edit_brand_product',compact('edit_brand_product'));
    }
    
    public function update_brand_product($brand_product_id,Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $brand = BrandModel::find($brand_product_id);
        // $brand = new Brand();
        $brand->brand_name = $data['brand_product_name'];
        $brand->brand_desc = $data['brand_product_desc'];
        $brand->brand_slug = $data['brand_product_slug'];
        $brand->brand_status = $data['brand_product_status'];
        $brand->save();
        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        BrandModel::where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }

    //End function admin pages
    public function show_brand_home(Request $request ,$brand_slug){
        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();
         
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.brand_slug',$brand_slug)->paginate(6);

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_slug',$brand_slug)->limit(1)->get();

        foreach($brand_name as $key => $val){
            //seo 
            $meta_desc = $val->brand_desc; 
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $url_canonical = $request->url();
            //--seo
        }

        return view('pages.brand.show_brand',compact('brand_product','cate_product','brand_by_id','brand_name','meta_desc','meta_keywords','meta_title','url_canonical'));
    }
}
