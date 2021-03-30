<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CategoryProductModel;
use App\Models\BrandModel;
use App\Models\ProductModel;

class HomeController extends Controller
{
    public function index(){
        $cate_product = CategoryProductModel::where('category_status',1)->orderby('category_id','desc')->get();
        $brand_product = BrandModel::where('brand_status',1)->orderby('brand_id','desc')->get();
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->select('tbl_product.*','tbl_category_product.category_name','tbl_brand.brand_name')
        // ->orderby('product_id','desc')
        // ->get();
        $all_product = ProductModel::where('product_status',1)->orderby('product_id','desc')->limit(4)->get();
        return view('pages.home',compact('cate_product','brand_product','all_product'));
    }
}
