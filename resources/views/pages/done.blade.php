@extends('layouts.app')



@section('content')
    <div class="container">
        <a href="/tech_report" class="btn btn-secondary" style="float:right">Go Back</a>
        <h1>Report Done</h1>
        <hr>
        @php
        use App\Report;
        use Carbon\Carbon;

        $done_report = Report::getAllDone();

        @endphp
        <table class="table table-hover">
            <thead>
                <th>ID</th>
                <th>Department</th>
                <th>Reported By</th>
                <th>Problem Reported</th>
                <th>Date Done</th>
                <th>Action</th>                
            </thead>
            <tbody>
                @foreach($done_report as $done)
                    <tr>
                        <td>{{$done->id}}</td>
                        <td>{{$done->department->name}}</td>
                        <td>{{$done->reported_by}}</td>
                        <td>{{$done->problem_reported}}</td>
                        <td>{{Carbon::parse($done->updated_at)->toDayDateTimeString()}}</td>
                        <td>
                            @cannot('isOperator')
                                <a href="{{ route('rework',$done->id) }}" class="btn btn-warning btn-sm">Re-work</a>
                            @endcannot
                            @if(auth()->user()->role == 'operator')
                                <p>No Action</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$done_report->links()}}
    </div>
@endsection