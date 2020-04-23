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

                    <h3 class="row justify-content-center">Your new ad</h3>
                </div>
                <form action="{{ route('newannonces') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" />
                    <!-- @if ($errors->has('title'))
                    <span class="invalid-feedback"> {{ $errors->first('title') }} <span>
                            @endif<br> -->
                    <label for="content">Description</label>
                    <input type="textarea" name="content" id="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}">
                    <!-- @if ($errors->has('content'))
                            <span class="invalid-feedback"> {{ $errors->first('content') }} <span>
                                    @endif<br> -->
                    <label for="picture">Pictures</label>
                    <input type="file" name="picture" id="picture" class="form-control {{ $errors->has('picture') ? 'is-invalid' : '' }} ">
                    <!-- @if ($errors->has('picture'))
                                    <span class="invalid-feedback"> {{ $errors->first('picture') }} <span>
                                            @endif<br> -->
                    <label for="price">Price</label>
                    <input type="int" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}">
                    <!-- @if ($errors->has('price'))
                                            <span class="invalid-feedback"> {{ $errors->first('price') }} <span>
                                                    @endif<br> -->
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}">
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

                    <!-- @if ($errors->has('category'))
                    <span class="invalid-feedback"> {{ $errors->first('category') }} <span>
                            @endif<br> -->
                    <label for="localisation">City</label>
                    <input type="text" name="localisation" id="localisation" class="form-control {{ $errors->has('localisation') ? 'is-invalid' : '' }}">
                    <!-- @if ($errors->has('localisation'))
                    <span class="invalid-feedback"> {{ $errors->first('localisation') }} <span>
                            @endif<br> -->
                    <div class="row justify-content-center m-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection