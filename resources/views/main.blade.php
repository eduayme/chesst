@extends('layout')

@section('title', 'Home')

@section('content')

    <!-- Alerts -->
    @if( session()->get('success') )
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div><br/>
    @elseif( session()->get('error') )
        <div class="alert alert-error alert-dismissible fade show" role="alert">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('error') }}
        </div><br/>
    @endif

    <a style="background-color:black;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:12px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px" href="https://unsplash.com/@mitchazj?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from Mitchell Johnson"><span style="display:inline-block;padding:2px 3px"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-2px;fill:white" viewBox="0 0 32 32"><title>unsplash-logo</title><path d="M10 9V0h12v9H10zm12 5h10v18H0V14h10v9h12v-9z"></path></svg></span><span style="display:inline-block;padding:2px 3px">Mitchell Johnson</span></a>

    <div class="text-center">
        <h1 class="card-title"> Welcome to ChessT </h1>
        <p class="card-text"> The best place to find all chess tournaments </p>
        <a href="../tournaments" class="btn btn-outline-primary" role="button">Find Tournaments</a>
        <a href="../tournaments/create" class="btn btn-outline-secondary" role="button">Create Tournament</a>
    </div>

@endsection
