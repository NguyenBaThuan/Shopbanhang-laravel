<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryProductModel;
use App\Models\BrandModel;
use App\Models\CatePost;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;



session_start();
class CategoryProduct extends Controller
{

    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('admin.dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        $category = CategoryProductModel::where('category_parent',0)->orderby('category_id','desc')->get();
        return view('admin.add_category_product',compact('category'));
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = CategoryProductModel::orderby('category_id','desc')->paginate(10);
        $category = CategoryProductModel::get();
        return view('admin.all_category_product',compact('all_category_product','category'));
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = new CategoryProductModel();
        $data->category_name = $request->category_product_name;
        $data->meta_keywords = $request->category_product_keywords;
        $data->category_parent = $request->category_parent;
        $data->slug_category_product =$request->slug_category_product;
        $data->category_desc = $request->category_product_desc;
        $data->category_status = $request->category_product_status;
        $data->save();
        // DB::table('tbl_category_product')->insert($data);
        Session::put('message','thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');


    }

    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Ẩn danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $category = CategoryProductModel::orderby('category_id','desc')->get();
        $edit_category_product=CategoryProductModel::where('category_id',$category_product_id)->get();
        return view('admin.edit_category_product',compact('edit_category_product','category'));
    }
    
    public function update_category_product($category_product_id,Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->category_product_keywords;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        CategoryProductModel::where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    // End function admin pages
    public function show_category_home(Request $request ,$slug_category_product){
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status',1)->take(4)->get();
        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();  
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->paginate(6);
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();
        foreach($category_name as $key => $val){
            //seo 
            $meta_desc = $val->category_desc; 
            $meta_keywords = $val->meta_keywords;
            $meta_title = $val->category_name;
            $url_canonical = $request->url();
            //--seo
            }
        return view('pages.category.show_category',compact('brand_product','cate_product','category_by_id','category_name','meta_desc','meta_keywords','meta_title','url_canonical','slider','category_post'));
       
    }


}
