@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('success_message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{session()->get('success_message')}}.
        </div>        
    @endif

    <div class="row justify-content-center">
        @cannot('isSupervisor')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Calls Form</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('report.store')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control @error('department') is-invalid @enderror "  name="department" id="department">
                                            <option value="">NONE</option>
                                            @foreach($department as $departments)
                                                <option value="{{$departments->id}}">{{$departments->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>    
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reported_by">Reported By</label>
                                        <input type="text" name="reported_by" id="reported_by"  class="form-control @error('reported_by') is-invalid @enderror" value= {{ old('reported_by')}}>
                                        @error('reported_by')
                                            <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="problem_reported">Problem Reported</label>
                                    <textarea class="form-control @error('problem_reported') is-invalid @enderror"  name="problem_reported" id="problem_reported" cols="30" rows="10" value= {{ old('problem_reported')}}></textarea>
                                    @error('problem_reported')
                                            <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        @endcannot

    </div>
</div>

@can('isSupervisor')
 <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
               
                You are logged in!
            </div>
        </div>
    </div>
</div>   
@endcan

@endsection



