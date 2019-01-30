@extends('layout')

@section('content')

    <div class="card">
        <div class="card-header">
            Edit Tournament
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('tournaments.update', $tournament->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value={{ $tournament->name }}/>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <input type="text" class="form-control" name="category" value={{ $tournament->category }}/>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="begin">Begin date:</label>
                        <input type="date" class="form-control" name="begin" value={{ $tournament->begin }}/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="begin">End date:</label>
                        <input type="date" class="form-control" name="end" value={{ $tournament->end }}/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="begin">Country:</label>
                        <select class="form-control" name="country" value={{ $tournament->country }}>
                            @include('parts.selectCountries')
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="begin">City:</label>
                        <input type="text" class="form-control" name="city" value={{ $tournament->city }}/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="url" class="form-control" name="website" value={{ $tournament->website }}/>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection