@extends('layout.master')
@section('title')
  Add Leave Type
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-10 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
        <a href="/leave-type" class="btn btn-danger mb-5 pl-4 pr-4">Back</a>
        <div class="card card-primary">
          <div class="card-header">
            <h4>Add Leave Type</h4></div>

          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="/leave-type" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="leave_name">Leave Type Name</label>
                <input id="leave_name" type="text" class="form-control" name="leave_name" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Please fill the Leave Type Name
                </div>
              </div>
              @error('leave_name')
                      <div class="alert alert-danger">
                       {{ $message }}
                      </div>
                  @enderror
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="documentSwitch" name="document">
                    <label class="form-check-label" for="document">Document?</label>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="leaveDeductSwitch" name="deduct_leave">
                    <label class="form-check-label" for="deduct_leave">Deduct Leave?</label>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="longleaveDeductSwitch" name="deduct_long_leave">
                    <label class="form-check-label" for="deduct_leave">Deduct Long Leave?</label>
                  </div>
                  
                  <script>
                    const documentToggle = document.getElementById("documentSwitch");
                    const leaveDeductToggle = document.getElementById("leaveDeductSwitch");
                    const longleaveDeductToggle = document.getElementById("longleaveDeductSwitch");
                    const documentHiddenInput = document.querySelector('input[name="document"]');
                    const deductLeaveHiddenInput = document.querySelector('input[name="deduct_leave"]');
                    const deductLongLeaveHiddenInput = document.querySelector('input[name="deduct_long_leave"]');

                    // Set nilai default ke '0' untuk input tersembunyi
                    documentHiddenInput.value = '0';
                    deductLeaveHiddenInput.value = '0';
                    deductLongLeaveHiddenInput.value = '0';

                    // Listener untuk checkbox "Document"
                    documentToggle.addEventListener("change", function() {
                        documentHiddenInput.value = this.checked ? '1' : '0';
                    });
                
                    // Listener untuk checkbox "Deduct Leave"
                    leaveDeductToggle.addEventListener("change", function() {
                        deductLeaveHiddenInput.value = this.checked ? '1' : '0';
                    });

                    // Listener untuk checkbox "Deduct Long Leave"
                    longleaveDeductToggle.addEventListener("change", function() {
                        deductLongLeaveHiddenInput.value = this.checked ? '1' : '0';
                    });
                </script>
                  
              <div class="form-group mt-3">
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