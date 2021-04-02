<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryProductModel;
use App\Models\BrandModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request){
        //seo 
        $meta_desc = "Chuyên bán những phụ kiện ,thiết bị game"; 
        $meta_keywords = "thiet bi game,phu kien game,game phu kien,game giai tri";
        $meta_title = "Phụ kiện,máy chơi game chính hãng";
        $url_canonical = $request->url();

        // --seo

        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand.brand_name')
        // ->orderby('product_id','desc')
        // ->get();
        $all_product = DB::table('tbl_product')->where('product_status','1')->orderby(DB::raw('RAND()'))->paginate(6); 
        return view('pages.home',compact('cate_product','brand_product','all_product','meta_desc','meta_keywords','meta_title','url_canonical'));
    }

    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get(); 
        // echo '<pre>';
        // print_r($search_product);
        // echo '</pre>';

        return view('pages.product.search', compact('cate_product','brand_product','search_product'));
        
    }
    
    public function send_mail(){
         //send mail
         $to_name = "Thuan Nguyen Shop";
         $to_email = "nguyenbathuan1998@gmailcom";//send to this email
        
      
         $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
         
         Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

             $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
             $message->from($to_email,$to_name);//send from this mail
         });
        //  return redirect('/trang-chu')->with('message','');
         //--send mail
    }
}
