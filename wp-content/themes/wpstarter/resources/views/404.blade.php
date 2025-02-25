@extends('layouts.app')

@section('content')

    @if (! have_posts())
        404
    @endif

@endsection
