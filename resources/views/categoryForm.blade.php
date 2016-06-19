@extends('layouts.content')
@section('title','Category Form')
@section('content_title','Category Form')

@section('content_body')
<div class="box box-default">
    <div class="box-body col-md-offset-4 col-md-4">
        <form method="post" action="{{url('category')}}">
            <div class="form-group">
                <input type="hidden" name="id" value="{{$category->id}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Name</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-list-alt"></i></div>
                    <input type="text" class="form-control" name="name" value="{{$category->name}}" >
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-info-circle"></i></div>
                    <input type="text" class="form-control" name="description" value="{{$category->description}}">
                </div>
            </div>
            <button type="submit" class="btn btn-default">Save</button>
            <a href="javascript:window.history.back();" class="btn btn-default">Back</a>
        </form>
    </div>
</div>
@endsection