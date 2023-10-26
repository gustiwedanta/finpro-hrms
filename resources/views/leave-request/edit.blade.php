@extends('layout.master')
@section('title', 'Edit Leave Request')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-3 col-lg-6 offset-lg-3 col-xl-10 offset-xl-1">
            <a href="{{ route('leave-request.index') }}" class="btn btn-danger mb-5 pl-4 pr-4">Back</a>
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Edit Leave Request</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('leave-request.update', $leaveRequest->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Select leave type -->
                        <div class="form-group">
                            <label for="leave_id">Leave Type:</label>
                            <select name="leave_id" id="leave_id" class="form-control">
                                <!-- Populate leave types options from the database -->
                                @foreach($leaveTypes as $leaveType)
                                    <option value="{{ $leaveType->id }}" {{ $leaveRequest->leave_id == $leaveType->id ? 'selected' : '' }}>
                                        {{ $leaveType->leave_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date inputs for start and end dates -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Start Date:</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $leaveRequest->start_date }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">End Date:</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $leaveRequest->end_date }}">
                            </div>
                        </div>

                        <!-- Display calculated many_days here using JavaScript -->
                        <div class="form-group">
                            <label>Number of Days:</label>
                            <span id="many_days" class="form-control-static">{{ $leaveRequest->many_days }}</span>
                        </div>

                        {{-- for inputting text --}}
                        <div class="form-group">
                            <label for="reason">Reason:</label>
                            <input type="text" name="reason" id="reason" value="{{ $leaveRequest->reason }}" class="form-control">
                        </div>

                        <!-- Allow document upload based on leave type -->
                        <div class="form-group">
                            <label for="document">Document (if required):</label>
                            <input type="file" name="document" id="document" class="form-control-file">
                        </div>

                        <!-- Display remaining leave days -->
                        <div class="form-group">
                            <label>Remaining Leave Days:</label>
                            {{ Auth::user()->employee->remaining_leave_days }}
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                    </form>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const start_date = document.getElementById("start_date");
        const end_date = document.getElementById("end_date");
        const many_days = document.getElementById("many_days");

        start_date.addEventListener("change", updateDays);
        end_date.addEventListener("change", updateDays);

        function updateDays() {
            if (start_date.value && end_date.value) {
                const startDate = new Date(start_date.value);
                const endDate = new Date(end_date.value);
                let days = 0;

                while (startDate <= endDate) {
                    if (startDate.getDay() !== 0 && startDate.getDay() !== 6) {
                        days++;
                    }
                    startDate.setDate(startDate.getDate() + 1);
                }

                many_days.textContent = days;
            }
        }
    });
</script>
@endsection
