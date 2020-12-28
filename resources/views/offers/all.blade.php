@extends('layouts.master')

@section('styles')
@endsection
@include('includes.header')
@section('content')
    @if(session()->has('success'))
        <div class="text-center alert alert-success">
            {{  session()->get('success') }}
        </div>
    @else
        @if(session()->has('danger'))
            <div class="text-center alert alert-danger">
                {{  session()->get('danger') }}
            </div>
        @endif
    @endif
    @if(count($offers) > 0)
        <h2 class="text-center m-5">
            {{ __('messages.offers') }}
        </h2>
    <div class="row m-5 ">
            <table class="table table-dark " style="direction : {{ __('messages.direction')  }}">
            <thead>
            <tr>
                <th scope="col">{{__('messages.id')}}</th>
                <th scope="col">{{__('messages.image')}}</th>
                <th scope="col">{{__("messages.name")}}</th>
                <th scope="col">{{__("messages.price")}}</th>
                <th scope="col">{{__("messages.details")}}</th>
                <th scope="col">{{__('messages.operations')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
            <tr>
                <th scope="row">{{ $offer->id }}</th>
                <td>
                    <img src="{{ asset('offers/images/'.$offer->image) }}" alt="Image" width="100" height="100">
                </td>
                <td>{{ $offer->name }}</td>
                <td>{{ $offer->price }}</td>
                <td>{{ $offer->details }}</td>
                <td>
                    <a href="{{ route('offers.edit', $offer->id) }}" class="btn btn-primary">
                        {{ __('messages.edit') }}
                    </a>
                    <a href="{{ route('offers.delete', $offer->id) }}" class="btn btn-danger">
                        {{ __('messages.delete') }}
                    </a>
                </td>

            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    @else
        <h2 class="text-center m-5">
            {{ __('messages.ifOffers') }}
        <h2>
    @endif
@endsection

@section('scripts')
@endsection
