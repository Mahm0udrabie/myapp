@extends('layouts.master')
@section('styles')
@endsection
@include('includes.header')
@section('content')
<div class="container">
    <h2 class="text-center mt-5">
        {{ __('messages.addOffer') }}
    </h2>
    <div class="alert alert-success" id="msg" style="display: none"></div>
    <div class="row m-5">

        <form  id="form_data" class="m-auto" >
            @csrf
            <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang">
            <div class="form-group">
                <input type="text" class="form-control"value="{{ isset($edit_offers) ? $edit_offers->name : "" }}" name="name" placeholder="add your offer name" id="">
                <small id="name_error" class="form-text text-danger"></small>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" value="{{ isset($edit_offers) ? $edit_offers->price : "" }}"   name="price" placeholder="add your price" id="">
                <small id="price_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  value="{{ isset($edit_offers) ? $edit_offers->details : "" }}" name="details"  placeholder="add your details" id="">
                <small id="details_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <input type="file" class="form-control"  name="image"   id="">
                <small id="image_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <button id="save_offer" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();
            let arr = ['name_error', 'price_error', 'details_error', 'image_error'];
            arr.forEach(function (e) {
                document.querySelector("#"+e).innerHTML = "";
            });
            let formData = new FormData($('#form_data')[0]);
            $.ajax({
                type:"post",
                enctype:"multipart/form-data",
                url:"{{ isset($edit_offers) ? route('ajax.offers.update', $edit_offers->id) : route('ajax.offers.store') }}",
                data: formData,
                processData:false,
                contentType:false,
                success: function (data) {
                    if(data.status == true) {
                        let str = data.msg;
                        $('<p>'+str+'</p>').appendTo('#msg');
                        $('#msg').show();
                    }
                }, error: function(reject) {
                    let response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                       $('#'+key+"_error").text(val[0]);
                    });
                }
            });
        });
    </script>
@endsection
