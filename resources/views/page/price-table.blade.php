@extends('master')
@section('head-content')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
{{-- <meta name="csrf-token" content="{{ csrf_token() }}" /> --}}
@endsection
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle" style="background-image:url({{asset('public/source/Content/themes/startravel/img/pages/page-title-bang-gia.jpg')}} ) ;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="titleTable">
					<div class="titleTableInner">
						<div class="pageTitleInfo">
							<h1>Bảng giá vé xe khách</h1>

							<div class="under-border"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="mainContentSection padding-top-30">
	<div class="container">
		<div class="row liststop">
			<div class="col-sm-12 col-xs-12">
				<div class="darkSection citiesPage">
					<div class="row gridResize">
						<div class="col-sm-3 col-xs-12">
							<div class="sectionTitleDouble">
								<p>Giá vé</p>
								<h2>Bắc <span>Nam</span></h2>
							</div>
						</div>
						<div class="col-sm-7 col-xs-12">
							<form method="POST" action="{{route('price-table')}}" id="formLoadPriceByCity" class="form">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="row">
									<div class="col-sm-3 col-xs-12">
										<div class="searchTour">
											<select class="select2bootstrap select2-hidden-accessible" id="CityFrom" name="departure" tabindex="-1" aria-hidden="true"><option value="">Điểm đi</option>
												<?php $date = (isset($date)) ? $date : $nextdate ; ?>
												@foreach($places as $key => $value)
                                                                        <option value="{{$key}}" @if($departure_id == $key) selected @endif>{{$value}}</option>
                                                                        @endforeach
												}
											</select>
										</div>
									</div>
									<div class="col-sm-3 col-xs-12">
										
										<div class="input-group date ed-datepicker">
		                                <input type="text" name="date" id="datebook" data-culture="vi" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" readonly="readonly" value="{{$date}}">
		                                <div class="input-group-addon">
		                                    <span class="fa fa-calendar"></span>
		                                </div>
                            </div>
									</div>
									<div class="col-sm-3 col-xs-12">
										<input type="hidden" id="hddate">
										<input type="hidden" id="hdculture" value="vi">
										<input type="submit" value="Tìm giá vé" class="btn buttonCustomPrimary">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="row listprice" style="position: relative; zoom: 1;">

			<div class="col-xs-12">
				<div class="sectionTitle">
					<h2><span>Giá vé  từ {{$places[$departure_id]}}</span></h2>
					<h5>(Giá vé được áp dụng cho những chuyến xe xuất bến ngày {{$date}}. Giá vé có thể thay đổi tại thời điểm mua vé, vui lòng vào mục đặt vé để có giá chính xác nhất, ngày lễ Tết có bảng giá riêng.)</h5>
				</div>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="title">Điểm đến</th>
							<th class="title">Thời gian hành trình (giờ)</th>
							<th class="title">Giá vé (VNĐ)</th>
							<th class="title">Tìm chuyến</th>
						</tr>
					</thead>
					<tbody>
						@foreach($places as $key => $value)
						@if($key != $departure_id)

						<tr>
								<td>{{$value}}</td>
							@if(array_key_exists($key, $prices))
								<td>{{$prices[$key]->duration}}</td>
								<td class="color-red bold">{{number_format($prices[$key]->price)}}</td>
								<td><button {{-- target="_blank" --}} href="#" class="btn buttonTransparent btnSubmit" data-des-id = '{{$key}}' data-date = '{{$date}}' data-dep-id='{{$departure_id}}'>Tìm chuyến</button></td>
							@else
								<td>00:00</td>
								<td class="color-grey">Chưa có</td>
								<td><a  href="" class="btn buttonTransparent disabled" >Tìm chuyến</a></td>
							@endif
						</tr>
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<form action="{{route('booking')}} " method="POST" id='form_price'>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" id='destination' name="destination" value="">
		<input type="hidden" id='departure' name="departure" value="">
		<input type="hidden" name="quantity" value="1">
		<input type="hidden" id='date' name="date" value="">
	</form>
</section>
@endsection
@section('js-lightHeader')
<script>
$(document).ready(function(){
	$('.btnSubmit').on('click',function(){
        var dep_id = $(this).attr('data-dep-id');
        var des_id = $(this).attr('data-des-id');
        var date = $(this).attr('data-date');
        // var data = $("form#btn_addPL").serialize(); // lay thong tin tu form
        document.getElementById("destination").value = des_id;
        document.getElementById("departure").value = dep_id;
        document.getElementById("date").value = date;
        
         document.forms['form_price'].submit();

    });
})
</script>
@endsection

