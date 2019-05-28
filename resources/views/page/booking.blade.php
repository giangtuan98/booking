@extends('master')
@section('class-header')
lightHeader
@endsection
@section('content')
<section class="pageTitle" style="background-image:url(public/source/Content/themes/startravel/img/pages/page-title-hcm.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="titleTable">
                    <div class="titleTableInner">
                        <div class="pageTitleInfo">
                            <h1>Đặt v&#233; trực tuyến</h1>
                            <div class="under-border"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="position: fixed; top: 0; width:100%; z-index: 1111; height: 100%;     background-color: rgba(0,0,0,0.5); display:none;" id="pageLoading">
    <div style="position: absolute; top: 45%; left: 40%;" class="text-center">
        <i class="fa fa-spinner fa-spin" style="font-size:70px; color: wheat;"></i>
        <p style="font-size:20px; color: wheat;">Đang xử lý dữ liệu ...</p>
    </div>
 </div>
    
<section class="mainContentSection packagesSection boxbooking">
    <div class="container">
        <div class="row tabsPart">
            <div class="col-sm-12">
                <div role="tabpanel">
                    {{-- <ul class="nav nav-tabs tabbn" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#oneway" aria-controls="oneway" role="tab" data-toggle="tab" aria-expanded="true" data-tickettype="0" data-culture="vi">
                                Đặt v&#233; một chiều
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#roundtrip" aria-controls="roundtrip" role="tab" data-toggle="tab" aria-expanded="true" data-tickettype="1" data-culture="vi">
                                Đặt v&#233; khứ hồi
                            </a>
                        </li>
                    </ul> --}}
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="oneway">
                            <div class="row progress-wizard hidden-xs" style="border-bottom:0;">
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-1 @if($step == 'step3') complete @endif">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        1. Tìm chuyến
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-2 @if($step == 'step3') complete @else disabled @endif">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                        2. Nhập thông tin
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-3 @if($step == 'step3') complete @else disabled @endif">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        3. Xác nhận thông tin
                                    </a>
                                </div>

                                <div class="col-sm-3 col-xs-12 progress-wizard-step progress-step-4 @if($step == 'step3') active @else disabled @endif">
                                    <div class="progress"><div class="progress-bar"></div></div>
                                    <a href="javascript:void(0)" class="progress-wizard-dot">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        4. Đặt vé thành công
                                    </a>
                                </div>
                            </div>
                            
                            <div class="positiontop"></div>
                            <div class="step1 bookinghcm " style="@if($step == 'step3') display:none;  @endif">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="darkSection citiesPage">
                                            <div class="row gridResize">
                                                <div class="col-sm-3 col-xs-12">
                                                    <div class="sectionTitleDouble">

                                                        <h2>Đặt <span>Vé</span></h2>
                                                        <a href="/dat-ve-cat-ba" class="book-other">Đặt vé <span>Cát Bà</span></a>
                                                        <a href="/dat-ve-chuyen-ngan" class="book-other">Đặt vé <span>Hà Nội - Hải Phòng</span></a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9 col-xs-12">
                                                    <form action="{{route('booking')}}" method="post" id="form">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        {{-- <input type="hidden" name="isAPI" value="0" /> --}}
                                                        <?php 
                                                        if($step == 'step1'){
                                                            $cart = Session::get('cart'); 
                                                            $destination = $cart['destination']['id'];
                                                            $destination_name = $cart['destination']['name'];
                                                            $departure = $cart['departure']['id'];
                                                            $departure_name = $cart['departure']['name'];
                                                            $quantity = $cart['quantity'];
                                                            $date = $cart['date'];
                                                        }else {
                                                            $destination = -1;
                                                            $date = $nextdate;
                                                            $departure = -1;
                                                            $quantity = 0;
                                                        }
                                                        if(\Cookie::has('customerInfo')){
                                                            $cus_info = \Cookie::get('customerInfo');
                                                            $cus_info = json_decode($cus_info);
                                                        }

                                                        ?>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select class="select2bootstrap" id="departure" name="departure"><option value="" selected>Điểm đi</option>
                                                                        @foreach($places as $key => $value)
                                                                        <option value="{{$key}}" @if($departure == $key) selected @endif>{{$value}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select class="select2bootstrap" id="destination" name="destination"><option value="">Điểm đến</option>
                                                                        @foreach($places as $key => $value)
                                                                        <option value="{{$key}}" @if($destination == $key) selected @endif>{{$value}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="input-group date ed-datepicker">
                                                                    <input type="text" class="form-control jqueryuidatepicker" data-mindate="+1D" data-maxdate="+100D" data-format="dd-mm-yy" id="datebook" name="date" readonly="readonly" value="{{$date}}">
                                                                    <div class="input-group-addon">
                                                                        <span class="fa fa-calendar"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <input type="hidden" id="hddate" />
                                                                <input type="hidden" id="hdculture" value="vi" />
                                                                <input type="hidden" name="step" value="step1">
                                                                <input type="button" value="Tìm chuyến" class="btn buttonCustomPrimary btnSearchShift" data-blank="1" />

                                                                
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="searchTour">
                                                                    <select name="quantity" class="select2bootstrap" id="quantity">
                                                                        <?php $i = 1; ?>
                                                                        @while($i < 6)
                                                                        <option value="{{$i}}" @if($quantity == $i) selected @endif>{{$i}}</option>
                                                                        <?php $i++; ?>
                                                                        @endwhile
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if( $step == 'step1')
                                <div class="row">
                                    <div class="col-sm-12  loadshifthcm">
                                        <div class="panel panel-default packagesFilter">
                                            <div class="panel-heading">
                                                <b>KẾT QUẢ TÌM KIẾM CHUYẾN XE HẢO NGUYỄN </b>
                                            </div>
                                            <div class="note" style="padding:10px">
                                                (Điểm đi <a target="_blank" href="/van-phong-dai-ly/8">@if(Session::has('cart')) <?php $cart = Session::get('cart'); echo($departure_name)?> @endif</a> đến <a target="_blank" href="">@if(Session::has('cart')) <?php echo($destination_name)?> @endif</a> Ngày đi {{$date}})
                                            </div>
                                            <div class="panel-body resultbooking">
                                                <div class="listshift">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="hidden-xs hidden-sm">Mã chuyến</th>
                                                                <th class="hidden-xs hidden-sm">Điểm đi</th>
                                                                <th>Giờ đi</th>
                                                                <th class="hidden-xs hidden-sm">Điểm đến</th>
                                                                <th class="hidden-xs hidden-sm">Giờ đến</th>
                                                                <th class="hidden-xs hidden-sm">Thời gian</th>
                                                                <th>Chỗ trống</th>
                                                                <th class="hidden-xs hidden-sm">Loại xe</th>
                                                                <th>Giá vé </th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($shiftInfo as $info)
                                                            <tr>
                                                                <td class="hidden-xs hidden-sm">{{$info->buses_id}}</td>
                                                                <td class="hidden-xs hidden-sm"><b>{{$departure_name}}</b></td>
                                                                <td>{{$info->depart_time}}</td>
                                                                <td class="hidden-xs hidden-sm"><b>{{$destination_name}}</b></td>
                                                                <td class="hidden-xs hidden-sm">{{$info->arrive_time}}</td>

                                                                <td class="hidden-xs hidden-sm">{{$info->duration}}</td>

                                                                <td><b>{{$info->available_seats}}</b></td>
                                                                <td class="hidden-xs hidden-sm"></td>
                                                                <td>{{number_format($info->price)}}</td>
                                                                <td>
                                                                    <a class="btn buttonTransparent btnSetVehicleId" data-id="{{$info->buses_id}}" data-dep="{{$info->departure}}" data-dep-name="{{$cart['departure']['name']}}" data-des="{{$info->destination}}" data-des-name="{{$cart['destination']['name']}}" data-starttime="{{$info->depart_time}}" data-date="{{$cart['date']}}" data-price="{{$info->price}}" data-datecheck="{{$cart['date']}}" data-quantity="{{$cart['quantity']}}"  data-chuyen="{{$info->buses_name}}" data-des-time="{{$info->depart_time}}">Đặt vé</a>

                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="bottombooking">
                                                    <div>
                                                        <u>Lưu ý:</u><br>
                                                        + <b>Điểm đi:</b> là điểm xuất bến của quý khách.<br>
                                                        + <b>Giờ đi:</b> là giờ dự kiến xuất bến trong ngày.<br>
                                                        + <b>Điểm đến:</b> là điếm đến bến cuối của quý khách.<br>
                                                        + <b>Giờ đến:</b> là giờ dự kiến đến thời gian này quý khách sẽ đến bến cuối.<br>
                                                        + <b>Thời gian:</b> là tổng thời gian dự kiến hành trình của xe.<br>
                                                        + <b>Chỗ trống:</b> Số lượng chỗ còn trống trên chuyến xe. Do quý khách chưa thanh toán lên số chỗ là mặc định theo từng loại xe.<br>
                                                        + <b>Giá vé:</b> Giá tiền được định giá quý khách phải trả để đi xe Hảo Nguyễn trên hành trình chọn.<br>
                                                    </div>
                                                    <br>
                                                    <img width="735" src="public/source/images/thequocte.gif" class="hidden-xs hidden-sm">
                                                </div>
                                            </div>
                                        </div><!--end panel-default-->
                                    </div>
                                </div>
                                @endif
                            </div>
                            <!--end class step1-->
                            <div class="step2" style="display: none;">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <form action="#" class="form" id="frBookingStep2" method="post"> 
                                            <a href="javascript:void(0)" class="btn buttonTransparent btnGoToStep" data-step="1">Trở lại bước 1</a>
                                            <div class="panel panel-default margin-top-10 pnlcustomerinfo packagesFilter">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Thông tin khách hàng</h3>
                                                </div>
                                                <div class="panel-body customerinfo">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">
                                                                Họ và tên (*)
                                                            </label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="text" class="form-control input-sm text" name="customername" id="customername" required="required" <?php if(isset($cus_info)) echo 'value = "' . $cus_info->name . '"'?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">Số điện thoại (*)</label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="text" class="form-control input-sm text " name="phone" id="phone" required="required" <?php if(isset($cus_info)) echo 'value = "' . $cus_info->phone . '"'?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">Email (*)</label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="email" class="form-control input-sm text " name="email" id="email" required="required" <?php if(isset($cus_info)) echo 'value = "' . $cus_info->email . '"'?>>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-xs-12 control-label">Địa chỉ</label>
                                                            <div class="col-sm-5 col-xs-12">
                                                                <input type="text" class="form-control input-sm text " name="address" id="address" <?php if(isset($cus_info)) echo 'value = "' . $cus_info->address . '"'?>>
                                                            </div>
                                                        </div>
                                                    </div>                   
                                                </div>
                                            </div>
                                            <div class="panel panel-default pnltransaction margin-top-10 packagesFilter">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Hình thức giao dịch</h3>
                                                </div>
                                                <div class="panel-body transaction">



                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="paymenttype" {{-- id="paymenttype" --}} value="1"> Thanh toán trực tiếp
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="panel panel-default pnlrules margin-top-10 packagesFilter">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Các điều kiện vận chuyển</h3>
                                                </div>
                                                <div class="panel-body rules">
                                                    <ol class="padding-left-20">
                                                        <li style="padding-bottom: 5px;">Vì lợi ích của khách hàng và công ty, khách hàng nên mang theo CMND khi sử dụng dịch vụ.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng có mặt tại điểm đón khách của Hảo Nguyên theo hướng dẫn của nhân viên bán vé trước giờ xe chạy ít nhất 30 phút để làm thủ tục.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không được hút thuốc trên xe.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không mang theo những hàng hóa nguy hiểm, động vật tươi sống, quý hiếm, hàng bị cấm lưu thông như vũ khí, các chất dễ cháy nổ, những thứ có mùi độc hại lên xe.</li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không mang theo những hàng hóa cấm trong danh mục quy định hàng cấm của nước Cộng Hoà Xã Hội Chủ Nghĩa Việt Nam.</li>
                                                        <li style="padding-bottom: 5px;">Vé chỉ có giá trị theo chuyến ngày và giờ ghi trên vé.</li>
                                                        <li style="padding-bottom: 5px;">
                                                            Quý khách được quyền Hủy vé/thay đổi thông tin chuyến dựa vào THỜI gian DỰ KIẾN XUẤT BẾN :
                                                            trước 12 tiếng được hủy/đổi miễn phí, từ 03 đến 12 tiếng được hủy/đổi và mất phí dịch vụ 10%,
                                                            trong vòng 03 tiếng được hủy/đổi và mất phí dịch vụ 30%.
                                                            Giá trị Vé sau khi trừ phí sẽ được hoàn lại trong vòng 03 ngày kể từ khi hủy vé.
                                                            Ngày Lễ - Tết có Quy định riêng
                                                        </li>
                                                        <li style="padding-bottom: 5px;">Khách hàng không được hủy, thay đổi thông tin khi mất vé này, khách hàng vẫn có thể đi xe nếu còn nhớ mã vé và mang theo CMND.</li>
                                                        <li style="padding-bottom: 5px;">Nếu vì điều kiện bất khả kháng (Thiên tai, tắc đường…) Công ty được quyền hủy hoặc thay đổi lịch và giờ chạy. Công ty có trách nhiệm thông báo trước mà không chịu bất cứ trách nhiệm nào.</li>
                                                        <li style="padding-bottom: 5px;">Mỗi hành khách được mang theo 30kg hành lý. Nếu vượt quá mức quy định thì phải đóng thêm phụ phí là 5000đ/kg. Các thiết bị máy móc,ti vi, máy tính cồng kềnh, xe máy... trong danh mục quy định hàng hóa của Công ty, không được tính là hành lý mang theo.</li>
                                                        <li style="padding-bottom: 5px;">Trong trường hợp khách hàng cho rằng nhân viên của công ty có những hành vi thiếu lịch sự hoặc sai quy chế, chúng tôi luôn tiếp nhận ý kiến của khách hàng theo số điện thoại, email, thư tay ở phần thông tin liên lạc.</li>
                                                    </ol>
                                                    <p></p><h3><u>Thông tin liên lạc</u></h3><p></p>
                                                    <ol class="padding-left-20">
                                                        <li style="padding-bottom: 5px;">Đường dây nóng:  <strong>0326522626</strong> - 0326522626 - 0326522626</li>
                                                        <li style="padding-bottom: 5px;">Email:haonguyen@gmail.com</li>
                                                        <li style="padding-bottom: 5px;">Địa chỉ: Phòng Điều hành trung tâm, Công ty TNHH vận tải Hảo Nguyễn, Số 21 Ngõ 41 Đông Tác Đống Đa Hà Nội</li>
                                                        <li style="padding-bottom: 5px;">Đặt vé trực tuyến: <a href="/dat-ve-bac-nam" title="booking online">http://www.haonguyen.com/dat-ve</a></li>
                                                    </ol>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" id="privacy" name="privacy" value="1" disabled="disabled"> Tôi đồng ý với các điều khoản sử dụng dịch vụ<br>
                                                        </label>
                                                    </div>
                                                    <input type="submit" class="btn buttonCustomPrimary" disabled="disabled" id="confirm-button" data-culture="vi" value="Xác nhận đặt vé">
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>


                                {{-- <div class="modal fade CbModal" tabindex="-1" role="dialog" id="modal_remittance_1">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Hình Thức Thanh Toán Trực Tiếp</h4>
                                            </div>
                                            <div class="modal-body">
                                                <b>Thanh toán trực tiếp là </b>: Khách hàng sau khi thực hiện các bước đặt vé sẽ nhận được 1 mã vé GIỮ CHỖ. Mã vé này sẽ được hệ thống giữ trong
                                                1 khoảng thời gian nhất định (tùy theo tuyến xe) và KHÔNG ĐƯỢC CHỈ ĐỊNH GIƯỜNG/GHẾ.
                                                Khách hàng có thể ra Văn phòng / Đại lý của Hảo Nguyễn, đọc mã vé để nhân viên chọn Giường/Ghế cụ thể cho mã vé.
                                                Danh sách Văn phòng / Đại lý vui lòng xem (<a target="_blank" href="http://haonguyen.net/van-phong-dai-ly">TẠI ĐÂY </a>)
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn buttonTransparent hover" data-dismiss="modal">Đã Hiểu</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade CbModal" tabindex="-1" role="dialog" id="modal_remittance_2">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Hình Thức Thanh Toán Chuyển Khoản</h4>
                                            </div>
                                            <div class="modal-body">
                                                <b>Thanh toán chuyển khoản là </b>: Khách hàng sau khi thực hiện các bước đặt vé sẽ nhận được 1 mã vé GIỮ CHỖ.
                                                Mã vé này sẽ được hệ thống giữ trong 1 khoảng thời gian nhất định (tùy theo tuyến xe) và KHÔNG ĐƯỢC CHỈ ĐỊNH GIƯỜNG/GHẾ.
                                                Khách hàng liên hệ hotline 0225 3920 920 để xác nhận lại thông tin trước khi tiến hành Chuyển khoản cho Hảo Nguyễn.
                                                Khách hàng có thể thanh toán theo các thông tin sau : Quý khách có thể thanh toán trực tiếp tại các Văn phòng,
                                                đại lý của Hảo Nguyễn, hoặc chuyển khoản qua các TK Ngân hàng sau: <br>
                                                <b>Tên NH: Ngân hàng Thương mại cổ phần Ngoại thương Việt Nam</b> <br>
                                                Số TK: 003 100 0991422 <br>
                                                Tên chủ TK: Công ty TNHH Vận tải Hảo Nguyễn <br>
                                                <b> Tên NH: Ngân hàng TECHCOMBANK</b> <br>
                                                Số TK: 109 218 68108017 <br>
                                                Tên chủ TK: Công ty TNHH Vận tải Hảo Nguyễn <br>
                                                <br>
                                                <b> Tên NH: Ngân hàng Đầu tư và Phát triển Việt Nam (BIDV)</b> <br>
                                                Số TK: 321 100 00498978 <br>
                                                Tên chủ TK: Công ty TNHH Vận tải Hảo Nguyễn
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn buttonTransparent hover" data-dismiss="modal">Đã Hiểu</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                <div class="modal fade CbModal modal_remittance_3" tabindex="-1" role="dialog" id="modal_remittance_3">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>HÌNH THỨC THANH TOÁN TRỰC TIẾP</h4>
                                                <a href="javascript:void(0)" id="paymenttype_noti_1">(Thanh Toán Trực Tiếp Là Gì?)</a>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <b>Thanh toán trực tiếp tại cửa hàng Tiện ích Vinmart+ </b>: Khách hàng sau khi thực hiện các bước đặt vé sẽ nhận được 1 mã vé GIỮ CHỖ.
                                                    Mã vé này sẽ được hệ thống giữ trong 1 khoảng thời gian nhất định (tùy theo tuyến xe) và KHÔNG ĐƯỢC CHỈ ĐỊNH GIƯỜNG/GHẾ.
                                                    Khách hàng có thể ra Bất kì cửa hàng/siêu thị tiện ích của Vinmart+ cho phép THANH TOÁN VÉ XE HẢO NGUYỄN,
                                                    đọc MÃ THANH TOÁN để hoàn thành thủ tục.
                                                    Danh sách Cửa hàng/Siêu thị tiện ích Vinmart+ vui lòng XEM (<a target="_blank" href="/huong-dan-thanh-toan-vinmart">TẠI ĐÂY </a>)
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn buttonTransparent hover" data-dismiss="modal">Đã Hiểu</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                                <script>
                                    $(function () {
                                        $("#adults").trigger("change");
                                        $("#paymenttype_noti_1").unbind('click').click(function () {
                                            $('#modal_remittance_1').modal('show');
                                        });
                                        $("#paymenttype_noti_2").unbind('click').click(function () {
                                            $('#modal_remittance_2').modal('show');
                                        });
                                        $(".paymenttype_noti_3").unbind('click').click(function () {
                                            $('.modal_remittance_3').modal('show');
                                        });
                                    })
                                </script> --}}
                            </div>
                            <!--end step2-->
                            <div class="step3" style="display: none;">
                                <a href="javascript:;" class="btn buttonTransparent btnGoToStep" data-step="2">Trở lại bước 2</a>
                                <div class="panel panel-default pnlconfirminfo packagesFilter margin-top-10">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Xác nhận thông tin đặt vé</h3>
                                    </div>
                                    <div class="panel-body confirminfo ">
                                        <input type="hidden" id="hddep" value="10">
                                        <input type="hidden" id="hdshift" name="shift" value="134">
                                        <table class="table ">

                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Họ và tên
                                                    </td>
                                                    <td id="customername_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Số điện thoại
                                                    </td>
                                                    <td id="phone_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Email
                                                    </td>
                                                    <td id="email_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Địa chỉ
                                                    </td>
                                                    <td id="address_tb"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Điểm đi - Điểm đến
                                                    </td>
                                                    <td id="de_des"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Chuyến
                                                    </td>
                                                    <td id="chuyen_tb">

                                                        {{-- ??? chưa xong --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Dự kiến khách hàng sẽ lên xe tại Hà Nội lúc:
                                                    </td>
                                                    <td id="date_tb">
                                                        <span class="bold"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Số lượng người đi
                                                    </td>
                                                    <td>
                                                        <span class="bold" id="quantity_tb"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Giá vé 
                                                    </td>
                                                    <td >
                                                        <span class="bold" id="price_tb"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tổng tiền
                                                    </td>
                                                    <td >
                                                        <span class="bold" id="total_tb"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Hình thức giao dịch
                                                    </td>
                                                    <td id="paymenttype_tb">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default pnlconfirmseat packagesFilter margin-top-10">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Xác nhận đặt vé</h3>
                                        <div class="row">
                                            <div class="col-sm-2 col-xs-12">Mã xác nhận</div>
                                            <div class="col-sm-4 col-xs-12 form-group">
                                                <input type="hidden" name="CapImageText" id="CapImageText" value="383802">
                                                <input type="text" class="form-control" autocomplete="off"  placeholder="" id="CaptchaCodeText" name="CaptchaCodeText" required="required">
                                                <span class="notecaptcha" id="notecaptcha" style="display: none;">(Mã không đúng)</span>
                                                <span class="note">(Vui lòng nhập mã xác nhận từ email của bạn)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body confirminfo">
                                        <form action="{{route('booking')}}" method="POST" class="form" id="form_step3">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="hidden" name="step" value="step3">
                                            <input type="hidden" name="paymenttype" id="paymenttype_hd" >
                                            <input type="hidden" name="departure" id="departure_hd">
                                            <input type="hidden" name="destination" id="destination_hd">
                                            <input type="hidden" name="date" id="date_hd">
                                            <input type="hidden" name="starttime" id="starttime_hd">
                                            <input type="hidden" name="price"id="price_hd">
                                            <input type="hidden" name="shift" id="shift_hd">
                                            <input type="hidden" name="shift-id" id="shift_id_hd">
                                            <input type="hidden" name="customername" id="customername_hd">
                                            <input type="hidden" name="phone" id="phone_hd" >
                                            <input type="hidden" name="email" id="email_hd" >
                                            <input type="hidden" name="address" id="address_hd" >
                                            <input type="hidden" name="quantity" id="quantity_hd">
                                            <div class="listseat ">
                                                <div class="row">
                                                    <div class="col-sm-2 col-xs-12"></div>
                                                    <div class="col-sm-9 col-xs-12 form-group">
                                                        {{-- <input type="hidden" name="seat" id="seat"> --}}
                                                        <input type="button" value="Đặt vé" class="btn buttonCustomPrimary btnConfirmTicket" data-culture="vi">
                                                        <input type="button" value="Gửi lại" class="btn buttonCustomPrimary" id="btnSendCodeAgain">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <!--end step3-->
                            @if($step == 'step3')
                            <div class="step4" style="display: block;">
                                <div class="panel panel-default pnlconfirminfo packagesFilter">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Xác nhận thông tin đặt vé</h3>
                                    </div>

                                    <div class="panel-body confirminfo row-fluid">
                                        <input type="hidden" id="hddep" value="10">
                                        <input type="hidden" id="hdshift" name="shift" value="4">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                <td>
                                                    Mã đặt vé
                                                </td>
                                                <td>
                                                    <span class="bold">{{$detail['ticket_id']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Họ và tên
                                                </td>
                                                <td>
                                                    {{$detail['customername']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Số điện thoại
                                                </td>
                                                <td>
                                                    {{$detail['phone']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Email
                                                </td>
                                                <td>
                                                    {{$detail['email']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Địa chỉ
                                                </td>
                                                <td>
                                                    {{$detail['address']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Điểm đi - Điểm đến
                                                </td>
                                                <td>
                                                    {{$detail['departure'] .' - '. $detail['destination']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Chuyến
                                                </td>
                                                <td>
                                                    {{$detail['shift']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Dự kiến khách hàng sẽ lên xe tại Hà Nội lúc:
                                                </td>
                                                <td>
                                                    <span class="bold">{{$detail['starttime'] . ' Ngày ' . $detail['date']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Số lượng người đi 
                                                </td>
                                                <td>
                                                    <span class="bold">{{$detail['quantity']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Giá vé 
                                                </td>
                                                <td>
                                                    <span class="bold">{{$detail['price']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Tổng tiền
                                                </td>
                                                <td>
                                                    <span class="bold">{{$detail['quantity']*$detail['price']}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Hình thức giao dịch
                                                </td>
                                                <td>
                                                    Thanh toán trực tiếp
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                </div>
                                <div class="panel panel-default pnlconfirmseat packagesFilter margin-top-10">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Xác nhận đặt vé</h3>
                                    </div>
                                    <div class="panel-body confirminfo row-fluid">
                                        <script>
                                            setTimeout(ClearSession(), 10000);
                                        </script>
                                        <div class="row-fluid" style="padding:10px;">
                                            <h3>Bạn đã đặt vé thành công</h3>
                                            <p>
                                                Cảm ơn quý khách đã sử dụng dịch vụ đặt vé trực tuyến của Công ty Vận tải Hảo Nguyễn.
                                            </p>
                                            <br>Quý khách có thể thanh toán trực tiếp tại các <a href="/van-phong-dai-ly"><font color="red"><b>Văn phòng, đại lý</b></font></a> của Hảo Nguyễn, hoặc chuyển khoản qua các TK Ngân hàng sau:
                                            <p>
                                                <b>Tên NH: Ngân hàng Thương mại cổ phần Ngoại thương Việt Nam</b>
                                                <br>&nbsp;&nbsp;Số TK: 1234 5678 91011
                                                <br>&nbsp;&nbsp;Tên chủ TK: Công ty TNHH Vận tải Hảo Nguyễn
                                            </p>
                                            <p>
                                                <b>Tên NH: Ngân hàng TECHCOMBANK</b>
                                                <br>&nbsp;&nbsp;Số TK: 1234 5678 91011
                                                <br>&nbsp;&nbsp;Tên chủ TK: Công ty TNHH Vận tải Hảo Nguyễn
                                            </p>
                                            <p>
                                                <b>Tên NH: Ngân hàng Đầu tư và Phát triển Việt Nam (BIDV)</b>
                                                <br>&nbsp;&nbsp;Số TK: 1234 5678 91011
                                                <br>&nbsp;&nbsp;Tên chủ TK: Công ty TNHH Vận tải Hảo Nguyễn
                                            </p>
                                            <p>
                                                LƯU Ý QUAN TRỌNG: Trước 24h xe chạy đối với ngày bình thường và ngay sau khi đặt vé đối với những ngày LỄ, bạn phải mang theo MÃ ĐẶT VÉ tới văn phòng đại diện bất kỳ của chúng tôi để thanh toán và nhận vé chính thức. Nếu không, vé đặt này sẽ tự động bị hủy bởi hệ thống và không có giá trị sử dụng. Sau khi thanh toán, bạn vẫn có thể Hủy vé/thay đổi thông tin chuyến dựa vào THỜI gian DỰ KIẾN XUẤT BẾN : trước 12 tiếng được hủy/đổi miễn phí, từ 03 đến 12 tiếng được hủy/đổi và mất phí dịch vụ 10%, trong vòng 03 tiếng được hủy/đổi và mất phí dịch vụ 30%. Giá trị Vé sau khi trừ phí sẽ được hoàn lại trong vòng 03 ngày kể từ khi hủy vé. Ngày Lễ - Tết có Quy định riêng. Các thông tin khác được ghi rõ trên vé, chúng tôi khuyên bạn nên đọc kỹ trước khi sử dụng dịch vụ của chúng tôi.<br>
                                                <br>
                                                ĐỊA CHỈ CÁC VĂN PHÒNG CỦA Hảo Nguyễn TRÊN TOÀN QUỐC:<br>
                                                <br>
                                                <a target="_blank" href="/van-phong-dai-ly">Hệ thống Văn phòng, Đại lý trên toàn quốc của Hảo Nguyễn.</a>
                                            </p>
                                            <span style="font-style:italic">
                                                Chúng tôi đã gửi cho bạn một email vào địa chỉ {{$detail['email']}}<br>
                                                Xin vui lòng kiểm tra email để được mã code vé, hướng dẫn thủ tục thanh toán và lấy vé.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <!--end step4-->
                            <hr />

                        </div>
                        <div role="tabpanel" class="tab-pane" id="roundtrip"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- booking --}}

        <div class="whiteSection">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="sectionTitle">
                        <h2><span>H&#236;nh ảnh giường nằm</span></h2>
                    </div>
                    <img style="width: 90%;" src="public/source/Images/hoanglonggiuong.jpg" title="Hinh anh xe Hoang Long" alt="Hinh anh xe Hoang Long" />
                </div>
            </div>
        </div>
    </div><!--end div container-->

</section>
@endsection
@section('js-lightHeader')
{{-- <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/vendor/jquery/jquery.js')}}"></script> --}}
<script>
    var bill, user_info, code, data_email;
    $(".btnConfirmTicket").unbind('click');
    $(".btnConfirmTicket").click(function () {
        var confirmCodeText = document.getElementById('CaptchaCodeText').value;
        if(confirmCodeText === code){
            document.forms['form_step3'].submit();
        }
        else{
            document.getElementById('notecaptcha').style.display = 'block';
        }

         });
    function checkConfirmCode(data) {
      $.ajax({
        type:'POST',
        url: 'checkConfirmCode',
        dataType: "json",
        data: {customername: data.customername, phone: data.phone, email: data.email,
          address: data.address, quantity:data.quantity, price:data.price, departure:data.departure, destination: data.destination},
          success:function(data){

            if(data.success === true){
                gotostep(3);
          }else{
          }
      },
      error: function (data, textStatus, errorThrown) {
          var response = JSON.parse(data.responseText);
          console.log(data);
          // displayError(response.errors);
      },
  });
  }
    $(".btnGoToStep").unbind('click');
    $(".btnGoToStep").click(function (e) {
        e.preventDefault();
        var step = $(this).attr('data-step');
        gotostep(step);
    });

    $(".btnSetVehicleId").unbind('click');
    $(".btnSetVehicleId").click(function () {
        var id = $(this).attr('data-id');
        var dep = $(this).attr('data-dep');
        var des = $(this).attr('data-des');
        var starttime = $(this).attr('data-starttime');
        var date = $(this).attr('data-date');
        var price = $(this).attr('data-price');
        var datecheck = $(this).attr('data-datecheck');
        // var eat = $(this).attr('data-eat');

        var quantity = $(this).attr('data-quantity');
        var dep_name = $(this).attr('data-dep-name');
        var des_name = $(this).attr('data-des-name');
        var des_time = $(this).attr('data-des-time');
        var data_chuyen = $(this).attr('data-chuyen');
        bill = {id: id, dep: dep, des: des, starttime: starttime, date: date, price: price, datecheck: date, quantity:quantity,
            dep_name: dep_name, des_name: des_name, data_chuyen: data_chuyen};
            gotostep(2);
        });

    var gotostep = function (step) {
        jQuery('html,body').animate({
            scrollTop: $(".positiontop").offset().top - $('.lightHeader').height()
        }, 'slow');
        if (step == 1) {
            $(".progress-wizard-step").removeClass("complete");
            $(".progress-wizard-step").removeClass("active");
            $(".progress-wizard-step").removeClass("disabled");
            $(".progress-step-1").addClass("active");
            $(".progress-step-2").addClass("disabled");
            $(".progress-step-3").addClass("disabled");
            $(".progress-step-4").addClass("disabled");
            $(".step1").slideDown();
            $(".step2").slideUp();
            $(".step3").slideUp();
            $(".step4").slideUp();
        } else if (step == 2) {
            $(".progress-wizard-step").removeClass("complete");
            $(".progress-wizard-step").removeClass("active");
            $(".progress-wizard-step").removeClass("disabled");
            $(".progress-step-1").addClass("complete");
            $(".progress-step-2").addClass("active");
            $(".progress-step-3").addClass("disabled");
            $(".progress-step-4").addClass("disabled");
            $(".step1").slideUp();
            $(".step2").slideDown();
            $(".step3").slideUp();
            $(".step4").slideUp();
        } else if (step == 3) {
            $(".progress-wizard-step").removeClass("complete");
            $(".progress-wizard-step").removeClass("active");
            $(".progress-wizard-step").removeClass("disabled");
            $(".progress-step-1").addClass("complete");
            $(".progress-step-2").addClass("complete");
            $(".progress-step-3").addClass("active");
            $(".progress-step-4").addClass("disabled");
            $(".step1").slideUp();
            $(".step2").slideUp();
            $(".step3").slideDown();
            $(".step4").slideUp();
        } else if (step == 4) {
            $(".progress-wizard-step").removeClass("complete");
            $(".progress-wizard-step").removeClass("active");
            $(".progress-wizard-step").removeClass("disabled");
            $(".progress-step-1").addClass("complete");
            $(".progress-step-2").addClass("complete");
            $(".progress-step-3").addClass("complete");
            $(".progress-step-4").addClass("active");
            $(".step1").slideUp();
            $(".step2").slideUp();
            $(".step3").slideUp();
            $(".step4").slideDown();
        } else if (step == 5) {
            $(".progress-wizard-step").removeClass("complete");
            $(".progress-wizard-step").removeClass("active");
            $(".progress-wizard-step").removeClass("disabled");
            $(".progress-step-1").addClass("complete");
            $(".progress-step-2").addClass("complete");
            $(".progress-step-3").addClass("complete");
            $(".progress-step-4").addClass("complete");
            $(".step1").slideUp();
            $(".step2").slideUp();
            $(".step3").slideUp();
            $(".step4").slideDown();
        }
    };

    $('.transaction input[type="radio"]').each(function () {
        $(this).unbind('click');
        $(this).click(function () {
            var type = $(this).val();
            checkTransaction(type);
        });
    });

    var checkTransaction = function (type) {
        var show = false;
        $('.transaction input[type="radio"]').each(function () {
            if ($(this).is(":checked")) {
                show = true;
            }
        });
        if (show) {
            $("#privacy").removeAttr('disabled');
        } else {
            $("#privacy").attr('disabled', 'disabled');
        }
    };

    $("#privacy").unbind('click');
    $("#privacy").click(function () {
        checkPrivacy();
    });

    var checkPrivacy = function () {
        if ($("#privacy").is(":checked")) {
            $("#confirm-button").removeAttr('disabled');
        } else {
            $("#confirm-button").attr('disabled', 'disabled');
        }
    };
    $("#confirm-button").unbind('click');
    $("#confirm-button").click(function (e) {
        e.preventDefault();
        var culture = $(this).attr('data-culture');
        var checkFullname = $("#customername").val().trim();
        var checkPhone = $("#phone").val().trim();
        var checkEmail = $("#email").val().trim();
        if (checkFullname == '') {
            $("#customername").focus();
            if (culture == "vi") {
                Alert.Warning("Xin vui lòng điền tên của bạn.");
            } else {
                Alert.Warning("Please fill your name.");
            }
            return false;
        }
        if (checkPhone == '') {
            $("#phone").focus();
            if (culture == "vi") {
                Alert.Warning("Xin vui lòng điền số điện thoại của bạn.");
            } else {
                Alert.Warning("Please fill your phone.");
            }
            return false;
        }
        if (checkEmail == '') {
            $("#email").focus();
            if (culture == "vi") {
                Alert.Warning("Xin vui lòng điền email của bạn.");
            } else {
                Alert.Warning("please fill your email");
            }
            return false;
        }
        var customername = $("#customername").val().trim();
        var phone = $("#phone").val().trim();
        var email = $("#email").val().trim();
        var address = $("#address").val().trim();
        var paymenttype = $("input[type='radio'][name='paymenttype']:checked").val();

        document.getElementById("customername_hd").value = customername;
        document.getElementById("phone_hd").value = phone;
        document.getElementById("email_hd").value = email;
        document.getElementById("address_hd").value = address;
        document.getElementById("price_hd").value = bill['price'];
        document.getElementById("quantity_hd").value = bill['quantity'];
        document.getElementById("date_hd").value = bill['date'];
        document.getElementById("paymenttype_hd").value = paymenttype;
        document.getElementById("address_hd").value = address;
        document.getElementById("shift_hd").value = bill['data_chuyen'];
        document.getElementById("shift_id_hd").value = bill['id'];
        document.getElementById("starttime_hd").value = bill['starttime'];
        document.getElementById("destination_hd").value = bill['des_name'];
        document.getElementById("departure_hd").value = bill['dep_name'];
        
        document.getElementById("customername_tb").innerHTML = customername;
        document.getElementById("phone_tb").innerHTML = phone;
        document.getElementById("email_tb").innerHTML = email;
        document.getElementById("address_tb").innerHTML = address;
        document.getElementById("de_des").innerHTML = bill['dep_name'] + "-" + bill['des_name'];
        document.getElementById("price_tb").innerHTML = bill['price'];
        document.getElementById("quantity_tb").innerHTML = bill['quantity'];
        document.getElementById("total_tb").innerHTML = bill['price']*bill['quantity'];
        document.getElementById("chuyen_tb").innerHTML = bill['data_chuyen'];
        document.getElementById("date_tb").innerHTML = bill['starttime'] + ' ' + bill['date'];
        if(paymenttype == 1){
            document.getElementById("paymenttype_tb").innerHTML = "giao dịch trực tiếp";
        }
        data_email = {customername: customername, phone: phone, email:email, address:address};
        sendConfirmCodeText(data_email);
        // gotostep(3);
        return false;
    });
    $("#btnSendCodeAgain").unbind('click');
    $("#btnSendCodeAgain").click(function(e){
        e.preventDefault();
        sendConfirmCodeText(data_email);
    });
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    function sendConfirmCodeText(data) {
        document.getElementById('pageLoading').classList.toggle("show");
      $.ajax({
        type:'POST',
        url: 'sendConfirmCodeText',
        dataType: "json",
        data: {customername: data.customername, phone: data.phone, email: data.email,
          address: data.address, send_again: data.send_again},
          success:function(data){
            if(data.success === true){
                document.getElementById('pageLoading').classList.toggle("show");
                code = data.confirm_code_text;
                gotostep(3);
          }
      },
      error: function (data, textStatus, errorThrown) {
        document.getElementById('pageLoading').classList.toggle("show");
        var response = JSON.parse(data.responseText);
        console.log(data);
        displayError(response.errors);
      },
  });
  }
  function displayError(errors) {
  // var errors = data.responseJSON.errors;
  var firstItem = Object.keys(errors)[0];
  var firstItemDOM = document.getElementById(firstItem);
  var firstErrorMessage = errors[firstItem][0];

          // scroll to te error message
          firstItemDOM.scrollIntoView({behavior: "smooth", inline: "nearest"});
          
          // remove all error messages
          clearErrorText();
          // // show error message
          firstItemDOM.insertAdjacentHTML('afterend', `<p class="text-danger" style="font-size: 13px; margin:0;">* ${firstErrorMessage}</div>`)

          // remove all form controls with highlighted error text box
          clearBorderError();
          // highlight the form control with the error 
          firstItemDOM.classList.add('border', 'border-danger');
        }

        function clearErrorText(){
          var errorMessages = document.querySelectorAll('.text-danger');
          errorMessages.forEach((element)=>element.textContent = '');
        }
        function clearBorderError() {
          var formControls = document.querySelectorAll('.form-control')
          formControls.forEach((element)=> element.classList.remove('border', 'border-danger'));
        }
</script>
@endsection