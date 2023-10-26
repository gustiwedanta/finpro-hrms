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
                @forelse ($title as $key=>$value)
                    <tr>
                        <td class="text-center">{{$value->id}}</td>
                        <td>{{$value->title_name}}</td> 
                        <td>
                          <a href="/title/{{$value->id}}/edit" class="btn btn-warning m-2">Edit</a>
                          <form action="/title/{{$value->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger">
                          </form>
                          
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