<form action="{{ route('leave-request.store') }}" method="POST">
    @csrf
    <div>
        <label for="nik">NIK:</label>
        <select name="nik" id="nik">
            @foreach ($employees as $employee)
                <option value="{{ $employee->nik }}">{{ $employee->nik }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="leave_id">Leave Type:</label>
        <select name="leave_id" id="leave_id">
            <option value="1">Annual Leave</option>
            <option value="2">Long Leave</option>
            <option value="3">Carry Over Leave</option>
            <option value="4">Custom Leave</option>
        </select>
    </div>
    <div>
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date">
    </div>
    <div>
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date">
    </div>
    <div>
        <label for="reason">Reason:</label>
        <textarea name="reason" id="reason"></textarea>
    </div>
    <div>
        <label for="document">Document:</label>
        <input type="file" name="document" id="document">
    </div>
    <button type="submit">Submit</button>
</form>