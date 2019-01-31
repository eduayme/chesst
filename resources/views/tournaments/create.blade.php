@extends('layout')

@section('title', 'Create Tournament')

@section('content')

    <div class="card">

        <div class="card-header">
            Create Tournament
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <form method="post" action="{{ route('tournaments.store') }}"
                  oninput="category.value = standard.value +'min + '+ increment.value +'sec' ">

                <div class="form-group">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>
                <div class="form-group">
                    <label for="category">Time Control:</label>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-3">
                                <input type="number" class="form-control" placeholder="Standard time" name="standard">
                            </div>
                            <div class="col-2">
                                <h3> min </h3>
                            </div>
                            <div class="col-2">
                                <h2 style="text-align: center"> + </h2>
                            </div>
                            <div class="col-3">
                                <input type="number" class="form-control" placeholder="Increment" name="increment">
                            </div>
                            <div class="col-2">
                                <h3> sec </h3>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="category"/>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="begin"> Begin date: </label>
                        <input type="date" class="form-control" name="begin" id="begin"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="end"> End date: </label>
                        <input type="date" class="form-control" name="end" id="end"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="begin">Country:</label>
                        <select class="form-control" name="country">
                            @include('parts.selectCountries')
                        </select>
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="begin">City:</label>
                        <input type="text" class="form-control" name="city"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="url" class="form-control" name="website"/>
                </div>
                <button type="submit" class="btn btn-primary">Create Tournament</button>

            </form>

        </div>

    </div>

@endsection
