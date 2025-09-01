@extends('layouts.app-enigma')
@section('title', 'Log')
@section('content')
<div class="mt-8 grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-10">
        <!-- BEGIN: Inbox Filter -->
        <div class="intro-y flex flex-col-reverse items-center sm:flex-row">
            <div class="relative mr-auto mt-3 w-full sm:mt-0 sm:w-auto">
                <i data-tw-merge="" data-lucide="search" class="stroke-1.5 absolute inset-y-0 left-0 z-10 my-auto ml-3 h-4 w-4 text-slate-500"></i>
                <input name="_search" data-tw-merge="" type="text" placeholder="Cari..." class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box px-10 sm:w-64">
                <div data-tw-merge="" data-tw-placement="bottom-start" class="dropdown absolute inset-y-0 right-0 mr-3 flex items-center"><a data-tw-toggle="dropdown" aria-expanded="false" href="javascript:;" class="cursor-pointer block h-4 w-4" role="button"><i data-tw-merge="" data-lucide="chevron-down" class="stroke-1.5 h-4 w-4 cursor-pointer text-slate-500"></i>
                    </a>
                    <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                        <div data-tw-merge="" class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 !-ml-[228px] mt-2.5 w-[478px] pt-2">
                            <div class="grid grid-cols-12 gap-4 gap-y-3 p-3">
                                <div class="col-span-6">
                                    <label data-tw-merge="" for="input-filter-1" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs">
                                        From
                                    </label>
                                    <input data-tw-merge="" id="input-filter-1" type="text" placeholder="example@gmail.com" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <label data-tw-merge="" for="input-filter-2" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs">
                                        To
                                    </label>
                                    <input data-tw-merge="" id="input-filter-2" type="text" placeholder="example@gmail.com" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <label data-tw-merge="" for="input-filter-3" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs">
                                        Subject
                                    </label>
                                    <input data-tw-merge="" id="input-filter-3" type="text" placeholder="Important Meeting" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <label data-tw-merge="" for="input-filter-4" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs">
                                        Has the Words
                                    </label>
                                    <input data-tw-merge="" id="input-filter-4" type="text" placeholder="Job, Work, Documentation" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <label data-tw-merge="" for="input-filter-5" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs">
                                        Doesn't Have
                                    </label>
                                    <input data-tw-merge="" id="input-filter-5" type="text" placeholder="Job, Work, Documentation" class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 flex-1">
                                </div>
                                <div class="col-span-6">
                                    <label data-tw-merge="" for="input-filter-6" class="inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right text-xs">
                                        Size
                                    </label>
                                    <select data-tw-merge="" id="input-filter-6" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 flex-1">
                                        <option>10</option>
                                        <option>25</option>
                                        <option>35</option>
                                        <option>50</option>
                                    </select>
                                </div>
                                <div class="col-span-12 mt-3 flex items-center">
                                    <button data-tw-merge="" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-secondary/70 border-secondary/70 text-slate-500 dark:border-darkmode-400 dark:bg-darkmode-400 dark:text-slate-300 [&:hover:not(:disabled)]:bg-slate-100 [&:hover:not(:disabled)]:border-slate-100 [&:hover:not(:disabled)]:dark:border-darkmode-300/80 [&:hover:not(:disabled)]:dark:bg-darkmode-300/80 ml-auto w-32">Create Filter</button>
                                    <button data-tw-merge="" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary ml-2 w-32">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full sm:w-auto">
                <span class="text-end font-bold">Log Aplikasi</span>
            </div>
        </div>
        <!-- END: Inbox Filter -->
        <!-- BEGIN: Inbox Content -->
        <div class="intro-y box mt-5">
            <div class="flex flex-col-reverse border-b border-slate-200/60 p-5 text-slate-500 sm:flex-row">
                <div class="-mx-5 mt-3 flex items-center border-t border-slate-200/60 px-5 pt-5 sm:mx-0 sm:mt-0 sm:border-0 sm:px-0 sm:pt-0">
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" href="#" onclick="getData()">
                        <i data-tw-merge="" data-lucide="refresh-cw" class="stroke-1.5 h-4 w-4"></i>
                    </a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="_limit" onchange="getData()" data-tw-merge="" class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 w-20 sm:mt-0">
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="flex items-center sm:ml-auto">
                    <div class="">
                        <span id="products_count_start">0</span> - <span id="products_count_end">0</span>
                        dari <span id="products_count_total">0</span> data
                    </div>
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" onclick="getDataByOp(-1)">
                        <i data-tw-merge="" data-lucide="chevron-left" class="stroke-1.5 h-4 w-4"></i>
                    </a>
                    <input name="_page" value="1" class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50
                    [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out
                    text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary
                    focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1
                    !box mt-3 w-20 sm:mt-0" type="number" onchange="getData()">
                    <a class="ml-5 flex h-5 w-5 items-center justify-center" onclick="getDataByOp(+1)">
                        <i data-tw-merge="" data-lucide="chevron-right" class="stroke-1.5 h-4 w-4"></i>
                    </a>
                </div>
            </div>
            <div data-tw-merge class="overflow-x-auto sm:overflow-x-visible accordion" id="data-list">
                <div class="intro-y thead-item">
                    <div class="inline-block sm:block border-b border-slate-200/60 dark:border-darkmode-400 bg-primary text-white font-medium">
                        <div class="flex px-5 py-3">
                            <div class="mr-5 w-1/4">
                                Subject
                            </div>
                            <div class="mr-5 w-1/2">
                                Request
                            </div>
                            <div class="mr-5 w-1/2">
                                Response
                            </div>
                            <div class="w-1/4 text-right">
                                Oleh/Waktu
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tbody-item transition duration-200 ease-in-out transform cursor-pointer inline-block sm:block border-b border-slate-200/60 dark:border-darkmode-400 hover:scale-[1.02] hover:relative hover:z-20 hover:shadow-md hover:border-0 hover:rounded bg-white text-slate-800 dark:text-slate-300 dark:bg-darkmode-600">
                    <img src="{{asset('image/loading.gif')}}" class="mx-auto">
                </div>
            </div>
            <div class="flex flex-col items-center p-5 text-center text-slate-500 sm:flex-row sm:text-left">
                <div></div>
                <div class="mt-2 sm:ml-auto sm:mt-0">
                    Aktifitas terakhir yang dicatat: <span id="last_time_count">0</span> menit yang lalu
                </div>
            </div>
        </div>
        <!-- END: Inbox Content -->
    </div>
</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{ asset('page/js/log.js').'?v='.date('YmdH').'1' }}"></script>
@endsection