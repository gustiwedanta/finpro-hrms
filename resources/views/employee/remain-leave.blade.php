@extends('layout.master')
@section('title')
    Remain Leave
@endsection
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Remain Leave Data</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>                                 
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Full Name</th>
                <th class="text-center">Department</th>
                <th class="text-center">Join Date</th>
                <th class="text-center">Annual Leave</th>
                <th class="text-center">Long Leave</th>
                <th class="text-center">Carry Over</th>
              </tr>
            </thead>
            <tbody>  
              @forelse ($employees as $key=>$value)
                  <tr>
                    <td class="text-center">
                      {{$value->id}}
                    </td>
                    <td class="text-center">{{$value->nik}}</td>
                    <td>{{$value->full_name}}</td>
                    <td class="text-center">{{$value->Department->dept_name}}</td>
                    <td class="text-center">{{$value->join_date }}</td>
                    <td class="text-center">{{$value->annual_leave}}</td>
                    <td class="text-center">{{$value->long_leave}}</td>
                    <td class="text-center">{{$value->carry_over}}</td>
                  </tr>
              @empty
                  <tr>
                    <td colspan="7" class="text-center">No data</td>
                  </tr>  
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
