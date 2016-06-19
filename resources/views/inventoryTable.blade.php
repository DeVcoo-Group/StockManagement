@extends('layouts.content')
@section('title','Inventory Table')
@section('content_title','Inventory Table')

@section('content_body')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <a href="{{route('stock.history')}}">Inventory History</a>
                <table class="table table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <th>Quatity</th>
                    </tr>
                    @forelse ($inventorys as $inventory)
                        <tr>
                            <td>
                                {{$inventory->product->name}}
                            </td>
                            <td>
                                {{$inventory->qty}}
                            </td>
                        <tr>               
                   @empty
                        <tr>
                            <td colspan=2><h2>No Record</h2></td>
                        <tr>
                    @endforelse
                </table>       
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection