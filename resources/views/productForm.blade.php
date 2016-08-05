@extends('layouts.content')
@section('title','Product Form')
@section('content_title','Product Form')

@section('content_body')
<div class="box box-default">
    <div class="box-body col-md-offset-4 col-md-4">
        <form method="post" action="{{url('product')}}">
            <div class="form-group">
                <input type="hidden" name="id" value="{{$product->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Product Name</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-shopping-bag"></i></div>
                    <input type="text" class="form-control" name="name" value="{{$product->name}}" >
                </div>
            </div>
            <div class="form-group">
                <label>Default Price</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                    <input type="text" class="form-control" name="price" value="{{$product->price}}">
                </div>
            </div>
            <button type="submit" class="btn btn-default">Save</button>
            <a href="javascript:window.history.back();" class="btn btn-default">Back</a>
        </form>
    </div>
</div>
@endsection