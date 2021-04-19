<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\ProductModel;
use App\Models\BrandModel;
use App\Models\Slider;
use App\Models\CategoryProductModel;
use App\Models\CatePost;
use App\Models\Gallery;
use Illuminate\Support\Facades\File;    
session_start();
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id('admin_id');
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
        ->paginate(5);
        return view('admin.all_product',compact('all_product'));
    }

    public function save_product(Request $request){
        $this->AuthLogin();
    	$data = array();
        
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $price_cost = filter_var($request->price_cost, FILTER_SANITIZE_NUMBER_INT);
       
    	$data['product_name'] = $request->product_name;
        $data['price_cost'] = $price_cost;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
        $data['product_price'] = $product_price;
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category_product;
        $data['brand_id'] = $request->brand_product;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_status;

        $get_image = $request->file('product_image');
        $get_document = $request->file('document');

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';
        $path_document = 'public/uploads/document/';
        //them hinh anh
        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
           
        }
        //them document
        if($get_document){

            $get_name_document = $get_document->getClientOriginalName();
            $name_document = current(explode('.',$get_name_document));
            $new_document =  $name_document.rand(0,99).'.'.$get_document->getClientOriginalExtension();
            $get_document->move($path_document,$new_document);
            $data['product_file'] = $new_document;
           
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');
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
        $data['product_quantity'] = $request->product_quantity;
        $data['product_slug'] = $request->product_slug;
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
    public function details_product($product_slug , Request $request){
        
        $category_post = CatePost::orderBy('cate_post_id','DESC')->get();
        $slider = Slider::orderby('slider_id','desc')->where('slider_status',1)->take(4)->get();
        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();
        $product_details = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_slug',$product_slug)
        ->get();

        foreach($product_details as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $product_cate = $value->category_name;
            $cate_slug = $value->slug_category_product;
                //seo 
                $meta_desc = $value->product_desc;
                $meta_keywords = $value->product_slug;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
                //--seo
            }
        $gallery = Gallery::where('product_id',$product_id)->get();
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_slug',[$product_slug])->orderby(DB::raw('RAND()'))->paginate(3);
        return view('pages.product.show_detail',compact('cate_product','brand_product','product_details','related_product','slider','meta_desc','meta_keywords','meta_title','url_canonical','category_post','gallery'));
    }

    // public function quickview(Request $request){

    //     $product_id = $request->product_id;
    //     $product = ProductModel::find($product_id);

    //     $gallery = Gallery::where('product_id',$product_id)->get();

    //     $output['product_gallery'] = '';
        
    //     foreach($gallery as $key => $gal){
    //         $output['product_gallery'].= '<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'"></p>';
    //     }

    //     $output['product_name'] = $product->product_name;
    //     $output['product_id'] = $product->product_id;
    //     $output['product_desc'] = $product->product_desc;
    //     $output['product_content'] = $product->product_content;
    //     $output['product_price'] = number_format($product->product_price,0,',','.').'VNĐ';
    //     $output['product_image'] = '<p><img width="100%" src="public/uploads/product/'.$product->product_image.'"></p>';

    //     $output['product_button'] = '<input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" id="buy_quickview" data-id_product="'.$product->product_id.'"  name="add-to-cart">';

    //     $output['product_quickview_value'] = '

    //     <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
                                            
    //     <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
                                          
    //     <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
                                            
    //     <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">

    //     <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">

    //     <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';

    //     echo json_encode($output);
       

    // }
}
