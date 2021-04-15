<!DOCTYPE html>

<head>
    <title>Quản lý admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/css/formValidation.min.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ADMIN
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="public/backend/images/2.png">
                            <span class="username">
                                <?php
                                    $admin_name =Auth::user()->admin_name;
                                    if($admin_name){
                                        echo $admin_name;
                                    }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="{{url('/logout-auth')}}"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{url('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        {{-- slide --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Slider</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                                <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                            </ul>
                        </li>
                           {{-- Đơn hàng --}}
                        </li>
                         <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                            </ul>
                        </li>
                        {{-- Mã giảm giá --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Quản lý mã giảm giá</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>
                        {{-- Vận chuyển --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                                
                                
                              
                            </ul>
                        </li>
                        {{-- Danh mục sản phẩm --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{url('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{url('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                              
                            </ul>
                        </li> 
                        {{-- Thương hiệu --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{url('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
                                <li><a href="{{url('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                              
                            </ul>
                        </li>  
                        {{-- Sản phẩm --}}
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{url('/add-product')}}">Thêm  sản phẩm</a></li>
                                <li><a href="{{url('/all-product')}}">Liệt kê sản phẩm</a></li>
                              
                            </ul>
                        </li> 
                           {{-- User --}}
                           @hasrole(['admin','author'])
                           <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-book"></i>
                                    <span>Users</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="{{URL::to('/add-users')}}">Thêm user</a></li>
                                    <li><a href="{{URL::to('/users')}}">Liệt kê user</a></li>
                                
                                </ul>
                            </li>
                            @endhasrole
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="public/backend/js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    {{-- Tính phí vận chuyển Ajax --}}

    <script type="text/javascript">
        $(document).ready(function(){
            fetch_delivery();
            function fetch_delivery(){
               var _token = $('input[name="_token"]').val();
               $.ajax({
                    url : '{{url('/select-feeship')}}',
                    method:'POST',
                    data:{_token:_token},
                    success:function(data){
                        $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur','.fee_ship_edit',function(){
                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url : '{{url('/update-delivery')}}',
                    method:'POST',
                    data:{feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                    success:function(data){
                        fetch_delivery();
                    }
                });
             
            });

            $('.add_delivery').click(function(){
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                // alert(city);
                // alert(province);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url : '{{url('/insert-delivery')}}',
                    method:'POST',
                    data:{city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                    success:function(data){
                        fetch_delivery();
                        alert('Thêm phí vận chuyển thành công');
                    }
                });

            });
            $('.choose').change(function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = ''; 
                // alert(action);
                // alert(ma_id);
                // alert(_token);

                
                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }  
                $.ajax({
                    url : '{{url('/select-delivery')}}',
                    method:'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            });
        })
    </script>

{{-- Thay đổi trạng thái order --}}
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr('id');
        var _token = $('input[name="_token"]').val();
        // lấy ra số lượng
        var quantity = [];
        $('input[name="product_sales_quantity"]').each(function(){
            quantity.push($(this).val());
        });
        // Lấy id product
        var order_product_id = [];
        $('input[name="order_product_id"]').each(function(){
            order_product_id.push($(this).val());
        });
        j=0;
        for(i=0;i<order_product_id.length;i++){
            //số lượng khách đặt
            var order_qty = $('.order_qty_'+order_product_id[i]).val();
            // số lượng tồn kho 
            var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();
            // alert(order_qty);
            // alert(order_qty_storage);
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j++;
                if(j==1)
                {
                    alert('sl bán ko đủ');
                }
                
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
            $.ajax({
                    url : '{{url('/update-order-qty')}}',
                    method:'POST',
                    data:{order_status:order_status,order_id:order_id,_token:_token
                        ,quantity:quantity,order_product_id:order_product_id},
                    success:function(data){
                        alert('Thay đổi trạng thái đơn hàng thành công');
                        location.reload();
                    }
                });
        }

    });
</script>
{{-- cập nhật số lượng --}}
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url : '{{url('/update-qty')}}',

                method: 'POST',

                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){

                    alert('Cập nhật số lượng thành công');
                 
                   location.reload();
                    
              
                    

                }
        });
    });
</script>


    <script type="text/javascript">
        CKEDITOR.replace('ckeditor');
        CKEDITOR.replace('ckeditor1');
    </script>
    <script src="{{asset('public/backend/js/formValidation.min.js')}}"></script>
    <script type="text/javascript">
        $.validate({

        });
    </script>




    <!-- //calendar -->
</body>

</html>
