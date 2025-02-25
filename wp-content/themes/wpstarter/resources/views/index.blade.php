@extends('layouts.app')

@section('content')

    @if (! have_posts())
        {!! get_search_form(false) !!}
    @endif

    @while(have_posts())
        @php(the_post())
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    @endwhile

    {!! get_the_posts_navigation() !!}
@endsection
