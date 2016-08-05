@extends('layouts.content')
@section('title','Home')
@section('content_title','Home')

@section('content_body')
<div class="box box-default">
<div class="row">
    <div class="content">
        <div class="col-sm-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Supplier</h3>
                    <p>Supplier Information</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{url('supplier')}}" class="small-box-footer">
                    Click here  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>
        <!--<div class="col-sm-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Category</h3>
                    <p>Category Information</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list-alt"></i>
                </div>
                <a href="{{url('category')}}" class="small-box-footer">
                    Click here  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>-->
        <div class="col-sm-3">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Product</h3>
                    <p>Product Information</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="{{url('product')}}" class="small-box-footer">
                    Click here  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>Inventory</h3>
                    <p>Inventory Information</p>
                </div>
                <div class="icon">
                    <i class="fa fa-building-o"></i>
                </div>
                <a href="{{url('inventory')}}" class="small-box-footer">
                    Click here  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>In Flow</h3>
                    <p>In Flow Information</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{url('incoming')}}" class="small-box-footer">
                    Click here  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>
        <div class="col-sm-3">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>Out Flow</h3>
                    <p>Out Flow Information</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-basket"></i>
                </div>
                <a href="{{url('outcoming')}}" class="small-box-footer">
                    Click here  <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
        </div>
    </div>
</div>
</div>
@endsection
