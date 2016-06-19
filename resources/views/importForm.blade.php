@extends('layouts.content')
@section('title','Import')
@section('in-head')
<link rel="stylesheet" href="/lib/jQueryUI/jquery-ui.min.css">
@endsection
@section('content_title','Import')


@section('content_body')
<div class="box box-default">
    <div class="box-header">
        <div class="col-md-2"><strong>ID: </strong> {{$import->id}}</div>
        @if (empty($import->refreturn) && !empty($import->id))
        <div class="col-md-2"><a href="javascript:returnImport()" class="btn btn-warning"> Convert to Return On Purchase</a></div>
        @elseif(!empty($import->id))
        <div class="col-md-2">
            Return ID : <a href="#">{{$import->refreturn}}</a>
        </div>
        @endif
    </div>
    <div class="box-body content">
        <form id='import' method="post" action="{{url('import')}}">
            <div class="form-inline">
                <div class="col-md-2  form-group">
                    <input type="hidden" name="id" value="{{$import->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="refsup" id="refsup" value="{{$import->refsup}}">
                    <input type="hidden" name="refreturn" id="refsup" value="{{$import->refreturn}}">
                    <input type="hidden" name="refpro" id="refpro" value="{{$import->refpro}}">
                    <label>Supplier</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        <input type="text" class="form-control" name="sup-name" id="sup-name" value="{{$import->supplier->name}}" >
                    </div>
                </div>
                <div class="col-md-offset-8 col-md-2 form-group">
                    <label>Import Date</label>
                    <div class="input-group">
                        <div class="input-group-btn"><button type="button" onclick="setImportDateNow()" class="btn btn-default" tip="Now"><i class="fa fa-calendar"></i> Now</button></div>
                        <input class="form-control" name="date" id="datemask" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" type="text" value="{{$import->date->format('Y/m/d')}}">
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
                                    <input type="text" class="form-control" name="prod-name" id="prod-name" value="{{$import->product->name}}">
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quatity</label>
                                <input type="text" class="form-control" name="qty" value="{{$import->qty}}">
                            </div>
                            <div class="col-md-3  form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                    <input type="text" class="form-control" name="price" id="price" value="{{$import->price}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (empty($import->id))
            <button type="submit" class="btn btn-default">Save</button>
            @endif
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
        function setImportDateNow() {
            $("#datemask").val($.datepicker.formatDate("y/m/d", new Date()));
        }
        function returnImport() {
            bootbox.confirm("Are you sure to cancel this import?", function(result) {
                var form = $('#import');
                if(result === true) {
                    form.attr('action', '{{route('import.return')}}');
                    form.submit();
                }
            }); 
        }
@endsection