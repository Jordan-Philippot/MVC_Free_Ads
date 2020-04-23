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

                    <h3 class="row justify-content-center">Your Ads</h3>
                </div>


                <form action="{{ route('createannonces') }}" method="get">
                    @csrf
                    <div class="row justify-content-center m-4">
                        <button type="submit" class="btn btn-success">
                            {{ __('Create New Ad') }}
                        </button>
                    </div>
                </form>

                @foreach ($ads as $ad)

                <div class="container row justify-content-center m-4">
                    <form action="{{ route('showcontact') }}" method="GET">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $ad->id }}">
                        <div class="card p-4" style="width: 18rem;">

                            <img class="card-img-top" src="{{ asset('images/' . $ad->picture) }}" id="bannerImg" alt="Card image cap">
                            <div class="card-body row justify-content-center">
                                <div class="col-sm-12 m-1">
                                    <h5 class="card-title">{{ $ad->title }}</h5>
                                </div>
                                <div class="col-sm-12 m-1">
                                    <p class="card-text">{{ $ad->content }}</p>
                                </div>
                                <div class="col-sm-12 m-1">
                                    <p class="card-text text-info">In {{ $ad->localisation }}</p>
                                </div>
                                <div class="col-sm-12 m-1">
                                    <p class="card-text">{{ $ad->price }} $</p>
                                </div>
                                <div class="col-sm-12 m-1">
                                    <p class="card-text">Category : {{ $ad->category }} </p>
                                </div>
                                <small><br>created at {{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                            </div>
                    </form>
                    <form action="{{ route('editannonces') }}" method="GET">
                        @csrf
                        <div class="row justify-content-center m-2">
                            <input type="hidden" name="id" id="id" value="{{ $ad->id }}">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                    <div class="row justify-content-center m-2">
                        <form action="{{ route('deleteannonces') }}" method="GET">
                            <input type="hidden" name="id" id="id" value="{{ $ad->id }}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                        </form>
                    </div>


                </div>
            </div>
            @endforeach
            {{ $ads->links()}}


        </div>
    </div>
</div>
</div>
@endsection