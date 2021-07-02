@extends('layouts.AdminLayout')
@section('content')

    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a> >
    <a style="text-decoration:none" href="{{route('ProfileSettings')}}">&nbsp Account Settings &nbsp</a>>
    <a style="pointer-events: none" href="">&nbsp Change Password</a>
    <div style="float:right">
        <a class="btn btn-primary" href="{{route('ProfileSettings')}}">Back</a> |
        <a class="btn btn-primary" href="{{route('Home')}}">Home</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Account Settings</h4>
    <div class="card">
        <div class="card-header">
            <div class="card-title">Change Password</div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <input type="password" class="form-control input-square" id="squareInput" placeholder="Password">
            </div>	
            <div class="form-group">
                <input type="password" class="form-control input-square" id="squareInput" placeholder="Enter New Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-square" id="squareInput" placeholder="Confirm New Password">
            </div>
        </div>
        <div class="card-action">
            <button class="btn btn-success">Change</button>
            <button class="btn btn-danger">Cancel</button>
        </div>
    </div>
    
@stop