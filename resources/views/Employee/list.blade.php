<?php 
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>
@extends('layouts.app')
@section('title','Employee List')

@section('page-style')

@stop
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <a href="{{route('employee.create')}}">Add Employee</a>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive contact">
                <table class="table" id="employee_table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cnt = 1; ?>
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$cnt++}}</td>
                                <td>{{ $employee->first_name }}</td>
                                <td>{{ $employee->last_name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>
                                    <a href="{{route('employee.view',['id'=>base64_encode($employee->id)])}}" class="btn btn-raised btn-primary btn-round waves-effect" title="View">View</a>

                                    <a href="{{route('employee.edit',['id'=>base64_encode($employee->id)])}}" class="btn btn-raised btn-primary btn-round waves-effect" title="Edit">Edit</a>

                                    <a  href="{{route('employee.delete',['id'=>base64_encode($employee->id)])}}" class="btn btn-danger btn-sm" title="Delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(count($employees) > 0)
                <div class="row clearfix">
                     <div class="col-lg-12">
                        {!! $employees->appends(Request::all())->links() !!}   
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@stop
@section('page-script')
<script type="text/javascript">
    $(document).ready(function () {
      $('#employee_table').DataTable({
        "paging": false // false to disable pagination (or any other option)
      });
    });
</script>

@stop