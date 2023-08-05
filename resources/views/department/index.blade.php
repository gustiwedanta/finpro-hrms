@extends('layout.master')
@section('title')
  Department
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Department Table</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <a href="/department/create" class="btn btn-primary btn-lg mb-3" tabindex="4">
              Add Department
            </a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>                                 
                <tr>
                  <th class="text-center">
                    ID
                  </th>
                  <th>Department Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody> 
                <!-- yg ini gw hapus yaaa.. biar rapii diliatnya                            -->
                <!-- <tr>
                  <td class="text-center">
                    1
                  </td>
                  <td>Create a mobile app</td>
                  <td>
                    Rp. 500.000
                  </td>
                  <td>
                    Mamang Kesbor, KimKim, Putra
                  </td>
                  <td>
                    <a href="#" class="btn btn-primary">Edit</a>
                  </td>
                </tr> -->
                @forelse ($department as $key=>$value)
                    <tr>
                        <td class="text-center">{{$value->id}}</td>
                        <td>{{$value->dept_name}}</td> 
                        <td>
                          <a href="/department/{{$value->id}}/edit" class="btn btn-warning m-2">Edit</a>
                          @if (count($employee->where('dept_id', $value->id)) > 0)
                              
                              <input value="Position Taken" disabled class="btn btn-danger">
                          @else
                          <form action="/department/{{$value->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                          </form>
                          @endif
                          
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