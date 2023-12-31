@extends('layout.master')
@section('title')
    Leave Type
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Leave Type</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <a href="/leave-type/create" class="btn btn-primary btn-lg mb-3" tabindex="4">
              Add Leave Type
            </a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>                                 
                <tr>
                  <th class="text-center">
                    ID
                  </th>
                  <th>Leave Name</th>
                  <th>Document?</th>
                  <th>Deduct Leave?</th>
                  <th>Deduct Long Leave?</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody> 
                @forelse ($leaveType as $key=>$value)
                    <tr>
                        <td class="text-center">{{$value->id}}</td>
                        <td>{{$value->leave_name}}</td>
                        <td>{{$value->document ? 'YES' : 'NO'}}</td>
                        <td>{{$value->deduct_leave ? 'YES' : 'NO'}}</td>
                        <td>{{$value->deduct_long_leave ? 'YES' : 'NO'}}</td>
                        <td>
                          <form action="/leave-type/{{$value->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                          </form>
                          {{-- @endif --}}
                          
                        </td>
                        
                    </tr>
                @empty
                    <tr colspan="3">
                        <td>No data</td>
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