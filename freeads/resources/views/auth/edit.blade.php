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

                    <h3 class="row justify-content-center">Your edit profil</h3>
                </div>
                <form action="{{ route('update') }}" method="GET">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ Auth::user()->name }}" class="form-control"><br>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control"><br>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="" class="form-control">
                    <div class="row justify-content-center m-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
                <div class="row justify-content-center m-2">
                    <form action="{{ route('delete') }}" method="get">
                        <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection