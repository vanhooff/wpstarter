@extends('layouts.app')

@section('content')

  @if (! have_posts())

      {!! __('Sorry, no results were found.', 'sage') !!}

  @endif

  @while(have_posts()) @php(the_post())
    @include('partials.content-search')
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection
