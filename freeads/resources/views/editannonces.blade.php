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

                    <h3 class="row justify-content-center">Update your ad</h3>
                </div>
                <form action="{{ route('updateannonces') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $_GET['id'] }}">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control"><br>
                    <label for="content">Description</label>
                    <input type="text" name="content" id="content" class="form-control"><br>
                    <label for="picture">Picture</label>
                    <input type="file" name="picture" id="picture" class="form-control"><br>
                    <label for="price">Price</label>
                    <input type="int" name="price" id="price" class="form-control"><br>
                    <label for="localisation">Localisation</label>
                    <input type="text" name="localisation" id="localisation" class="form-control"><br>
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="" selected>Category</option>
                        <option value="vehicles">Vehicles</option>
                        <option value="immovable">Immovable</option>
                        <option value="clothes">Clothes</option>
                        <option value="employment">Employment</option>
                        <option value="hobbies">Hobbies</option>
                        <option value="vacation">Vacation</option>
                        <option value="equipment">Equipment</option>
                        <option value="various">Various</option>
                    </select><br>
                    <div class="row justify-content-center m-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>

                <div class="row justify-content-center m-2">
                    <form action="{{ route('deleteannonces') }}" method="get">
                        <button type="submit" class="btn btn-danger"> {{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection