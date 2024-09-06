@extends('layouts.seller')
@section('title', 'Seller Account Page')
@section('content')

    <h1>Seller Account Information</h1>
    <table class="table table-bordered">
            <form method="post" action="{{route('sellerUpdateAccount')}}">
                @csrf
                <tr>
                    <th class="align-middle">Seller's Name:</th>
                    <td><input type="text" name="name" value="{{$seller->name}}" id='name' class="form-control"/></td>
                    <td rowspan=3 class="align-middle text-center"><button type="submit" onclick="return verifyUpdate()" class="btn btn-success align-middle text-center">Update Account Info</button></td>
                </tr>
                <tr>
                    <th class="align-middle">Shop Name:</th>
                    <td><input type="text" name="shop_name" value="{{$seller->shop_name}}" id='shop_name' class="form-control"/></td>
                </tr>
                <tr>
                    <th class="align-middle">Phone Number:</th>
                    <td><input type="text" name="phone_no" value="{{$seller->phone_no}}" id='phone_no' class="form-control"/></td>
                </tr>
            </form>
            <tr>
                <th class="align-middle">Email:</th>
                <td onclick="alert('Email cannot be changed!')" >{{$seller->email}}</td>
            </tr>
            <form method="post" action="{{route('sellerUpdatePassword')}}" id='submitPassword' onsubmit="return verifyPasswords()">
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
        var shop_name = document.getElementById('shop_name').value;

        if(name == "" || phone_no == "" || shop_name == ""){
            alert("Seller Name, Shop Name and Phone Number cannot be empty");
            return false;
        }

        return true;

    }
    </script>

@endsection
