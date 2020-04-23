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

                    <h3 class="row justify-content-center">Contact Sender</h3>
                </div>
                <form action="{{ route('sendmessagehome') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Your Message</label>
                        <input type="textarea" name="content" id="content" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" />
                    </div>

                    <input type="hidden" name="idAd" id="idAd" value="{{ $_GET['idAd'] }}">

                    <input type="hidden" name="idSender" id="idSender" value="{{ $_GET['idSender'] }}">
                    <input type="hidden" name="idBuyer" id="idBuyer" value="{{ $_GET['idBuyer'] }}">
                    <div class="row justify-content-center m-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Send Message') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection