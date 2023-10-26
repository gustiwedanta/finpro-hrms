@extends('layout.master')
@section('title', 'Leave Requests')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Leave Requests</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->level !== 'admin')
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Leave Balances</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p>
                                    Remaining Leave: {{ $user->employee->annual_leave - $usedLeave }} days
                                    ({{ $user->employee->annual_leave }} days - {{ $usedLeave }} days used)
                                </p>
                            </div>
                            <div class="col-12">
                                <p>
                                    Remaining Long Leave: {{ $user->employee->long_leave - $usedLongLeave }} days
                                    ({{ $user->employee->long_leave }} days - {{ $usedLongLeave }} days used)
                                </p>
                            </div>
                        </div>
                        <hr>
                        <p class="text-muted">
                            These balances are based on approved leave requests.
                        </p>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('leave-request.update', 'submit') }}">
                    @csrf
                    @method('PUT')
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee</th>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Many Days</th>
                                    <th>Reason</th>
                                    <th>Document</th>
                                    <th>Approved by Supervisor</th>
                                    <th>Approved by HR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveRequests as $leaveRequest)
                                <tr>
                                    <td>{{ $leaveRequest->id }}</td>
                                    <td>{{ $leaveRequest->employee->full_name }}</td>
                                    <td>{{ $leaveRequest->leaveType->leave_name }}</td>
                                    <td>{{ $leaveRequest->start_date }}</td>
                                    <td>{{ $leaveRequest->end_date }}</td>
                                    <td>{{ $leaveRequest->many_days }}</td>
                                    <td>{{ $leaveRequest->reason }}</td>
                                            <td>
                                                @if ($leaveRequest->document)
                                                <a href="{{ Storage::url($leaveRequest->document) }}" class="btn btn-success btn-sm" target="_blank">Download</a>
                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->level === 'supervisor')
                                                <input type="checkbox" name="approved_by_supervisor[]" value="{{ $leaveRequest->id }}" id="leaveRequest{{ $leaveRequest->id }}Supervisor" {{ $leaveRequest->approved_by_supervisor ? 'checked' : '' }}>
                                                @elseif (Auth::user()->level === 'admin')
                                                <input type="checkbox" name="approved_by_supervisor[]" value="{{ $leaveRequest->id }}" id="leaveRequest{{ $leaveRequest->id }}Supervisor" {{ $leaveRequest->approved_by_supervisor ? 'checked' : 'disabled' }}>
                                                @endif
                                                <input type="hidden" name="approved_by_supervisor[]" value="0">
                                            </td>
                                            <td>
                                                @if (Auth::user()->level === 'admin')
                                                <input type="checkbox" name="approved_by_hr[]" value="{{ $leaveRequest->id }}" id="leaveRequest{{ $leaveRequest->id }}HR" {{ $leaveRequest->approved_by_hr ? 'checked' : '' }}>
                                                @elseif (Auth::user()->level === 'supervisor')
                                                <input type="checkbox" name="approved_by_hr[]" value="{{ $leaveRequest->id }}" id="leaveRequest{{ $leaveRequest->id }}HR" {{ $leaveRequest->approved_by_hr ? 'checked' : 'disabled' }}>
                                                @endif
                                                <input type="hidden" name="approved_by_hr[]" value="0">
                                            </td>
                                            
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
