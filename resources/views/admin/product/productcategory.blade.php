@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title float-left">Product</h4>
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Product Category</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <a href="{{ route('product.show',$shop_types) }}" class="ml-3 mr-1 btn btn-icon waves-effect waves-light btn-primary" style="float:left">
                            Add Product
                        </a>
                        <a href="{{ route('product.restore.view') }}" class="mr-3 btn btn-icon waves-effect waves-light btn-primary" style="float:left">Restore</a>
                        <tr>
                            <th>Sl No.</th>
                            <th>Name</th>
                            <th>P.Coad</th>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Unit</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                            <th>Quantity</th>
                            <th>Shop Type</th>
                            <th>Status</th>
                            @if (Auth::user()->type == 1)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="{{ ($product->qty < 5) ? 'bg-danger' : '' }}">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->product_coad }}</td>
                                <td>
                                    @if(!$product->image == null)
                                        <img src="{{ asset('uploads/'.$product->image) }}" alt="product img" width="80px" height="80px">
                                    @endif
                                </td>
                                <td>
                                    @if(!$product->brands == null)
                                        {{ $product->brands->name }}
                                    @endif
                                </td>
                                <td>
                                    @if(!$product->units == null)
                                        {{ $product->units->name }}
                                    @endif
                                </td>
                                <td>{{ $product->buy_price }}</td>
                                <td>{{ $product->sell_price }}</td>
                                <td>
                                    {{ $product->qty }}
                                </td>
                                <td>{{ $product->shop_types->type }}</td>
                                <td>
                                    @if ($product->status == 0)
                                        <a href="{{ route('product.active',$product->id) }}" class="btn btn-icon waves-effect waves-light btn-primary" data-overlayColor="#36404a">Active</a>
                                    @else
                                        <a href="{{ route('product.deactive',$product->id) }}" class="btn btn-icon waves-effect waves-light btn-primary" data-overlayColor="#36404a">Deactive</a>
                                    @endif
                                </td>
                                @if (Auth::user()->type == 1)
                                    <td>
                                        <a href="{{ route('product.edit',$product->id) }}" class="btn btn-icon waves-effect waves-light btn-primary" data-overlayColor="#36404a"><i class="far fa-edit"></i></a>
                                        <form method="POST" action="{{ route('product.destroy',$product->id) }}" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon waves-effect waves-light btn-danger"> <i class="far fa-trash-alt"></i> </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

