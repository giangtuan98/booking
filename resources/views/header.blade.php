<header>
	<nav class="navbar navbar-default navbar-main navbar-fixed-top @yield('class-header')" id = "navbar" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{route('index')}}">
                        <img src="public/source/Images/logo_xe2.png" alt="logo-hl" width="235">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="{{route('index')}}">Trang chủ</a>
                        </li>
                        <?php  ?> 
                        <li class="">
                            <a href="{{route('booking')}}">Đặt vé</a>
                        </li>
                        <li class="">
                            <a href="{{ route('price-table')}}">Bảng giá</a>
                        </li>
                        <li>
                            <a href="{{route('ticket-purchase-guide')}}">Hướng dẫn mua vé</a>
                        </li>
                        <li>                                
                            <a href="https://www.facebook.com/giang.tuan.58" target="_blank"><img src="public/source/Images/fb.png" class="icon" height="15" /></a>                                
                        </li>
                    </ul>
                </div>

                <div class="language-mobile hidden-md hidden-lg hidden-sm" style="right: 30px">
                    <a href="javascript:;">
                        <a href="https://www.facebook.com/giang.tuan.58" target="_blank"><img src="public/source/Images/fb.png" class="icon" height="27" style="width: 27px" />
                    </a>
                </div>
            </div>
        </nav>
</header>