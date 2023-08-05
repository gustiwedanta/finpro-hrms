@extends('layout.master')
@section('title')
  Title
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <a href="/title" class="btn btn-danger mb-5 pl-4 pr-4">Back</a>
        <div class="card card-primary">
          <div class="card-header">
            <h4>Edit Title</h4></div>

          <div class="card-body">
            <form method="POST" action="/department/{{$title->id}}" class="needs-validation" novalidate="">
              @csrf
              @method('put')    
              <div class="form-group">
                <label for="title_name">Title Name</label>
                <input id="title_name" type="text" class="form-control" name="title_name" tabindex="1" value="{{$title->title_name}}" required autofocus>
                <div class="invalid-feedback">
                  Please fill the Title name
                </div>
              </div>
              @error('title_name')
                      <div class="alert alert-danger">
                       {{ $message }}
                      </div>
                  @enderror
              {{-- <div class="form-group">
                <label for="value">Position Value</label>
                <input id="value" type="number" class="form-control" name="value" tabindex="1" value="{{($position->value) - 4400000}}" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your position value
                </div>
              </div> --}}

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block " tabindex="4">
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection