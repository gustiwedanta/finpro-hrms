@extends('layout.master')
@section('title', 'Dashboard')

@section('content')
<div class="row">
    @if (Auth::user()->level === 'admin')
    <!-- Admin Dashboard -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>On Leave Employee</h4>
                </div>
                <div class="card-body">
                    {{ $totalOnLeave }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Number of Department</h4>
                </div>
                <div class="card-body">
                    {{ $totalDepartments }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Number of Title</h4>
                </div>
                <div class="card-body">
                    {{ $totalTitles }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Leave Not Yet Approved</h4>
                </div>
                <div class="card-body">
                    {{ $leaveNotApproved }}
                </div>
            </div>
        </div>
    </div>
    @elseif (Auth::user()->level === 'supervisor')
    <!-- Supervisor Dashboard -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Leave Amount</h4>
                </div>
                <div class="card-body">
                    {{ $leaveAmount }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Used Leave</h4>
                </div>
                <div class="card-body">
                    {{ $usedLeave + $usedLongLeave }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Remaining Leave</h4>
                </div>
                <div class="card-body">
                    {{ $remainingLeave }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Need Approve Leave</h4>
                </div>
                <div class="card-body">
                    {{ $leaveRequests }}
                </div>
            </div>
        </div>
    </div>
    @elseif (Auth::user()->level === 'employee')
    <!-- Employee Dashboard -->
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Leave Amount</h4>
                </div>
                <div class="card-body">
                    {{ $employeeLeaveAmount }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Used Leave</h4>
                </div>
                <div class="card-body">
                    {{ $usedLeaveAmount + $usedLongLeaveAmount }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Remaining Leave</h4>
                </div>
                <div class="card-body">
                    {{ $remainingLeaveAmount }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card card-statistic-1">
            <div class="card-icon">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Leave Not Yet Approved</h4>
                </div>
                <div class="card-body">
                    {{ $employeeLeaveRequestsNotApproved }}
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Card-statistic-1 terakhir -->
<div class="col-lg-12 col-md-12 col-sm-12">
  <div class="card">
      <div class="card-header">
          <h4>Leave Calendar</h4>
      </div>
      <div class="card-body">
          <div id="calendar"></div>
      </div>
  </div>
</div>

<!-- JavaScript untuk inisialisasi kalender -->


</div>
@endsection
<script type='importmap'>
  {
    "imports": {
      "@fullcalendar/core": "https://cdn.skypack.dev/@fullcalendar/core@6.1.8",
      "@fullcalendar/daygrid": "https://cdn.skypack.dev/@fullcalendar/daygrid@6.1.8"
    }
  }
</script>
<script type='module'>
  import { Calendar } from '@fullcalendar/core'
  import dayGridPlugin from '@fullcalendar/daygrid'

  document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      const calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: [
              @foreach ($approvedLeaveRequests as $leaveRequest)
                  {
                      title: '{{ $leaveRequest->employee->full_name }} - {{ $leaveRequest->leavetype->leave_name }}',
                      start: '{{ $leaveRequest->start_date }}',
                      end: '{{ $leaveRequest->end_date }}',
                      description: 'Reason: {{ $leaveRequest->reason }}',
                  },
              @endforeach
          ],
      });

      calendar.render();
  });
</script>
