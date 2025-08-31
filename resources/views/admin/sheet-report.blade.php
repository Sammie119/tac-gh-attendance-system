<?php $helper = new \App\Helpers\FingerHelper(); ?>
@extends('layouts.master')

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Attendance Sheet Report</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Attendance Sheet Report</a></li>
        </ol>
    </div>
@endsection

@section('button')
    <a href="#attendance_sheet" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class='fa fa-cog'></i> Generate</a>
    <a href="{{ route('sheet-report') }}" class="btn btn-danger btn-sm btn-flat"><i class='fa fa-undo'></i> Clear</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-header bg-success text-white">
            <h5>Attendance Sheet Report for {{ $header }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <b>Legend:</b>
                <nav class="nav">
                    <a class="nav-link disabled">Excuse: <i class="fa fa-check text-primary"></i></a>
                    <a class="nav-link disabled">Before/Over/On-Time: <i class="fa fa-check text-success"></i></a>
                    <a class="nav-link disabled">Late/Early: <i class="fa fa-check text-danger"></i></a>
                    <a class="nav-link disabled">Absent: <i class="fas fa-times text-danger"></i></a>
                </nav>
                <table class="table table-md table-hover" id="printTable">
                    <thead class="thead-dark">
                        <tr >
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Position</th>
                            <!-- <th>ID</th> -->
							<!-- Log on to codeastro.com for more projects! -->

                            @foreach ($dates as $date)
                                <th style="">{{ $date }}</th>
                            @endforeach

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($employees as $employee)
                            <input type="hidden" name="emp_id" value="{{ $employee->id }}">
                            <tr>
                                <td>{{ $employee->staff_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <!-- <td>{{ $employee->id }}</td> -->
								<!-- Log on to codeastro.com for more projects! -->
                                {{-- @for ($i = 1; $i < $today->daysInMonth + 1; ++$i) --}}
                                @foreach ($dates as $date)
                                    @php
                                        $check = \App\Models\AttendanceRecord::query()
                                            ->where('employee_id', $employee->id)
                                            ->where('att_date', $date)
                                            ->first();
                                    @endphp
                                    <td>
                                        <div class="form-check form-check-inline ">
                                            @if (getExcuseDateForEmployee($date, $employee->id))
                                                    <i class="fa fa-check text-primary"></i>
                                            @else
                                                @if (isset($check->check_in_time))
                                                    @if ($helper->getLateOrIntime($check->check_in_time, $check->employee->schedules->first()->time_in, 'late'))
                                                        <i class="fa fa-check text-success"></i>
                                                    @else
                                                        <i class="fa fa-check text-danger"></i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-times text-danger"></i>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="form-check form-check-inline">
                                            @if (getExcuseDateForEmployee($date, $employee->id))
                                                    <i class="fa fa-check text-primary"></i>
                                            @else
                                                @if (isset($check->check_out_time))
                                                    @if ($helper->getLateOrIntime($check->check_out_time, $check->employee->schedules->first()->time_out, 'in_time'))
                                                        <i class="fa fa-check text-success"></i>
                                                    @else
                                                        <i class="fa fa-check text-danger"></i>
                                                    @endif

                                                @else
                                                    <i class="fas fa-times text-danger"></i>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                                {{-- @endfor --}}
                            </tr>
                        @endforeach

                    </tbody>
					<!-- Log on to codeastro.com for more projects! -->
                </table>
            </div>
        </div>
    </div>

    @include('includes.generate_attendance')
@endsection
