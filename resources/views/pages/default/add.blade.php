@extends('layouts.app-helendo')
@section('title', 'Tambah')
@section('content')
    @include('components.helendo.breadcrumb', ['breadcrumbs'=>@$page_conf['breadcrumbs']])
    @include('components.extra.form-add', $page_conf)
@endsection
@section('addition_css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
@endsection
@section('addition_script')
    <script>
        @if(isset($page_conf['select_type']))
            const select_type = JSON.parse(`{!! json_encode($page_conf['select_type']) !!}`);
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{asset('page/js/form.js').'?v='.date('YmdH').'1' }}"></script>
@endsection