@extends('layout.master')
@section('title')
  Title
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Title Table</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <a href="/title/create" class="btn btn-primary btn-lg mb-3" tabindex="4">
              Add Title
            </a>
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>                                 
                <tr>
                  <th class="text-center">
                    ID
                  </th>
                  <th>Title Name</th>
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
                @forelse ($title as $key=>$value)
                    <tr>
                        <td class="text-center">{{$value->id}}</td>
                        <td>{{$value->title_name}}</td> 
                        <td>
                          <a href="/title/{{$value->id}}/edit" class="btn btn-warning m-2">Edit</a>
                          @if (count($employee->where('title_id', $value->id)) > 0)
                              
                              <input value="Title Taken" disabled class="btn btn-danger">
                          @else
                          <form action="/title/{{$value->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                          </form>
                          @endif
                          
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>No data</td>
                        <td>No data</td>
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