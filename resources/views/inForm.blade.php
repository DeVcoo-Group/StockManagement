@extends('layouts.content')
@section('title','In Flow')
@section('in-head')
<link rel="stylesheet" href="/lib/jQueryUI/jquery-ui.min.css">
@endsection
@section('content_title','In Flow')


@section('content_body')
<div class="box box-default">
    <div class="box-header">
        <div class="col-md-2"><strong>ID: </strong> {{$in->id}}</div>
        @if (empty($in->refreturn)&&!empty($in->id))
        <div class="col-md-2"><a href="javascript:returnImport()" class="btn btn-warning"> Convert to Return On Purchase</a></div>
        @elseif(!empty($in->id))
        <div class="col-md-2">
            Return ID : <a href="#">{{$in->refreturn}}</a>
        </div>
        @endif
    </div>
    <div class="box-body content">
        <form id='incoming' method="post" action="{{url('incoming')}}">
            <div class="form-inline">
                <div class="col-md-2  form-group">
                    <input type="hidden" name="id" value="{{$in->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="refsup" id="refsup" value="{{$in->refsup}}">
                    <input type="hidden" name="refreturn" id="refsup" value="{{$in->refreturn}}">
                    <input type="hidden" name="refpro" id="refpro" value="{{$in->refpro}}">
                    <label>Supplier</label>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        @if (empty($in->id))
                        <input type="text" class="form-control" name="sup-name" id="sup-name" value="{{$in->supplier->name}}" >
                        @else
                        <input type="text" class="form-control" name="sup-name" disabled="disabled" id="sup-name" value="{{$in->supplier->name}}" >
                        @endif
                    </div>
                </div>
                <div class="col-md-offset-8 col-md-2 form-group">
                    <label>Import Date</label>
                    <div class="input-group">
                        <div class="input-group-btn"><button type="button" onclick="setImportDateNow()" class="btn btn-default" tip="Now"><i class="fa fa-calendar"></i> Now</button></div>
                        @if (empty($in->id))
                        <input class="form-control" name="date" id="datemask" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" type="text" value="{{$in->date->format('Y/m/d')}}">
                        @else
                        <input class="form-control" name="date" id="datemask" disabled="disabled" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" type="text" value="{{$in->date->format('Y/m/d')}}">
                        @endif
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
                                    @if (empty($in->id))
                                    <input type="text" class="form-control" name="prod-name" id="prod-name" value="{{$in->product->name}}">
                                    @else
                                    <input type="text" class="form-control" name="prod-name" id="prod-name" disabled="disabled" value="{{$in->product->name}}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quatity</label>
                                @if (empty($in->id))
                                <input type="text" class="form-control" name="qty" value="{{$in->qty}}">
                                @else
                                <input type="text" class="form-control" name="qty" disabled="disabled" value="{{$in->qty}}">
                                @endif
                            </div>
                            <div class="col-md-3  form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                    @if (empty($in->id))
                                    <input type="text" class="form-control" name="price" id="price" value="{{$in->price}}">
                                    @else
                                    <input type="text" class="form-control" name="price" id="price" disabled="disabled" value="{{$in->price}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (empty($in->id))
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
            bootbox.confirm("Are you sure to cancel this incoming?", function(result) {
                var form = $('#incoming');
                if(result === true) {
                    form.attr('action', '{{route('incoming.return')}}');
                    form.submit();
                }
            });
        }
@endsection
