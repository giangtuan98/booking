@extends('admin-page.admin-sb')
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
                <th>Mã Vé</th>
                <th>Mã khách hàng</th>
                <th>Mã chuyến xe</th>
                <th>Ngày lên xe</th>
                <th>Số lượng</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Mã Vé</th>
                <th>Mã khách hàng</th>
                <th>Mã chuyến xe</th>
                <th>Ngày lên xe</th>
                <th>Số lượng</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach($tbl_ticket as $ticket)
              <tr>
                <td>{{$ticket->ticket_id}}</td>
                <td>{{$ticket->passenger_id}}</td>
                <td>{{$ticket->buses_id}}</td>
                <td>{{$ticket->buses_departure_date}}</td>
                <td>{{$ticket->quantity}}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection