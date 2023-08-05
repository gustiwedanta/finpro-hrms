<!-- resources/views/leave-request/index.blade.php -->

...

<thead>
    <tr>
        <th>ID</th>
        <th>NIK</th>
        <th>Leave ID</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Many Days</th>
        <th>Reason</th>
        <th>Document</th>
        <th>Supervisor/Manager Approval</th>
        <th>HR Approval</th>
    </tr>
</thead>
<tbody>
    @foreach ($leaveRequests as $leaveRequest)
        <tr>
            <td>{{ $leaveRequest->id }}</td>
            <td>{{ $leaveRequest->nik }}</td>
            <td>{{ $leaveRequest->leave_id }}</td>
            <td>{{ $leaveRequest->start_date }}</td>
            <td>{{ $leaveRequest->end_date }}</td>
            <td>{{ $leaveRequest->many_days }}</td>
            <td>{{ $leaveRequest->reason }}</td>
            <td>{{ $leaveRequest->document }}</td>
            <td>
                @if ($leaveRequest->approved_by_supervisor)
                    <span class="badge bg-success">Approved</span>
                @else
                    <form action="{{ route('leave-request.approve.supervisor', $leaveRequest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                @endif
            </td>
            <td>
                @if ($leaveRequest->approved_by_hr)
                    <span class="badge bg-success">Approved</span>
                @elseif ($leaveRequest->approved_by_supervisor)
                    <form action="{{ route('leave-request.approve.hr', $leaveRequest->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                @else
                    <span class="badge bg-secondary">Not Applicable</span>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>

...
