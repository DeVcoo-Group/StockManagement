@extends('layouts.content')
@section('title','Out Coming')
@section('in-head')
<link rel="stylesheet" href="/lib/jQueryUI/jquery-ui.min.css">
@endsection
@section('content_title','Out Coming')


@section('content_body')
<div class="box box-default">
    <div class="box-header">
        <div class="col-md-2"><strong>ID: </strong> {{$out->id}}</div>
        @if (empty($out->refreturn) && !empty($out->id))
        <div class="col-md-2"><a href="javascript:returnExport()" class="btn btn-warning"> Convert to Return On Purchase</a></div>
        @elseif(!empty($out->id))
        <div class="col-md-2">
            Return ID : <a href="#">{{$out->refreturn}}</a>
        </div>
        @endif
    </div>
    <div class="box-body content">
        <form method="post" action="{{url('outcoming')}}" id="outcoming">
            <div class="form-inline">
                <div class="col-md-2  form-group">
                    <input type="hidden" name="id" value="{{$out->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="refpro" id="refpro" value="{{$out->refpro}}">

                </div>
                <div class="col-md-offset-8 col-md-2 form-group">
                    <label>Export Date</label>
                    <div class="input-group">
                        <div class="input-group-btn"><button type="button" onclick="setExportDateNow()" class="btn btn-default" tip="Now"><i class="fa fa-calendar"></i> Now</button></div>
                        @if (empty($out->id))
                        <input class="form-control" name="date" id="datemask" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" type="text" value="{{$out->date->format('Y/m/d')}}">
                        @else
                        <input class="form-control" name="date" id="datemask" disabled="disabled" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask="" type="text" value="{{$out->date->format('Y/m/d')}}">
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
                                    @if (empty($out->id))
                                    <input type="text" class="form-control" name="prod-name" id="prod-name" value="{{$out->product->name}}">
                                    @else
                                    <input type="text" class="form-control" name="prod-name" id="prod-name" disabled="disabled" value="{{$out->product->name}}">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Quatity</label>
                                @if (empty($out->id))
                                <input type="text" class="form-control" name="qty" value="{{$out->qty}}">
                                @else
                                <input type="text" class="form-control" name="qty" disabled="disabled" value="{{$out->qty}}">
                                @endif
                            </div>
                            <div class="col-md-3  form-group">
                                <label>Price</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                    @if (empty($out->id))
                                    <input type="text" class="form-control" name="price" id="price" value="{{$out->price}}">
                                    @else
                                    <input type="text" class="form-control" name="price" id="price" disabled="disabled" value="{{$out->price}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (empty($out->id))
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
        /*$('#sup-name').autocomplete({
            source: '/supplier/search',
            select: function(e,ui) {
                $("#refsup").val(ui.item.id);
                $(this).val(ui.item.name);
                return false;
            }
        });*/

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
        function setExportDateNow() {
            $("#datemask").val($.datepicker.formatDate("y/m/d", new Date()));
        }
        function returnExport() {
            bootbox.confirm("Are you sure to cancel this out flow?", function(result) {
                var form = $('#outcoming');
                if(result === true) {
                    form.attr('action', '{{route('outcoming.return')}}');
                    form.submit();
                }
            });
        }
@endsection
