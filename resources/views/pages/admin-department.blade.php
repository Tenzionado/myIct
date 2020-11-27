@extends('layouts.app')



@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success! </strong> {{session()->get('department')}}  {{session()->get('success')}}. 
            </div>
        @endif
        @error('name')
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error! </strong> {{ $message }}. 
            </div>
        @enderror
        <h1>Department</h1>
        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#addModal">
            <b>+Add</b>
        </button>
        <hr>
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <table class="table table-hover">
                    @php
                        use App\Department;

                        $department = Department::getDepartment();
                    @endphp
                    <thead>
                        <th>Name</th>
                        <th class="text-center" style="width: 200px;">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($department as $dept)
                          <tr data-id = {{$dept->id}} id="row_{{$dept->id}}">
                            <td style="vertical-align:center">{{$dept->name}}</td>
                            <td class="text-center">
                                <a href="javascript:void(0)" data-id = {{$dept->id}} class="btn btn-sm btn-outline-danger " onclick = "edit(event.target)"  id="btn-edit" >
                                    Edit
                                </a>
                                <a href="javascript:void(0)" data-id = {{$dept->id}} class="btn btn-sm btn-outline-danger " onclick ="delete_data(event.target)" id="btn-delete">
                                    Delete
                                </a>

                            </td>
                          </tr>  
                        @endforeach
                        
                    </tbody>
                </table>
               {{ $department->links()}}
            </div>
        </div>
    </div>

            <!-- The Modal -->
        <div class="modal fade" id="addModal">
            <div class="modal-dialog">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Add new department</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" name="name" placeholder="Department Name">
                        </div>
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

        <div class="modal fade" id="edit-modal">
            <div class="modal-dialog">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Modals</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="dept_id">
                            <label for=""><span id="nameErrMsg" style="color: #dc3545"></span></label>
                            <input type="text" class="form-control" name="name" id="dept_name" placeholder="Department Name" required>
                            
                        </div>
                    </div>
            
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <a href="javascript:void(0)" id="btn-update" onclick="update()" class="btn btn-success">Update</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
@endsection

@push('script')
    <script src="{{ asset('js/jquery.js') }}"></script> 
    <script>

        function edit(event){
            $('#nameErrMsg').html('');
            var id = $(event).data("id");

            let _url = `edit_department/${id}/edit`;

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(response){
                    $('#dept_id').val(response.department.id);
                    $('#dept_name').val(response.department.name);
                    $('#edit-modal').modal('show');
                }
            });
        }

        function delete_data(event){
            var id = $(event).data("id");
            let _url = `department/delete/${id}`;
            let _token = $('meta[name="csrf-token"]').attr('content');

            

            $.ajax({
                url :_url,
                type : 'DELETE',
                data:{
                    _token:_token
                },success:function(response){
                    alert(response.success);
                    $('#row_'+id).fadeOut();
                    console.log(response);
                }
            });
            
        }

        function update(){
            var id = $('#dept_id').val();
            var department = $('#dept_name').val();
            let _url = `department/${id}`;
            let _token = $('meta[name="csrf-token"]').attr('content');
            $('#edit-modal').modal('hide');
            $.ajax({
                url : _url,
                type : 'put',
                data : {
                    id : id,
                    department : department,
                    _token : _token
                },success:function(response){
                    $('#row_'+id).find('td:eq(0)').text(department);
                },error:function(response){
                    $('#edit-modal').modal('show');
                    $('#nameErrMsg').html(response.responseJSON.errors.department[0]);            
                }
            });
        }
    </script>
@endpush