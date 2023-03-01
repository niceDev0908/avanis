@extends('admin.layouts.app')
@section('content')

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Edit Role</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles & Permissions</a></li>
                <li class="breadcrumb-item active">Edit Role</li>
            </ol>
            <a class="btn btn-dark d-none d-lg-block m-l-15" href="{{ route('roles.index') }}">Back</a>
        </div>
    </div>
</div>

@include('admin.flash-message')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Role Name</label>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label class="control-label">Permission</label>
                                <br>
                                <?php
                                $numOfCols = 4;
                                $rowCount = 0;
                                $bootstrapColWidth = 12 / $numOfCols;
                                ?>
                                <div class="row">
                                    <?php foreach ($permission as $value) { ?>
                                        <div class="col-md-<?php echo $bootstrapColWidth; ?>">
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                        <?php
                                        $rowCount++;
                                        if ($rowCount % $numOfCols == 0) {
                                            echo '</div><div class="row">';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                        <a class="btn btn-dark" href="{{ route('roles.index') }}">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="{{URL::asset('public/js/admin/roles.js')}}"></script>
@endsection