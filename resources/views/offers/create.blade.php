@extends('layouts.master')

@section('styles')
@endsection
@include('includes.header')
@section('content')
<div class="container">
    <h2 class="text-center mt-5">
        {{ __('messages.addOffer') }}
    </h2>
    @if(session()->has('success'))
        <div class="text-center alert alert-success">
            {{  session()->get('success') }}
        </div>
    @else
        @if(session()->has('success'))
            <div class="alert alert-danger">
                {{  session()->get('danger') }}
            </div>
        @endif
    @endif
    <div class="row m-5">

        <form method="POST" action="{{ isset($edit_offers) ? route('offers.update', $edit_offers->id) : route('offers.store') }}"  class="m-auto" enctype="multipart/form-data">
            @csrf
            @if(isset($edit_offers))
                @method('PUT')
            @endif
            <input type="hidden" value="{{ LaravelLocalization::getCurrentLocale() }}" name="lang">
            <div class="form-group">
                <input type="text" class="form-control" value="{{ isset($edit_offers) ? $edit_offers->name : "" }}" name="name" placeholder="add your offer name" id="">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <input type="text" class="form-control" value="{{ isset($edit_offers) ? $edit_offers->price : "" }}"   name="price" placeholder="add your price" id="">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control" value="{{ isset($edit_offers) ? $edit_offers->details : "" }}"  name="details"  placeholder="add your details" id="">
                @error('details')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="file" class="form-control"  name="image"   id="">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
@endsection
