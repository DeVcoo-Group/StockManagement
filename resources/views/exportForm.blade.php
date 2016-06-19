@extends('layouts.content')
@section('title','Export')
@section('in-head')
<link rel="stylesheet" href="/lib/jQueryUI/jquery-ui.min.css">
@endsection
@section('content_title','Export')


@section('content_body')
<div class="box box-default">
    <div class="box-header">
        <div class="col-md-2"><strong>ID: </strong> {{$export->id}}</div>
        @if (empty($export->refreturn) && !empty($export->id))
        <div class="col-md-2"><a href="javascript:returnImport()" class="btn btn-warning"> Convert to Return On Purchase</a></div>
        @elseif(!empty($export->id))
        <div class="col-md-2">
            Return ID : <a href="#">{{$export->refreturn}}</a>
        </div>
        @endif
    </div>
    <div class="box-body content">
        <form method="post" action="{{url('export')}}">
            <div class="form-inline">
                <div class="col-md-2  form-group">
                    <input type="hidden" name="id" value="{{$export->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="refsup" id="refsup" value="{{$export->refsup}}">
                    <input type="hidden" name="refpro" id="refpro" value="{{$export->refpro}}">
                    <label>Supplier</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" class="form-control" name="sup-name" id="sup-name" value="{{$export->supplier->name}}" >
                    </div>
                </div>
                <div class="col-md-offset-8 col-md-2 form-group">
                    <label>Export Date</label>
                    <div class="input-group">
                        <div class="input-group-btn"><button type="button" onclick="setExportDateNow()" class="btn btn-default" tip="Now"><i class="fa fa-calendar"></i> Now</button></div>
                        <input class="form-control" name="date" id="datemask" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" type="text" value="{{$export->date->format('Y/m/d')}}">
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
                <div class="content center">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Product Information</strong></div>
                        <div class="panel-body">
                            <div class="col-md-3 form-group">
                                <label>Product Name</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-shopping-bag"></i></div>
                                    <input type="text" class="form-control" name="prod-name" id="prod-name" value="{{$export->product->name}}">
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quatity</label>
                                <input type="text" class="form-control" name="qty" value="{{$export->qty}}">
                            </div>
                            <div class="col-md-3  form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                    <input type="text" class="form-control" name="price" id="price" value="{{$export->price}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default">Save</button>
            <a href="javascript:window.history.back();" class="btn btn-default">Back</a>
        </form>
    </div>
</div>
@endsection
@section('includejs')
    <script src="/lib/input-mask/jquery.inputmask.js"></script>
    <script src="/lib/input-mask/jquery.inputmask.js"></script>
    <script src="/lib/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="/lib/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="/lib/jQueryUI/jquery-ui.min.js"></script>
@endsection
@section('script')
         //Datemask yyyy/mm/dd
        $("#datemask").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
        
        // Auto complete for supplier
        $('#sup-name').autocomplete({
            source: '/supplier/search',
            select: function(e,ui) {
                $("#refsup").val(ui.item.id);
                $(this).val(ui.item.name);
                return false;
            }
        });
        
        // Auto complete for product
        $('#prod-name').autocomplete({
            source: '/product/search',
            select: function(e,ui) {
                $("#refpro").val(ui.item.id);
                $("#price").val(ui.item.price);
                $(this).val(ui.item.name);
                return false;
            }
        });
        
       $.ui.autocomplete.prototype._renderItem =  function( ul, item ) {
            return $( "<li>" )
                .attr( "data-value", item.id )
                .append( item.name )
                .appendTo( ul );
        };
        $( document ).ready(function() {
 
        });
        function setExportDateNow() {
            $("#datemask").val($.datepicker.formatDate("y/m/d", new Date()));
        }
@endsection