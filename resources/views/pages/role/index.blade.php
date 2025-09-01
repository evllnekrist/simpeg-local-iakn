@extends('layouts.app-enigma', ['breadcrumbs'=>[['label'=>'Kelola Akses'],['label'=>'Data']]])
@section('title', 'Kelola Akses')
@section('content')
    {{-- <h2 class="intro-y mt-10 text-lg font-medium">Kelola Akses</h2> --}}
    <!-- @php
        echo "<br>_______________________PRINT_R____<br>";
        dump($is_deletable);
        echo "<br>_______________________PRINT_R____<br>";
    @endphp -->
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center sm:flex-nowrap">
            <a href="{{route('role.add')}}" data-tw-merge="" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">Tambah Baru</a>
            <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative">
                <button data-tw-merge="" data-tw-toggle="dropdown" aria-expanded="false" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed !box px-2">
                    <span class="flex h-5 w-5 items-center justify-center">
                        <i data-tw-merge="" data-lucide="plus" class="stroke-1.5 h-4 w-4"></i>
                    </span>
                </button>
                <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                    <div data-tw-merge="" class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 w-40">
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i data-tw-merge="" data-lucide="file-text" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Ekspor ke
                            CSV</a>
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item"><i data-tw-merge="" data-lucide="file-text" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Ekspor ke
                            PDF</a>
                        </div>
                    </div>
            </div>
            <div class="mx-auto hidden text-slate-500 md:block">
                <center>
                     Menampilkan <span id="products_count_start"></span> - <span id="products_count_end"></span><br>dari <span id="products_count_total"></span> data<br>
                     <input name="_page" value="1" class="_filter" hidden>
                     @if(@$is_deletable)
                     <input name="is_deletable" value="{{json_encode($is_deletable)}}" hidden>
                     @endif
                 </center>
            </div>
            <div class="mt-3 w-full sm:ml-auto sm:mt-0 sm:w-auto md:ml-0">
                <div class="relative w-56 text-slate-500">
                    <input name="_search" data-tw-merge="" type="text" placeholder="Cari..." title="isi kemudian enter untuk melakukan pencarian" class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-300/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box w-56 pr-10">
                    <i onclick="getData()" data-tw-merge="" data-lucide="search" class="stroke-1.5 absolute inset-y-0 right-0 my-auto mr-3 h-4 w-4"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Users Layout -->            
    <div class="mt-5 grid grid-cols-12 gap-6" id="data-list">
        <div class="col-span-12"><img src="{{asset('image/loading.gif')}}" class="mx-auto"></div>
    </div>
    <!-- BEGIN: Users Layout -->
    <!-- BEGIN: Pagination -->            
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
            <nav class="w-full sm:mr-auto sm:w-auto">
                <ul class="flex w-full mr-0 sm:mr-auto sm:w-auto" id="data-list-pagination"></ul>
            </nav>
            <select name="_limit" onchange="getData()" data-tw-merge="" class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 w-20 sm:mt-0">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="all">Semua</option>
            </select>
        </div>
    </div>
    <!-- END: Pagination -->
    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{ asset('page/js/role-index.js').'?v='.date('YmdH').'1' }}"></script>
@endsection