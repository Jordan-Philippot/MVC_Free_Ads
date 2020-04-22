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

                    <h3 class="row justify-content-center">Find the ad that suits you </h3>
                </div>

                <div class="form-group">
                    <input type="text" name="country" id="country" placeholder="Type your search" class="form-control">
                </div>

                <select name="price" id="price" class="form-group">
                    <option value="" selected>Price</option>
                    <option value=0-200>0 - 200</option>
                    <option value="200-1000">200 - 1000</option>
                    <option value="1000-2500">1000 - 2500</option>
                    <option value="2500-5000">2500 - 5000</option>
                    <option value="5000-10000">5000 - 10 000</option>
                    <option value="10000-10000000">10 000 +</option>
                </select>

                <select name="category" id="category" class="form-group">
                    <option value="" selected>Category</option>
                    <option value="vehicles">Vehicles</option>
                    <option value="immovable">Immovable</option>
                    <option value="clothes">Clothes</option>
                    <option value="employment">Employment</option>
                    <option value="hobbies">Hobbies</option>
                    <option value="vacation">Vacation</option>
                    <option value="equipment">Equipment</option>
                    <option value="various">Various</option>
                </select>

                <select name="created_at" id="created_at" class="form-group">
                    <option value="" selected>Since</option>
                    <option value="">Ancient</option>
                    <option value="ASC">Recent</option>
                </select>

                <div id="resultsSearch"></div>

                <div class="results" id="results">
                    @foreach ($ads as $ad)
                    <div class="row justify-content-center m-4">
                        <div class="card p-4" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('images/' . $ad->picture) }}" alt="Card image cap">

                            <div class="card-body">
                                <div class="col-sm-12 m-1">
                                    <h5 class="card-title bold">{{ $ad->title }}</h5>
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
                                    <p class="card-text">Category {{ $ad->category }}</p>
                                </div>
                                <form action="" method="get">
                                    <button type="submit" class="btn btn-primary">Show ad</button>
                                </form>
                                <small><br>created at {{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $ads->links()}}

            </div>
        </div>
    </div>
</div>
@endsection