@extends('layouts.app-enigma', ['breadcrumbs'=>@$page_conf['breadcrumbs']])
@section('title', 'Edit')
@section('content')
    <div class="mt-5">
        @include('components.extra.form-edit', $page_conf)
    </div>
@endsection
@section('addition_css')
    <link rel="stylesheet" href="{{ asset('dist/css/vendors/tom-select.css') }}">
@endsection
@section('addition_script')
    <script>
        @if(isset($page_conf['select_type']))
            const select_type = JSON.parse(`{!! json_encode($page_conf['select_type']) !!}`);
        @endif
    </script>
    <script src="{{ asset('dist/js/vendors/tom-select.js') }}"></script>
    <script src="{{ asset('dist/js/components/base/tom-select.js') }}"></script>
    <script src="{{ asset('page/js/form.js').'?v='.date('YmdH').'1' }}"></script>
@endsection