@extends('layouts.main')

@section('title')
    Product {{ $id }}
@endsection

@push('meta')
    <meta name="description" content="Product {{ $id }}">
@endpush


@section('body')
    <form action="/products/{{ $id }}" method="POST">
        {!! formHiddenInputTags() !!}
        {!! formMethod("PUT") !!}
        <label for="product_name">Product Name</label>
        <br>
        <input type="text" name="product_name" id="product_name" value="{{ flashMessage("product_name") }}">
        <span>{{ flashMessage("product_name_error") }}</span>
        <br>
        <br>
        <button type="submit">Update</button>
    </form>
@endsection
