@extends('layouts.content')
@section('title','Product Table')
@section('content_title','Product Table')

@section('content_body')

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Default Price</th>
                        <th width="5"><a href="{{route('product.create')}}" class="text-green"><i class="fa fa-plus-circle"></a></th>
                    </tr>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                <a href="{{route('product.show', ['product'=>$product->id])}}">{{$product->name}}</a>
                            </td>
                            <td>
                                {{$product->price}}
                            </td>
                            <td width="5">
                                <form action="{{route('product.destroy', ['product'=>$product->id])}}" id="formDelete{{$product->id}}" method="POST">
                                    <input type="hidden" name="_method"  value="DELETE"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="JavaScript:isDelete({{$product->id}})" class="text-red"><i class="fa fa-trash"></i></a>
                                </form>
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
    function isDelete(id) {
        var isDelete = confirm("Are you really sure to delete it?");
        if(isDelete) {
            var form = jQuery('#formDelete'+id);
            form.submit();
        } 
    }
@endsection