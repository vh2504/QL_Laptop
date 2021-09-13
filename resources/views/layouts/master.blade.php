<!DOCTYPE html>
<html>
    <head>
        <title>MaxShop</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        
        <script  src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <script  src="{{asset('js/bootstrap.min.js')}}"></script>

        <!---->
        <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/slick-theme.css')}}"/>
        <!--slide-->
        <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
        
    </head>
    <style>
        ul#main-shopping li {
            display: inline !important;
        }
        #main-shopping > li > a, #main-shopping > li > a  >i    {
            background: none;
        }
    </style>
    <body>
        <div id="wrapper">
            <!---->
            <!--HEADER-->
            <div id="header">

                <div class="container">
                    <div class="row" id="header-main">
                        <div class="col-md-5">
                            <form class="form-inline" method="GET" action="{{route('search')}}">
                                @csrf
                                <div class="form-group">
                                    {{-- <label>
                                        <select name="category" class="form-control">
                                            <option> All Category</option>
                                            <option> Dell </option>
                                            <option> Hp </option>
                                            <option> Asuc </option>
                                            <option> Apper </option>
                                        </select>
                                    </label> --}}
                                    <input type="text" name="keywork" placeholder="Search" class="form-control">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <a href="">
                                <img src="{{asset('images/logo-default.png')}}">
                            </a>
                        </div>
                        <div class="col-md-3" id="header-right">
                            <div class="pull-right">
                                <div class="pull-left">
                                    <i class="glyphicon glyphicon-phone-alt"></i>
                                </div>
                                <div class="pull-right">
                                    <p id="hotline">HOTLINE</p>
                                    <p>012345678</p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--END HEADER-->


            <!--MENUNAV-->
            <div id="menunav">
                <div class="container">
                    <nav>
                        <div class="home pull-left">
                            <a href="{{route('home')}}">Home</a>
                        </div>
                        <!--menu main-->
                        <ul id="menu-main">
                            <li>
                                <a href="{{route('list-product')}}">Shop</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}">Contact</a>
                            </li>
                            <li>
                                <a href="">About us</a>
                            </li>
                        </ul>
                        <!-- end menu main-->

                        <!--Shopping-->
                        <ul class="pull-right" id="main-shopping">
                            @if (!Auth::user())
                                <li>
                                    <a href="{{route('form-dangnhap')}}"><i class="fa fa-unlock"></i> Login</a>/
                                    <a href="{{route('form-dangky')}}">Register</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{route('cart-detail')}}"><i class="fa fa-shopping-basket"></i> My Cart
                                        {{-- @if ( session('soluong'))
                                            <span class="badge" style="color:red; background:white">{{session('soluong')}}</span>
                                        @endif --}}
                                        <span class="badge" style="color:red; background:white">
                                        <?php
                                            if(Auth::user()) {
                                                echo Auth::user()->gio_hang->soluong;
                                            }
                                            else 
                                                echo 0;
                                            ?>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-share-square-o"></i> Checkout</a>
                                </li> 
                                <li>
                                    <a href=""><i class="fa fa-user"></i> {{ Auth::user()->name }}<i class="fa fa-caret-down"></i></a>
                                </li>
                                <li>
                                    <a href="{{route('logout')}}" style="padding:0px; margin:0px; "><i class="fa fa-sign-out" style="color:red; font-size:16px"></i></i></a>
                                </li>
                            @endif
                            
                        </ul>
                        <!--end Shopping-->
                    </nav>
                </div>
            </div>
            <!--ENDMENUNAV-->
            
            <div id="maincontent">
                <div class="container">
                    <section id="slide" class="text-center"  style="margin-bottom:20px; ">
                        <img src="{{asset('images/slide/banner.webp')}}" class="img-thumbnail" style="padding:0px !important; margin-bottom:20px">
                    </section>
                    
                    @include('pages.sidebar.sidebar', ['categories' => $categories, 'products' => $new_products])
                    <div class="col-md-9 bor">

                        @yield('content')
                    </div>
                </div>

                <div class="container" style="margin-top: 30px">
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="{{asset('images/free-shipping.png')}}"></a>
                    </div>
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="{{asset('images/guaranteed.png')}}"></a>
                    </div>
                    <div class="col-md-4 bottom-content">
                        <a href=""><img src="{{asset('images/deal.png')}}"></a>
                    </div>
                </div>
                <div class="container-pluid">
                <section id="footer">
                    <div class="container">
                        <div class="col-md-3" id="shareicon">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-8" id="title-block">
                            <div class="pull-left">
                                
                            </div>
                            <div class="pull-right">
                                
                            </div>
                        </div>
                       
                    </div>
                </section>
                <section id="footer-button">
                    <div class="container-pluid">
                        <div class="container">
                            <div class="col-md-3" id="ft-about">
                                
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco </p>
                            </div>
                            <div class="col-md-3 box-footer" >
                                <h3 class="tittle-footer">my account</h3>
                                <ul>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Giới thiệu</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Liên hệ </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i>  Contact </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> My Account</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Giới thiệu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 box-footer">
                                <h3 class="tittle-footer">my account</h3>
                               <ul>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Giới thiệu</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Liên hệ </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i>  Contact </a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> My Account</a>
                                    </li>
                                    <li>
                                        <i class="fa fa-angle-double-right"></i>
                                        <a href=""><i></i> Giới thiệu</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3" id="footer-support">
                                <h3 class="tittle-footer"> Liên hệ</h3>
                                <ul>
                                    <li>
                                        
                                        <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i> Đường ...</p>
                                        <p><i class="sp-ic fa fa-mobile" style="font-size: 22px;padding-right: 5px;"></i> 012345678</p>
                                        <p><i class="sp-ic fa fa-envelope" style="font-size: 13px;padding-right: 5px;"></i> support@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="ft-bottom">
                    <p class="text-center">Copyright © 2021 </p>
                </section>
            </div>
        </div>      
    </div>
            </div>      
        </div>
    <script  src="js/slick.min.js"></script>

    </body>
        
</html>

<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })
</script>