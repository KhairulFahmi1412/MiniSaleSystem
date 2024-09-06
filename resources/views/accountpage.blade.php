@extends('layouts.user')

@section('title', 'User Account Page')

@section('content')
    <h1>User Account Information</h1>
    <table class="table table-bordered ">
            <form method="post" action="{{route('userUpdateAccount')}}">
                @csrf
                <tr>
                    <th class="align-middle">Name:</th>
                    <td><input type="text" name="name" value="{{$user->name}}" id='name' class="form-control"/></td>
                    <td rowspan=2 class="align-middle text-center"><button type="submit" onclick="return verifyUpdate()" class="btn btn-success align-middle text-center">Update Account Info</button></td>
                </tr>
                <tr>
                    <th class="align-middle">Phone Number:</th>
                    <td><input type="text" name="phone_no" value="{{$user->phone_no}}" id='phone_no' class="form-control"/></td>
                </tr>
            </form>
            <tr>
                <th class="align-middle">Email:</th>
                <td onclick="alert('Email cannot be changed!')" >{{$user->email}}</td>
            </tr>
            <form method="post" action="{{route('userUpdatePassword')}}" id='submitPassword' onsubmit="return verifyPasswords()">
                @csrf
                <tr>
                    <th class="align-middle">Current Password:</th>
                    <td><input type="password" name="cur_password" id="cur_password" class="form-control" placeholder="Enter current password" /></td>
                    <td rowspan=2 class="align-middle text-center"><button type="submit" class="btn btn-warning">Change Password</button></td>
                </tr>
                <tr>
                    <th class="align-middle">New Password:</th>
                    <td><input type="password" name="new_password" id="new_password" class="form-control"  placeholder="Enter new password"  /></td>
                </tr>
            </form>
        </table>
<script>
    function verifyPasswords(){
        var cur_password = document.getElementById('cur_password').value;
        var new_password = document.getElementById('new_password').value;

        
        if(cur_password == "" || new_password == ""){
            alert("Either passwords cannot be empty");
            return false;
        }
        else if(cur_password == new_password){
            alert("New password cannot be the same as the current password");
            return false;
        }

        return true;
    }
    function verifyUpdate(){
        var name = document.getElementById('name').value;
        var phone_no = document.getElementById('phone_no').value;

        if(name == "" || phone_no == ""){
            alert("Name and Phone Number cannot be empty");
            return false;
        }

        return true;

    }
    </script>
@endsection