@extends('layout.master')
@section('title')
    Holiday Dates
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Exclude Holiday Dates that not Count as Leave</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <a href="/leave-type/create" class="btn btn-primary btn-lg mb-3" tabindex="4">
              Add Holiday Dates
            </a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>                                 
                <tr>
                  <th class="text-center">
                    ID
                  </th>
                  <th>Holidaay Name</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody> 
                {{-- @forelse ($leaveType as $key=>$value) --}}
                    <tr>
                        <td class="text-center">1</td>
                        <td>Independence Day Holiday</td>
                        <td>2023-08-17</td>
                        <td>
                          {{-- <form action="/leave-type/{{$value->id}}" method="post">
                            @csrf
                            @method('delete') --}}
                            <input type="submit" value="Delete" class="btn btn-danger">
                          {{-- </form> --}}
                          {{-- @endif --}}
                          
                        </td>
                        
                    </tr>
                {{-- @empty --}}
                    <tr colspan="3">
                        <td>No data</td>
                    </tr>  
                {{-- @endforelse --}}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection