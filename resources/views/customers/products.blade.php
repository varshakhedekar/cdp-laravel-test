@extends('customers.layouts.app')

@section('content')

<div class="container">
    <h3 align="center">Products</h3><br />
    <div id="table_data">
        <div class="table-responsive">
            
        @foreach($data as $row)
            <div class="card card-primary products-card">
                <div class="card-header">
                    <h3 class="card-title">{{ $row->name }}</h3>
                </div>
                <div class="card-body">
                    <p>Product ID :{{ $row->id }}</p>
                    <p>Product Price : ₹{{ $row->price }}</p>
                    <p>Product Description :{{ $row->description }}</p>
                </div>      
            </div>
        @endforeach
            {!! $data->links() !!}
    </div>
</div>

@endsection