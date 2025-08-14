@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Upload Attendance</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Upload Attendance</a></li>

    </ol>
</div>
@endsection

@section('button')
    <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add New Upload</a>
@endsection

@section('content')
    @include('includes.flash')

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger get-alert" role="alert">
            @foreach ($errors->all() as $error)
                <span class="text-danger">{{ $error }}<br></span>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Log on to codeastro.com for more projects! -->
                    <table id="datatable-buttons" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th data-priority="1">Description</th>
                                <th data-priority="2">Date</th>
                                <th data-priority="3">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $attendance as $key => $record)

                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{$record->description}}</td>
                                <td>{{$record->upload_date}}</td>
                                <td style="width: 100px">
                                    <a href="#view{{ $record->id }}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-eye'></i></a>
                                    <a href="#edit{{ $record->id }}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i></a>
                                    <a href="#delete{{ $record->id }}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- Log on to codeastro.com for more projects! -->
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@foreach( $attendance as $record)
    @include('includes.edit_delete_attendance_upload')
@endforeach

@include('includes.add_attendance_upload')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection
