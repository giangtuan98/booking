@extends('master')
@section('content')
<section class="bannercontainer">
    <div class="fullscreenbanner-container">
        <div class="fullscreenbanner">
            <ul>
                <li data-transition="parallaxvertical" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
                    <img src="public/source/Content/themes/startravel/img/home/slider/slider9.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                </li>
                <li data-transition="parallaxvertical" data-slotamount="5" data-masterspeed="1000" data-title="Slide 2">                            
                    <img src="public/source/Content/themes/startravel/img/home/slider/slider10.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                </li>
                <li data-transition="parallaxvertical" data-slotamount="5" data-masterspeed="700" data-title="Slide 3">
                    <img src="public/source/Content/themes/startravel/img/home/slider/slider7.jpg" alt="slidebg1" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">
                </li>
            </ul>
        </div>
    </div>
</section>
<section class="darkSection">
    <div class="container">
        <div class="row gridResize">
            <form action="{{route('booking')}}" method="post" id="form">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-sm-3 col-xs-12">
                    <div class="sectionTitleDouble">
                        <p>Vé</p>
                        <h2>Bắc <span>Nam</span></h2>
                        <a href="{{route('booking')}}" class="book-other">Chọn </a>
                        <a href=""><span>Điểm đi - Điểm đến</span></a>
                    </div>
                </div>
                <div class="col-sm-7 col-xs-12">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select class="select2bootstrap" id="departure" name="departure">
                                    <option value="">Điểm đi</option>
                                    @foreach($places as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="searchTour">
                                <select class="select2bootstrap" id="destination" name="destination"><option value="">Điểm đến</option>
                                    @foreach($places as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="input-group date ed-datepicker">
                                <input type="text" name="date" id="datebook" data-culture="vi" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" readonly="readonly" value="{{$nextdate}}">
                                <div class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12">
                            <div class="searchTour">
                                <select name="quantity" class="select2bootstrap" id="quantity">
                                    <option value="0">SỐ LƯỢNG</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-2 col-xs-12">
                    <input type="hidden" id="hdculture" value="vi" />
                    <input type="hidden" name="step" value="step1">
                    <input type="submit" class="btn btn-block buttonCustomPrimary btnSearchShift" value="T&#236;m chuyến" data-blank="1"/>
                </div>
            </form>
        </div>
        
    </div>
</section>
@endsection
@section('js-lightHeader')
<script>
    window.onscroll = function() {myFunction()};
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    function myFunction() {
      if (window.pageYOffset < 60) {
        navbar.classList.remove("lightHeader")
    } else {
        navbar.classList.add("lightHeader")
    }
}
</script>
@endsection