@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Product</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Product Category</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($shop_types as $shop_type)
        <div class="col-lg-3 col-md-3 col-sm-6 selection-wrapper mb-3">
            <div class="card">
                <div class="card-body text-center">
                        <h3 class="card-title text-uppercase">{{ $shop_type->type }}<span class="badge badge-danger pull-right">{{ product_alert_category($shop_type->id) }}</span></h3>
                        <a href="{{ route('product.category.view',$shop_type->id) }}" class="btn btn-primary">View Product</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection