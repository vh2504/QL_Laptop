<div class="col-md-3  fixside" >
    <div class="box-left box-menu" >
        <h3 class="box-title"><i class="fa fa-list"></i>  Danh mục</h3>
        <ul>
            @foreach ($categories as $cate)
                <li>
                    <a href="{{route('product-via-category', ['id' => $cate->id])}}" >{{ $cate->ten }}
                        <span class="badge pull-right">{{$cate->san_phams->count()}}</span>
                    </a>
                    @if ($cate->danh_muc_cons->count() > 0)
                        <ul>
                            @foreach ($cate->danh_muc_cons as $p)
                                <li><a href="">{{ $p->ten }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div class="box-left box-menu">
        <h3 class="box-title"><i class="fa fa-warning"></i>  Sản phẩm mới </h3>
       <!--  <marquee direction="down" onmouseover="this.stop()" onmouseout="this.start()"  > -->
        <ul>
            @foreach ($new_products as $p)
                <li class="clearfix">
                    <a href="{{route('detail', ['id' => $p->id])}}">
                        <img src="{{Voyager::image($p->anh)}}" class="img-responsive pull-left" width="80" height="80">
                        <div class="info pull-right">
                            <p class="name">{{$p->tensanpham}}</p >
                            <b class="price">Giảm giá: {{number_format($p->giasale, 0, '', '.') . "đ"}}</b><br>
                            <b class="sale">Giá gốc: {{number_format($p->giaban, 0, '', '.') . "đ"}}</b><br>
                            <span class="view"><i class="fa fa-eye"></i> 1000 : <i class="fa fa-heart-o"></i> 10</span>
                        </div>
                    </a>
                </li>
            @endforeach
             {{-- <li class="clearfix">
                <a href="">
                    <img src="images/16-270x270.png" class="img-responsive pull-left" width="80" height="80">
                    <div class="info pull-right">
                        <p class="name"> Loa  mới nhất 2016  Loa  mới nhất 2016 Loa  mới nhất 2016</p >
                        <b class="price">Giảm giá: 6.090.000 đ</b><br>
                        <b class="sale">Giá gốc: 7.000.000 đ</b><br>
                        <span class="view"><i class="fa fa-eye"></i> 100000 : <i class="fa fa-heart-o"></i> 10</span>
                    </div>
                </a>
            </li> --}}
           
        </ul>
        <!-- </marquee> -->
    </div>

    
</div>