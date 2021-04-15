@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                LIỆT KÊ SẢN PHẨM
            </div>
            <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                        <option value="0">Bulk action</option>
                        <option value="1">Delete selected</option>
                        <option value="2">Bulk edit</option>
                        <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="input-sm form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null); 
                    }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Thương hiệu</th>
                            <th>Hiển thị/Ẩn</th>
                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_product as $key => $product_value)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{$product_value->product_name}}</td>
                            <td>{{$product_value->product_quantity}}</td>
                            <td>{{$product_value->product_price}}</td>
                            <td><img src="public/uploads/product/{{$product_value->product_image}}" height="100px" width="100px"></td>
                            <td>{{$product_value->category_name}}</td>
                            <td>{{$product_value->brand_name}}</td>
                            <td><span class="text-ellipsis">
                                    <?php
                                        if($product_value->product_status==1){
                                            ?>
                                        <a href="{{ url('/unactive-product/'.$product_value->product_id)}}"><span class="fa-thumb-styling-down fa fa-thumbs-up"></span></a>
                                        <?php
                                        }
                                        else{
                                            ?>
                                        <a href="{{ url('/active-product/'.$product_value->product_id)}}"><span class="fa-thumb-styling-up fa fa-thumbs-down"></span></a>
                                        <?php
                                        }
                                    ?>
                                    
                                </span>
                            </td>
                            {{-- <td><span class="text-ellipsis">26/3/2021</span></td> --}}
                            <td>
                                <a href="{{url('/edit-product/'.$product_value->product_id)}}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc muốn xóa không?')"  href="{{url('/delete-product/'.$product_value->product_id)}}" class="active styling-delete" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!!$all_product->links()!!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
