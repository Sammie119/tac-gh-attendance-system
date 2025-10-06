<?php $helper = new \App\Helpers\FingerHelper(); ?>
@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Other Report</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Other Report</a></li>
        </ol>
    </div>
@endsection
@section('button')
    <a href="#other_report" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class='fa fa-cog'></i> Generate</a>
    <a href="{{ route('other_report') }}" class="btn btn-danger btn-sm btn-flat"><i class='fa fa-undo'></i> Clear</a>
@endsection

@section('content')
@include('includes.flash')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-hover table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                @if(empty($other_report))
                                    <thead class="thead-dark">
                                    <!-- Log on to codeastro.com for more projects! -->
                                        <tr>
                                            <th data-priority="4">Date</th>
                                            <th data-priority="1">EmpID</th>
                                            <th data-priority="2">Name</th>
                                            <th data-priority="2">Location</th>
                                            <th data-priority="3">Department</th>
                                            <th data-priority="5">Checked In</th>
                                            <th data-priority="6">Checked Out</th>
                                            <th data-priority="7">Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="20">No report Generated</td>
                                        </tr>
                                    </tbody>
                                @else
                                    <?php
                                        $timestamp = mktime(0, 0, 0, $other_report['month'], 1, 2000);

                                        // Format the timestamp to get the full month name ('F')
                                        $month_name = date('F', $timestamp);
                                    ?>
                                    <h4>{{ ucfirst($other_report['report']) }} Staff Report for {{ $month_name }}, {{ $other_report['year'] }}</h4>
                                    @if ($other_report['report'] === 'late')
                                        <thead class="thead-dark">
                                        <!-- Log on to codeastro.com for more projects! -->
                                            <tr>
                                                <th data-priority="4">Date</th>
                                                <th data-priority="1">EmpID</th>
                                                <th data-priority="2">Name</th>
                                                <th data-priority="2">Location</th>
                                                <th data-priority="3">Department</th>
                                                <th data-priority="5">Checked In</th>
                                                <th data-priority="6">Checked Out</th>
                                                <th data-priority="7">Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($other_report['data'] as $attendance)
                                                @if(!$helper->getLateOrIntime($attendance->check_in_time, $attendance->employee->schedules->first()->time_in, 'late'))
                                                    <tr>
                                                        <td>{{ $attendance->att_date }}</td>
                                                        <td>{{ $attendance->employee->staff_id }}</td>
                                                        <td>{{ $attendance->employee->name }}</td>
                                                        <td>{{ $attendance->location }}</td>
                                                        <td>{{ $attendance->employee->schedules->first()->slug }}</td>
                                                        <td>
                                                            {{ $attendance->check_in_time }} <br>
                                                            @if (getExcuseDateForEmployee($attendance->att_date, $attendance->employee->id))
                                                                <span class="badge badge-primary badge-pill">Excuse</span>
                                                            @else
                                                                @if ($helper->getLateOrIntime($attendance->check_in_time, $attendance->employee->schedules->first()->time_in, 'late'))
                                                                    <span class="badge badge-success badge-pill">Before</span>
                                                                @else
                                                                    <span class="badge badge-danger badge-pill">Late</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $attendance->check_out_time }} <br>
                                                            @if (getExcuseDateForEmployee($attendance->att_date, $attendance->employee->id))
                                                                <span class="badge badge-primary badge-pill">Excuse</span>
                                                            @else
                                                                @if ($helper->getLateOrIntime($attendance->check_out_time, $attendance->employee->schedules->first()->time_out, 'in_time'))
                                                                    <span class="badge badge-success badge-pill">On/Over</span>
                                                                @else
                                                                    <span class="badge badge-danger badge-pill">Before</span>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td>{{ $attendance->total_hours }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                        </tbody>
                                    @else
                                        <thead class="thead-dark">
                                        <!-- Log on to codeastro.com for more projects! -->
                                            <tr>
                                                <th data-priority="1">EmpID</th>
                                                <th data-priority="2">Name</th>
                                                <th data-priority="2">Position</th>
                                                <th data-priority="3">Department</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($other_report['data'] as $employee)
                                                <tr>
                                                    <td>{{ $employee->staff_id }}</td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->position }}</td>
                                                    <td>{{ $employee->schedules->first()->slug }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>

                                    @endif
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Log on to codeastro.com for more projects! -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    @include('includes.generate_attendance')

@endsection


@section('script')
    <!-- Responsive-table-->
	<!-- Log on to codeastro.com for more projects! -->
    <script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>

@endsection

@section('script')
    <script>
        $(function() {
            $('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary'
            });
        });
    </script>
@endsection
