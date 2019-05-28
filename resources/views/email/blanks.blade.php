<p>Đây là thông tin đặt vé trước của bạn:</p>
<p>Họ và tên khách hàng: {{$data['customername']}}</p>
<p>Điện thoại: {{$data['phone']}}</p>
<p>Email: {{$data['email']}}</p>
<p>Địa chỉ: {{$data['address']}}</p>
<p>Mã số đặt vé: {{$data['ticket_id']}}</p>
<p>Dự kiến khách hàng sẽ lên xe tại {{$data['departure']}} lúc: {{$data['starttime'] . ' Ngày ' . $data['date']}} </p>
<p>Điểm đi: {{$data['departure']}}</p>
<p>Điểm đến: {{$data['destination']}}</p>
<p>Chuyến: {{$data['shift']}}
</p>
<p>Số lượng người đi : {{$data['quantity']}}</p>
<p>Giá vé: {{$data['price']}} VND</p>
<p>Tổng tiền : {{$data['price']*$data['quantity']}} VND</p>

<p>Giá vé có thể thay đổi theo thời điểm nếu quý khách không thanh toán ngay sau khi đặt vé thành công.</p> 