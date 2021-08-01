@extends('layout.admin.master-layout')


@section('title', 'Create New Product')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Products</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection

@section('content')

<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    @include('admin.product._from', [
        'button' => 'Add',
    ])
</form>

@endsection
