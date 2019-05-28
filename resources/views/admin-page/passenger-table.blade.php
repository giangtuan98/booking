@extends('admin-page.admin-sb')
@section('tittle')
Admin-Hành khách
@endsection
@section('link')
Hành khách
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
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Số điện thoại</th>                
                {{-- <th>Thời gian</th> --}}
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Số điện thoại</th>  
                {{-- <th>Thời gian</th> --}}
              </tr>
            </tfoot>
            <tbody>
              @foreach($tbl_passenger as $passenger)
              <tr>
                <td>{{$passenger->passenger_id}}</td>
                <td>{{$passenger->name}}</td>
                <td>{{$passenger->address}}</td>
                <td>{{$passenger->email}}</td>
                <td>{{$passenger->phone}}</td>
                
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection