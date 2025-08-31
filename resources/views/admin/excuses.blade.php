@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left">Employees</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Excuses</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Excuses List</a></li>

    </ol>
</div>
@endsection
@section('button')
    <a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add New Excuse</a>
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
                                    <th data-priority="1" style="width: 80px">Staff ID</th>
                                    <th data-priority="2">Name</th>
                                    <th data-priority="3">Excuse</th>
                                    <th data-priority="4">Start Date</th>
                                    <th data-priority="4">End Date</th>
                                    <th data-priority="5">Approved By</th>
                                    <th data-priority="6" style="width: 90px">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach( $excuses as $excuse)
                                        <tr>
                                            <td>{{$excuse->employee->staff_id}}</td>
                                            <td>{{$excuse->employee->name}}</td>
                                            <td>{{$excuse->excuse_type}}</td>
                                            <td>{{$excuse->from_date}}</td>
                                            <td>{{$excuse->to_date}}</td>
                                            <td>{{$excuse->approved->name}}</td>
                                            <td>
                                                <a href="#view{{$excuse->id}}" data-toggle="modal" class="btn btn-info btn-sm view btn-flat"><i class='fa fa-eye'></i></a>
                                                <a href="#edit{{$excuse->id}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i></a>
                                                <a href="#delete{{$excuse->id}}" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Log on to codeastro.com for more projects! -->
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@foreach( $excuses as $excuse)
    @include('includes.edit_delete_excuse')
@endforeach

@include('includes.add_excuse')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection
