@extends('layouts.app-enigma', ['breadcrumbs'=>@$page_conf['breadcrumbs']])
@section('title', 'Daftar Data')
@section('content')
    <div class="mt-5">
        @include('components.extra.table', $page_conf)
    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script>
        const pk = `{!! $page_conf['pk']?:'id' !!}`;
        const columns = JSON.parse(`{!! json_encode($page_conf['columns']) !!}`);
        const checkbox = @json(isset($page_conf['checkbox']) ? $page_conf['checkbox'] : null);
        const no_deletable_items = JSON.parse(`{!! json_encode(array_key_exists('no_deletable_items',$page_conf)?$page_conf['no_deletable_items']:[]) !!}`);
        const no_editable_items = JSON.parse(`{!! json_encode(array_key_exists('no_editable_items',$page_conf)?$page_conf['no_editable_items']:[]) !!}`);
        const importType = "{{ session('importType') }}";
    </script>
    <script src="{{asset('page/js/table.js').'?v='.date('YmdH').'1' }}"></script>
@endsection
