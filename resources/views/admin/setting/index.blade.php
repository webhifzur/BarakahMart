@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Setting</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Setting</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" value="{{ $setting->id }}" name="setting_id">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="card-box">
                    <label for="emailaddress3">Menu Logo</label>
                    <span class="text-danger">(200px/65px)</span>
                    <input type="file" class="dropify" data-default-file="{{ asset('uploads/'.$setting->menu_logo) }}" name="menu_logo"/>
                    @error('menu_logo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12 ">
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Category Title</label>
                    <input type="text" class="form-control" name="c_title" placeholder="Category Title" value="{{ $setting->c_title }}">
                </div>
                @error('c_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Product Title</label>
                    <input type="text" class="form-control" name="p_title" placeholder="Product Title" value="{{ $setting->p_title }}">
                </div>
                @error('p_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Product SubTitle</label>
                    <input type="text" class="form-control" name="p_subtitle" placeholder="Product SubTitle" value="{{ $setting->p_subtitle }}">
                </div>
                @error('p_subtitle')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card-box">
                    <label for="emailaddress3">Footer Logo</label>
                    <span class="text-danger">(275px/155px)</span>
                    <input type="file" class="dropify" data-default-file="{{ asset('uploads/'.$setting->footer_logo) }}" name="footer_logo"/>
                    @error('footer_logo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 col-sm-12 col-12 ">
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Offer Title</label>
                    <input type="text" class="form-control" name="offer_title" placeholder="Product Offer" value="{{ $setting->offer_title }}">
                </div>
                @error('offer_title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group m-b-25">
                    <h6>Footer Description</h6>
                    <textarea type="text" class="form-control" name="footer_description" style="min-height: 150px">{{ $setting->footer_description }}</textarea>
                </div>
                @error('footer_description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="col-md-6 col-sm-12 col-12 ">
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Phone One</label>
                    <input type="text" class="form-control" name="phone_one" placeholder="phone one" value="{{ $setting->phone_one }}">
                </div>
                @error('phone_one')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Phone Two</label>
                    <input type="text" class="form-control" name="phone_two" placeholder="phone two" value="{{ $setting->phone_two }}">
                </div>
                @error('phone_two')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group m-b-25">
                    <label for="emailaddress3">What's App Link</label>
                    <input type="text" class="form-control" name="whatsapp" placeholder="What's App Link" value="{{ $setting->whatsapp }}">
                </div>
                @error('whatsapp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group m-b-25">
                    <label for="emailaddress3">Facebook Link</label>
                    <input type="text" class="form-control" name="facebook" placeholder="Facebook Link" value="{{ $setting->facebook }}">
                </div>
                @error('facebook')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="card-box">
                    <label for="emailaddress3">InnerPage Image</label>
                    <span class="text-danger">(1300px/400px)</span>
                    <input type="file" class="dropify" data-default-file="{{ asset('uploads/'.$setting->innerpage) }}" name="innerpage"/>
                    @error('innerpage')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group account-btn text-center m-t-10">
                <div class="col-12">
                    <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light" type="submit">Add</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('content.script')

@endsection