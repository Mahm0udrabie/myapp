@extends('layouts.master')

@section('styles')
@endsection
@include('includes.header')
@section('content')
        <div id="msg" class="text-center alert alert-success" style="display: none">
        </div>
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
            <tr class="offerRow{{$offer->id}}">
                <th scope="row">{{ $offer->id }}</th>
                <td>
                    <img src="{{ asset('images/offers/'.$offer->image) }}" alt="Image" width="100" height="100">
                </td>
                <td>{{ $offer->name }}</td>
                <td>{{ $offer->price }}</td>
                <td>{{ $offer->details }}</td>
                <td>
                    <a href="{{ route('ajax.offers.edit', $offer->id) }}" class="btn btn-primary">
                        {{ __('messages.edit') }}
                    </a>
                    <a href="" offer_id="{{$offer->id}}" class="delete_btn btn btn-danger">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();
            let offer_id  = $(this).attr('offer_id');
            $.ajax({
                type:'post',
                url:"{{ route('ajax.offers.delete') }}",
                data: {
                  '_token':"{{csrf_token()}}",
                    'id':  offer_id
                },

                success: function (data) {
                    if(data.status == true) {
                        let str = data.msg;
                        $('<p>'+str+'</p>').appendTo('#msg');
                        $('#msg').show();
                        $('.offerRow'+data.id).remove();
                    }
                }, error: function(reject) {
                    console.log('error');
                }
            });
        });
    </script>
@endsection

