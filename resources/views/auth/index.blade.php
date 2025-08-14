<?php $helper = new \App\Helpers\FingerHelper(); ?>
@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Users</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
        </ol>
    </div>
@endsection
@section('button')
    <a href="{{ route('register') }}" class="btn btn-success btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i> Add User</a>
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

                            <thead class="thead-dark">
							<!-- Log on to codeastro.com for more projects! -->
                                    <tr>
                                        <th data-priority="1">#</th>
                                        <th data-priority="2">Name</th>
                                        <th data-priority="2">Email</th>
                                        <th data-priority="3">Admin?</th>
                                        <th data-priority="7">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_admin ? "Admin" : "Users" }}</td>
                                            <td>
                                                <a href="{{ route('register_edit', $user->id) }}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i></a>
                                                <a href="{{ route('register_delete',$user->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i></a>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Log on to codeastro.com for more projects! -->
        </div> <!-- end col -->
    </div> <!-- end row -->

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
