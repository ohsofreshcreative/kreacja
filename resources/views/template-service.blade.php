{{--
  Template Name: Obsługa klienta
--}}

@extends('layouts.app')

@section('content')
  @php($hasSidebar = is_active_sidebar('page-sidebar'))

  <div class="c-main grid grid-cols-1 md:grid-cols-[1fr_2fr] gap-8 pt-20">

    @if ($hasSidebar)
      @include('partials.sidebar')
    @endif

    {{-- Główna treść strony --}}
    <main class="c-content">
      @while(have_posts()) @php(the_post())
        <h2 class="">{{ get_the_title() }}</h2>

        @php(the_content())
      @endwhile
    </main>

  </div>
@endsection