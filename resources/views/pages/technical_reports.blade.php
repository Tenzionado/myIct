@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Techinical Report Calls</h1>
        <hr>
        @php
            use App\Report; 
            $report = Report::where('status', 1)->orderBy('created_at','desc')->paginate(10);

            echo $report;
        @endphp
        <ul class="breadcrumb">
            <li class="breadcrumb-item active">Reports</li>
        <li class="breadcrumb-item"><a href="{{ url('canceled')}}">Canceled</a></li>
            <li class="breadcrumb-item"><a href="{{ url('done')}}">Done</a></li>
        </ul>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Department</th>
                    <th>Reported By</th>
                    <th>Problem Reported</th>
                    <th>Encoded By</th>
                    <th>Date Reported</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($report as $reported)
                   <tr>
                        <td>{{$reported->department->name}}</td>
                        <td>{{$reported->reported_by}}</td>
                        <td style="max-width: 150px; overflow:auto;">{{$reported->problem_reported}}</td>
                        <td>{{$reported->user->name}}</td>
                        <td>{{ \Carbon\Carbon::parse( $reported->created_at )->toDayDateTimeString() }}
                        </td>
                        <td colspan="2">
                            <a href="{{ route('report.edit', $reported->id)  }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('cancel_report', $reported->id) }}" class="btn btn-sm btn-danger">Cancel</a>
                            @cannot('isOperator')
                                <a href="{{ route('done_report', $reported->id) }}" class="btn btn-sm btn-success">Done</a>
                            @endcannot
                        </td>
                    </tr>  
                @endforeach
                
            </tbody>
        </table>

        {{$report->links()}}

        
    </div>
@endsection