@extends('layouts.master')

@section('styles')
@endsection
@include('includes.header')
@section('content')

    <h2 class="text-center mt-5">Add your offer</h2>

    <div class="row m-5">

        <form action="{{ route('offers.store') }}" method="post" class="m-auto">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="add your offer name" id="">
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" class="form-control"  name="price" placeholder="add your price" id="">
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" class="form-control"  name="details"  placeholder="add your details" id="">
                @error('details')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
