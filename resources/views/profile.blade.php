@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Profile</h4>
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form method="POST" action="{{ route('dashboard.profile.update') }}"
                data-parsley-validate novalidate enctype="multipart/form-data">
                @csrf
                <h1>Basic Info :</h1>

                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card-box">
                            <input type="file" class="dropify" data-default-file="{{ asset('storage/public/'.$user->profile_img) }}" name="profile_img" />
                            @error('profile_img')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="userName">User Name*</label>
                            <input type="text" name="name" parsley-trigger="change" required
                                placeholder="Enter Full Name" class="form-control" id="userName" value="{{ $user->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email address*</label>
                            <input type="email" name="email" parsley-trigger="change" required
                                placeholder="Enter email" class="form-control" id="emailAddress" value="{{ $user->email }}">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Phone*</label>
                            <input type="tel" name="phone" parsley-trigger="change" required
                                placeholder="Enter Phone" class="form-control" id="phoneNumber" value="{{ $user->phone }}">
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="address">Address*</label>
                            <textarea class="form-control w-100 h-100" name="address" id="">{{ $user->address }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>City*</label>
                            <select name="city" id="" class="form-control">
                            @foreach (cities() as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            <label>Area*</label>
                            <select name="area" id="area" class="form-control">
                            @foreach (areas() as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group text-right m-b-0">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        Update
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('dashboard.password.update') }}"
                data-parsley-validate novalidate enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h1>Password Update :</h1>
                        <div class="form-group">
                            <label for="pass1">Password*</label>
                            <input id="pass1" name="oldpassword" type="password" placeholder="Old Password" required
                                class="form-control" autocomplete="">
                            @if(session()->has('oldpassword'))
                                <div class="alert alert-danger">{{ session('oldpassword') }}</div>
                            @endif 
                            @error('oldpassword')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass1">Password*</label>
                            <input id="pass1" name="password" type="password" placeholder="Password" required
                                class="form-control">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="passWord2">Confirm Password *</label>
                            <input data-parsley-equalto="#pass1" name="password_confirmation" type="password" required
                                placeholder="Confirm Password" class="form-control" id="passWord2">
                        </div>
                        <div class="form-group text-right m-b-0">
                            <button class="btn btn-primary waves-effect waves-light" type="submit">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
@section('content.script')
    {{-- toastr js --}}
    <script>
        @if(Session::has('updateprofile'))
            // Display a success toast, with a title
            toastr.success('Your profile updated Successfully', 'Congratulation!')
        @endif
        @if(Session::has('passwordsuccess'))
            // Display a success toast, with a title
            toastr.success('Your password changed Successfully', 'Congratulation!')
        @endif
       
        @if ($errors->any())
            // Display an error toast, with a title
            toastr.error('You Have Any Error', 'Sorry!')
        @endif
    </script>
@endsection