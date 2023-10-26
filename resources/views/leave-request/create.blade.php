    @extends('layout.master')
    @section('title')
        Leave Request
    @endsection
    @section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-3 col-lg-6 offset-lg-3 col-xl-10 offset-xl-1">
                <a href="/employee" class="btn btn-danger mb-5 pl-4 pr-4">Back</a>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Propose Leave</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('leave-request.store') }}" enctype="multipart/form-data">
                            @csrf
                            <!-- employee_id will be taken from authenticated user -->
                            <input type="hidden" name="employee_id" value="{{ Auth::user()->employee->id }}">

                            <!-- Select leave type -->
                            <div class="form-group">
                                <label for="leave_id">Leave Type:</label>
                                <select name="leave_id" id="leave_id" class="form-control">
                                    <!-- Populate leave types options from the database -->
                                    @foreach($leaveTypes as $leaveType)
                                        <option value="{{ $leaveType->id }}">{{ $leaveType->leave_name  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date inputs for start and end dates -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                            </div>

                            <!-- Display calculated many_days here using JavaScript -->
                            <div class="form-group">
                                <label>Number of Days:</label>
                                <span id="many_days" class="form-control-static"></span>
                            </div>

                            {{-- for inputting text --}}
                            <div class="form-group">
                                <label for="reason">Reason:</label>
                                <input type="text" name="reason" id="reason" value="{{ old('reason') }}" class="form-control">
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

                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </form>
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

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
