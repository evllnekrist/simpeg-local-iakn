@extends('layouts.app-enigma', ['breadcrumbs'=>[['label'=>'Statistik']]])
@section('title', 'Statistik')
@section('content')
    @php
        $style = Config::get('style');
    @endphp
    <div class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-10 pb-10 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 2xl:col-span-9">
                <div class="grid grid-cols-12 gap-6">

                    <!-- BEGIN: General Report -->
                    <div class="col-span-12">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">Jumlah Pegawai</h2>
                            <div class="ml-auto">
                                <a class="mr-5 text-primary" href="">Berdasarkan</a>
                                <select data-tw-merge="" class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 sm:mt-0 sm:w-auto">
                                    @foreach ($emp['columns'] as $item)
                                        @if(@$item['is_categorial'])
                                        <option value="{{$item['var_name']}}">{{$item['label']}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="relative mt-5 intro-y before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                            <div class="box grid grid-cols-12">
                                <div class="col-span-12 flex flex-col justify-center px-8 py-12 lg:col-span-4">
                                    
                                    <ul data-tw-merge="" role="tablist" class="flex mx-auto w-4/5 rounded-md bg-slate-100 dark:bg-black/20">
                                        <li id="pie-chart-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none flex-1">
                                            <button data-tw-merge="" data-tw-target="#pie-chart" role="tab" class="cursor-pointer block appearance-none border-transparent text-slate-700 dark:text-slate-400 [&.active]:dark:text-white rounded-md border-0 [&.active]:bg-primary [&.active]:text-white [&.active]:font-medium active w-full px-2 py-1.5">
                                                Pie
                                            </button>
                                        </li>
                                        <li id="bar-chart-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none flex-1">
                                            <button data-tw-merge="" data-tw-target="#bar-chart" role="tab" class="cursor-pointer block appearance-none border-transparent text-slate-700 dark:text-slate-400 [&.active]:dark:text-white rounded-md border-0 [&.active]:bg-primary [&.active]:text-white [&.active]:font-medium w-full px-2 py-1.5">
                                                Bar
                                            </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-6">
                                        <div data-transition="" data-selector=".active" data-enter="transition-[visibility,opacity] ease-linear duration-150" data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100" data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100" data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="pie-chart" role="tabpanel" aria-labelledby="pie-chart-tab" class="tab-pane active">
                                            <div class="relative">
                                                <div class="w-auto h-[208px]">
                                                    <canvas id="report-donut-chart" class="chart mt-3"></canvas>
                                                </div>
                                                <div class="absolute left-0 top-0 flex h-full w-full flex-col items-center justify-center">
                                                    <div class="text-2xl font-medium">2.501</div>
                                                    <div class="mt-0.5 text-slate-500">Active Users</div>
                                                </div>
                                            </div>
                                            <div class="mx-auto mt-5 w-52 sm:w-auto">
                                                <div class="flex items-center">
                                                    <div class="mr-3 h-2 w-2 rounded-full bg-primary"></div>
                                                    <span class="truncate">17 - 30 Years old</span>
                                                    <span class="ml-auto font-medium">62%</span>
                                                </div>
                                                <div class="mt-4 flex items-center">
                                                    <div class="mr-3 h-2 w-2 rounded-full bg-pending"></div>
                                                    <span class="truncate">31 - 50 Years old</span>
                                                    <span class="ml-auto font-medium">33%</span>
                                                </div>
                                                <div class="mt-4 flex items-center">
                                                    <div class="mr-3 h-2 w-2 rounded-full bg-warning"></div>
                                                    <span class="truncate">&gt;= 50 Years old</span>
                                                    <span class="ml-auto font-medium">10%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-span-12 border-t border-dashed border-slate-200 p-8 dark:border-darkmode-300 lg:col-span-8 lg:border-l lg:border-t-0">
                                    
                                    <div class="mt-2 intro-y flex h-10 items-center">
                                        <button data-tw-merge="" class="transition duration-200 border shadow-sm inline-flex py-2 px-4 w-60 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10 relative justify-start rounded-full">
                                            Download Statistik 
                                            <span class="absolute bottom-0 right-0 top-0 my-auto ml-auto mr-0.5 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white">
                                                <i data-tw-merge="" data-lucide="arrow-right" class="stroke-1.5 h-4 w-4"></i>
                                            </span>
                                        </button>
                                        <div class="ml-auto text-xs text-slate-500">
                                            * Perubahan data terakhir pada <span>-</span>
                                        </div>
                                    </div>
                                    <table class="mt-10 table-auto text-xs border-collapse">
                                        <thead>
                                            <tr class="bg-gray-100">
                                            <th class="px-2 py-1 border">Kategori</th>
                                            <th class="px-2 py-1 border">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td class="px-2 py-1 border">Cat ABC</td>
                                            <td class="px-2 py-1 border">123</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: General Report -->

                </div>
            </div>
        </div>
    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('dist/js/vendors/chartjs.js')}}"></script>
    <script src="{{asset('dist/js/utils/colors.js')}}"></script>
    <script src="{{ asset('page/js/statistic.js').'?v='.date('YmdH').'1' }}"></script>
@endsection