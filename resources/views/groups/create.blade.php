@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Create Group</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('groups.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image URL</label>
                                <div class="col-md-6">
                                    <input id="image" type="url"
                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                           value="{{ old('image') }}" required>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                                    @enderror
                                </div>
                            </div>


                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
