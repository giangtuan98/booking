@extends('admin-page.admin-sb')
@section('tittle')
Admin-Dashboard
@endsection
@section('table')
<div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
      Data Table Example</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
               <th>Mã vé</th>
                <th>Chuyến</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Điểm đi</th>
                <th>Giờ đi</th>
                <th>Điểm đến</th>
                <th>Giờ đến</th>
                {{-- <th>Thời gian</th> --}}
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Email</th>
                <th>Địa chỉ</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Mã vé</th>
                <th>Chuyến</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Điểm đi</th>
                <th>Giờ đi</th>
                <th>Điểm đến</th>
                <th>Giờ đến</th>
                {{-- <th>Thời gian</th> --}}
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                {{-- <th>Thời gian</th> --}}
              </tr>
            </tfoot>
            <tbody>
              @foreach($tbl_ticket_detail as $ticket_detail)
              <tr>
                <td>{{$ticket_detail->ticket_id}}</td>
                <td>{{$ticket_detail->buses_name}}</td>
                <td>{{$ticket_detail->name}}</td>
                <td>{{$ticket_detail->phone}}</td>
                <td>{{$ticket_detail->departure_name}}</td>
                <td>{{$ticket_detail->depart_time}}</td>
                <td>{{$ticket_detail->destination_name}}</td>
                <td>{{$ticket_detail->arrive_time}}</td>
                {{-- <td>{{$ticket_detail->duration}}</td> --}}
                <td>{{$ticket_detail->quantity}}</td>
                <td>{{number_format($ticket_detail->price)}}</td>
                <td>{{number_format($ticket_detail->price * $ticket_detail->quantity)}}</td>
                <td>{{$ticket_detail->email}}</td>
                <td>{{$ticket_detail->address}}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection