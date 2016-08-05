@extends('layouts.master')
@section('title','Page Not Found')
@section('in-head')
@endsection

@section('content')

<div class="center col-md-offset-2 col-md-8" style="margin-top:10%">
    <div class="form-group">
    <div class="box box-danger box-solid">
        <div class="box-header with-border">
            <h1 class="box-title">404 Page Not Found</h1>
        </div>
        <div class="box-body">
            <h2><i class="fa fa-exclamation-triangle" style="color:red"></i> Sorry, we can't find the page you're looking for.</h2><br>
            @if(!empty($message))
            <pre>{{$message}}</pre>
            @endif
            <a href="javascript:window.history.back();">Back to previous page</a>
        </div>
    </div>
    </div>
</div>
@endsection
