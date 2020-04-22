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

                    <h3 class="row justify-content-center">Your profile</h3>
                </div>
                <div class="row justify-content-center">
                    <h6 class="col-10"> Name : {{ Auth::user()->name }}</h6>
                    <h6 class="col-10">email : {{ Auth::user()->email }}</h6>
                    <h6 class="col-10">password (crypt) :{{ Auth::user()->password }}</h6>
                </div>
                <div class="form-group row mb-0 row justify-content-center">
                    <div class="col-md-6 offset-md-4">
                        <form action="{{ route('edit') }}" method="get">
                            <button type="submit" class="btn btn-primary m-4">
                                {{ __('Edit') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection