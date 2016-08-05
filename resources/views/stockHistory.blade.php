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
                <div class="form-group">
                    <a href="javascript:window.history.back();" class="btn btn-default">Back</a>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quatity</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Supplier Name</th>
                    </tr>
                    @forelse ($stockControls as $stockControl)
                        <tr>
                            <td>{{$stockControl->id}}</td>
                            <td>
                                {{$stockControl->product->name}}
                            </td>
                            <td>
                                {{$stockControl->qty}}
                            </td>
                            <td>
                                {{$stockControl->date->format('Y/m/d')}}
                            </td>
                            <td>
                                {{$stockControl->price}}
                            </td>
                            <td>
                                @if ($stockControl->type == $stockControl::TYPE_IN)
                                    <a href="{{route('incoming.index',['id'=>$stockControl->id])}}">Import</a>
                                @elseif ($stockControl->type == $stockControl::TYPE_OUT)
                                    <a href="{{route('outcoming.index',['id'=>$stockControl->id])}}">Export</a>
                                @elseif ($stockControl->type == $stockControl::TYPE_RETURN_IN)
                                    Return Import
                                @elseif ($stockControl->type == $stockControl::TYPE_RETURN_OUT)
                                    Return Export
                                @endif
                            </td>
                            <td>
                                @if (!empty($stockControl->supplier->name))
                                    {{ $stockControl->supplier->name }}
                                @endif
                            </td>
                        <tr>
                   @empty
                        <tr>
                            <td colspan=7><h2>No Record</h2></td>
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
