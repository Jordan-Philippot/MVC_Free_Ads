@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!

                    @foreach ($messages as $message)
                    <div class="alert alert-success mt-4">
                        <form action="{{ route('messagehome') }}" method="GET">
                            <h4 class="mt-4">{{ $message->content }} pour l'annonce {{ getAd($message->ad) }} </h4>
                            <p>envoyé par {{ getBuyerName($message->buyer) }}</p>
                            <small><br>Sent {{ Carbon\Carbon::parse($message->created_at)->diffForHumans() }} </small>
                            <input type="hidden" name="idAd" id="idAd" value="{{ getAd($message->ad) }}">
                            <input type="hidden" name="idBuyer" id="idBuyer" value="{{ $message->buyer }}">
                            <input type="hidden" name="idSender" id="idSender" value="{{ $message->seller }}">

                            <div class="row justify-content-center m-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Message') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    @endforeach
                    {{ $messages->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection