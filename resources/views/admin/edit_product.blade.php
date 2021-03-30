@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Cập nhật sản phẩm
                </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null); 
                    }
                ?>
                <div class="panel-body">
                    <div class="position-center">
                    @foreach($edit_product as $key=>$edit_value)
                        <form role="form" action="{{url('/update-product/'.$edit_value->product_id)}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" value="{{$edit_value->product_name}}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" value="{{$edit_value->product_price}}" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{url('public/uploads/product/'.$edit_value->product_image)}}" width="100px" height="100px" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize:none" rows="8"  class="form-control" name="product_desc">{{$edit_value->product_desc}}"</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize:none" rows="8"  class="form-control" name="product_content" placeholder="Nội dung sản phẩm">{{$edit_value->product_content}}"</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="category_product" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate_value)
                                
                                    @if($cate_value->category_id==$edit_value->category_id)
                                    <option selected value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                                    @else
                                    <option value="{{$cate_value->category_id}}">{{$cate_value->category_name}}</option>
                                    @endif
                                
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="brand_product" class="form-control input-sm m-bot15">
                                
                                @foreach($brand_product as $key => $brand_value)
                                @if($brand_value->brand_id==$edit_value->brand_id)
                                <option selected value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                                @else
                                <option value="{{$brand_value->brand_id}}">{{$brand_value->brand_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        
                        <button type="submit"  name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
