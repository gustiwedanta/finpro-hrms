@extends('layout.master')
@section('title')
    Employee Data
@endsection
@section('content')
{{-- <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Employee Data Table</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <a href="/employee/create" class="btn btn-primary btn-lg mb-3" tabindex="4">
              Add Employee
            </a>  
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>                                 
                <tr>
                  <th class="text-center">
                    ID
                  </th>
                  <th class="text-center">No.KTP</th>
                  <th>Nama</th>
                  <th class="text-center">Jabatan</th>
                  <th class="text-center">NPWP</th>
                  <th class="text-center">Family Status</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>  
                @forelse ($employee as $key=>$value)
                    <tr>
                      <td class="text-center">
                        {{$value->id}}
                      </td>
                      <td class="text-center">{{$value->no_ktp}}</td>
                      <td>{{$value->nama}}</td>
                      <td class="text-center">{{$value->position->nama}}</td>
                      <td class="text-center">{{$value->npwp}}</td>
                      <td class="text-center">{{$value->FamilyStatus->nama}}</td>
                      <td class="text-center">                    
                        <a href="/employee/{{$value->id}}/edit" class="btn btn-warning m-2">Edit</a>
                        <a href="/employee/{{$value->id}}" class="btn btn-primary m-2">Show</a>
                          <form action="/employee/{{$value->id}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-danger m-2">
                          </form>
                      </td>
                    </tr>
                @empty
                    <tr colspan="3">
                        <td class="text-center">No data</td>
                        <td class="text-center">No data</td>
                        <td class="text-center">No data</td>
                        <td class="text-center">No data</td>
                        <td class="text-center">No data</td>
                        <td class="text-center">No data</td>
                        <td>
                          <a href="#" class="btn btn-secondary btn-warning m-2">Edit</a>
                          <form action="#" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Delete" class="btn btn-secondary btn-danger">
                          </form>
                        </td>
                    </tr>  
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> --}}
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Employee Data Table</h4>
      </div>
      <div class="card-body">
        <div class="form-group">
          <a href="/employee/create" class="btn btn-primary btn-lg mb-3" tabindex="4">
            Add Employee
          </a>
          <a class="btn btn-success btn-lg mb-3 ml-2" data-toggle="modal" data-target="#ImportModal" tabindex="4">
            Import from .xlsx
          </a>
          {{-- <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit">Import</button>
        </form> --}}
        <!-- Konten tampilan Anda -->
<!-- ... -->
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>                                 
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Nama Karyawan</th>
                <th class="text-center">Department</th>
                <th class="text-center">Title</th>
                <th class="text-center">Join Date</th>
                <th class="text-center">Work Duration</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>  
              @forelse ($employees as $key=>$value)
                  <tr>
                    <td class="text-center">
                      {{$value->id}}
                    </td>
                    <td class="text-center">{{$value->nik}}</td>
                    <td>{{$value->full_name}}</td>
                    <td class="text-center">{{$value->Department->dept_name}}</td>
                    <td class="text-center">{{$value->Title->title_name}}</td>
                    <td class="text-center">{{$value->join_date}}</td>
                    <td class="text-center">{{$value->workDuration}}</td>
                    <td class="text-center">                   
                      <a href="/employee/{{$value->id}}/edit" class="btn btn-warning m-2">Edit</a>
                      {{-- <a href="/employee/{{$value->id}}" class="btn btn-primary m-2">Show</a> --}}
                        <form action="/employee/{{$value->id}}" method="post">
                          @csrf
                          @method('delete')
                          <input type="submit" value="Delete" class="btn btn-danger m-2">
                        </form>
                    </td>
                  </tr>
              @empty
                  <tr colspan="3">
                      <td class="text-center">No data</td>
                      <td class="text-center">No data</td>
                      <td class="text-center">No data</td>
                      <td class="text-center">No data</td>
                      <td class="text-center">No data</td>
                      <td class="text-center">No data</td>
                      <td class="text-center">No data</td>
                      <td>
                        <a href="#" class="btn btn-secondary btn-warning m-2">Edit</a>
                        <form action="#" method="post">
                          @csrf
                          @method('delete')
                          <input type="submit" value="Delete" class="btn btn-secondary btn-danger">
                        </form>
                      </td>
                  </tr>  
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>         
@endsection

<!-- Modal -->
<div class="modal fade" id="ImportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Import Data from Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/importexcel" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div class="form-group">
          <input type="file" name="file" required>
          {{-- <label class="custom-file-label" for="customFile">Choose file</label> --}}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Penutup tag body dan script lainnya -->