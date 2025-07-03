@extends('layouts.app-enigma')
@section('title', 'Dashboard')
@section('content')

<div class="h-screen flex items-center justify-center dark:bg-warning" id="gif-influenced-color-sceme">
</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
  <script>
    influencedColorScheme()
  </script>
@endsection