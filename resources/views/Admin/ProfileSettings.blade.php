@extends('layouts.AdminLayout')
@section('content')
    <a style="text-decoration:none" href="{{route('Home')}}">Home &nbsp </a>><a style="pointer-events: none;" href="{{route('ProfileSettings')}}">&nbsp Account Settings</a>
    <div style="float:right">
        <a class="btn btn-info" href="{{route('UploadPhoto')}}">Change Profile Photo</a> |
        <a class="btn btn-primary" href="{{route('ChangePassword')}}">Change Password</a>
    </div>
    <br>
    <h4 style="margin-top:15px; margin-bottom:20px">Account Settings</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Profile info</div>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <h6><b>Name : </b><span>{{$user['name']}}</span></h6>
                            </div>
                            <div class="form-group">
                                <h6><b>Username : </b><span>{{$user['userName']}}</span></h6>
                            </div>
                            <div class="form-group">
                                <h6><b>Position : </b><span style="color:#5680E9">{{$user['userType']}}</span></h6>
                            </div>
                            <div class="form-group">
                                <h6><b>Email : </b><span>{{$user['email']}}</span></h6>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <img src="assets/img/profile.jpg" class="img-thumbnail rounded-circle" style="height:90%; width:90%" alt="...">
                                <!-- <button class="btn btn-primary row justify-content-center" style="float:right; border-radius: 35px;">Change Photo</button> -->
                            </div>
                            <!-- <div class="form-group" style="text-align:center; color:black">
                                <button class="btn btn-warning">Change</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <h6><b>Phone number : </b><span>{{$user['phone']}}</span></h6>
                    </div>
                    <div class="form-group">
                        <h6><b>Address : </b><span>{{$user['address']}}</span></h6>
                    </div>
                    <div class="form-group">
                        <h6><b>District : </b><span>{{$user['district']}}</span></h6>
                    </div>								
                </div>
                <div class="card-action">

                </div>
            </div>
        </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update profile info</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" class="form-control input-square" id="squareInput" value="{{$user['name']}}">
                        </div>	
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control input-square" id="squareInput" value="{{$user['email']}}">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control input-square" id="squareInput" value="{{$user['phone']}}">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea class="form-control" rows="3" id="address" name="address" value="Address">{{ $user["address"] }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">District</label>
                            <input type="text" class="form-control input-square" id="squareInput" value="{{$user['district']}}">
                        </div>									
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Update</button>
                        <button class="btn btn-danger">Cancel</button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@stop