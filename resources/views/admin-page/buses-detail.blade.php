@extends('admin-page.admin-sb')
@section('tittle')
Admin-Chi tiết chuyến xe
@endsection
@section('link')
Chi tiết chuyến xe
@endsection
@section('table')
<div class="card mb-3">
  @if (session('success_message'))
<div class="alert alert-success flash-alert">
  {{ session('success_message') }}
</div>
@endif
      <div class="card-header d-flex align-items-baseline">
        <span><i class="fas fa-table"></i>Chi tiết chuyến xe</span>
      
        <a href="{{route('create_data_next')}}" class="btn btn-dark ml-auto">Tạo dữ liệu tháng sau</a>
        <a href="{{route('create_data_this')}}" class="btn btn-dark ml-auto">Tạo dữ liệu tháng này</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Ngày</th>
                <th>Mã Chuyến</th>
                <th>Ghế trống</th>
                {{-- <th>Thời gian</th> --}}
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Ngày</th>
                <th>Mã Chuyến</th>
                <th>Ghế trống</th>
                {{-- <th>Thời gian</th> --}}
              </tr>
            </tfoot>
            <tbody>
              @foreach($tbl_buses_detail as $buses)
              <tr>
                <td>{{$buses->buses_departure_date}}</td>
                <td>{{$buses->buses_id}}</td>
                <td>{{$buses->available_seats}}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection