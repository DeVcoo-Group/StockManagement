@extends('layouts.content')
@section('title','Category Table')
@section('content_title','Category Table')

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
                        <th>Description</th>
                        <th width="5"><a href="{{route('category.create')}}" class="text-green"><i class="fa fa-plus-circle"></a></th>
                    </tr>
                    @forelse ($categories as $category)
                        <tr>
                            <td>
                                <a href="{{route('category.show', ['category'=>$category->id])}}">{{$category->name}}</a>
                            </td>
                            <td>
                                {{$category->description}}
                            </td>
                            <td width="5">
                                <form action="{{route('category.destroy', ['category'=>$category->id])}}" id="formDelete{{$category->id}}" method="POST">
                                    <input type="hidden" name="_method"  value="DELETE"/>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <a href="JavaScript:isDelete({{$category->id}})" class="text-red"><i class="fa fa-trash"></i></a>
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