@extends('layout.master')
@section('title')
  Add Position
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <a href="/department" class="btn btn-danger mb-5 pl-4 pr-4">Back</a>
        <div class="card card-primary">
          <div class="card-header">
            <h4>Add Department</h4></div>

          <div class="card-body">
            <form method="POST" action="/department" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="dept_name">Department Name</label>
                <input id="dept_name" type="text" class="form-control" name="dept_name" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill the Department Name
                </div>
              </div>
              @error('dept_name')
                      <div class="alert alert-danger">
                       {{ $message }}
                      </div>
                  @enderror
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block " tabindex="4">
                  Add
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection