@extends('layout.master')
@section('title')
    Edit Employee
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-3 col-lg-6 offset-lg-3 col-xl-10 offset-xl-1">
            <a href="/employee" class="btn btn-danger mb-5 pl-4 pr-4">Back</a>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Edit Employee</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate="">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nik">NIK Karyawan</label>
                                <input type="number" class="form-control" id="inputEmail" placeholder="Input NIK" name="nik" value="{{ $employee->nik }}">
                                @error('nik')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="full_name">Name</label>
                                <input type="text" class="form-control" id="-" placeholder="Input Name" name="full_name" value="{{ $employee->full_name }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Department</label>
                                <select name="department_id" class="form-control select1">
                                    <option selected>Select Department</option>
                                    @foreach ($departments as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $employee->department_id ? 'selected' : '' }}>
                                            {{ $item->dept_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Title</label>
                                <select name="title_id" class="form-control select1">
                                    <option selected>Select Title</option>
                                    @foreach ($titles as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $employee->title_id ? 'selected' : '' }}>
                                            {{ $item->title_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">Join Date:</label>
                                <input type="date" class="form-control" id="join_date" name="join_date" value="{{ $employee->join_date }}">
                            </div>
                        </div>

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
