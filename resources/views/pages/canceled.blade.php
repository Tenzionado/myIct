@extends('layouts.app')



@section('content')
    <div class="container">
        
        <h1>Canceled Calls<a href="{{ url('/tech_report')}}" class="btn btn-secondary" style="float:right">Go Back</a></h1>
        <hr>
        @php
            use App\Report;
            use Carbon\Carbon;

            $canceled_report = Report::getAllCanceled();

            echo $canceled_report;

        @endphp
        <table class="table table-hover">
            <thead>
                <th>ID</th>
                <th>Department</th>
                <th>Reported By</th>
                <th>Problem Reported</th>
                <th>Date Reported</th>
                <th>Action</th>                
            </thead>
            <tbody>
                @foreach($canceled_report as $canceled)
                    <tr>
                        <td>{{$canceled->id}}</td>
                        <td>{{$canceled->department->name}}</td>
                        <td>{{$canceled->reported_by}}</td>
                        <td>{{$canceled->problem_reported}}</td>
                        <td>{{Carbon::parse($canceled->created_at)->toDayDateTimeString()}}</td>
                        <td>
                            @cannot('isOperator')
                                <a href="{{ route('retrieve',$canceled->id) }}" class="btn btn-warning btn-sm">Retrieve</a>
                            @endcannot
                            @if(auth()->user()->role == 'operator')
                                <p>No Action</p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$canceled_report->links()}}
    </div>
@endsection