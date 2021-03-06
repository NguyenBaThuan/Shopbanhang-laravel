@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Thêm danh mục sản phẩm
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
                        <form role="form" action="{{url('/save-category-product')}}" method="post">
                        <div class="form-group" >
                            {{ csrf_field() }}
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" name="category_product_name"  onkeyup="ChangeToSlug();" class="form-control" id="slug" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug_category_product" class="form-control" id="convert_slug">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea id="ckeditor" style="resize:none" rows="8"  class="form-control" name="category_product_desc" placeholder="Mô tả danh mục"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Từ khóa danh mục</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="category_product_keywords" id="exampleInputPassword1" placeholder="Mô tả danh mục"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Thuộc danh mục</label>
                            <select name="category_parent" id="" class="form-control input-sm m-bot15">
                                <option value="0">---Danh mục cha---</option>
                                @foreach($category as $key => $val)
                                    <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_product_status" class="form-control input-sm m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                                
                            </select>
                        </div>
                        
                        <button type="submit"  name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                    </form>
                    </div>

                </div>
            </section>

    </div>
</div>
@endsection
