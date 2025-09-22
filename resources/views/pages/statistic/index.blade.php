@extends('layouts.app-enigma', ['breadcrumbs'=>[['label'=>'Statistik']]])
@section('title', 'Statistik')
@section('content')
    @php
        $style = Config::get('style');
    @endphp
    <textarea id="emp_properties" style="display: none;">{{json_encode($emp)}}</textarea>
    <div class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-10 pb-10 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 2xl:col-span-11">
                <div class="grid grid-cols-12 gap-6">

                    <!-- BEGIN: Employee By Count -->
                    <div class="col-span-12">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">Jumlah Pegawai</h2>
                            <div class="ml-auto">
                                <a class="mr-5 text-primary" href="">Berdasarkan</a>
                                <select name="emp_bycount_var" onchange="getByCountEmployee()" data-tw-merge="" 
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 sm:mt-0 sm:w-auto">
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
                                <div class="col-span-12 flex flex-col px-8 py-12 md:col-span-6 xl2:col-span-4">
                                    
                                    <ul role="tablist" class="flex mx-auto w-4/5 rounded-md bg-slate-100 dark:bg-black/20">
                                        <li role="presentation" class="focus-visible:outline-none flex-1">
                                            <button
                                            id="donut-chart-tab"
                                            data-tw-toggle="tab"
                                            data-tw-target="#donut-chart"
                                            role="tab"
                                            aria-controls="donut-chart"
                                            aria-selected="true"
                                            class="cursor-pointer block appearance-none border-transparent text-slate-700 dark:text-slate-400
                                                    [&.active]:dark:text-white rounded-md border-0 [&.active]:bg-primary [&.active]:text-white
                                                    [&.active]:font-medium w-full px-2 py-1.5">
                                            Donut
                                            </button>
                                        </li>
                                        <li role="presentation" class="focus-visible:outline-none flex-1">
                                            <button
                                            id="bar-chart-tab"
                                            data-tw-toggle="tab"
                                            data-tw-target="#bar-chart"
                                            role="tab"
                                            aria-controls="bar-chart"
                                            aria-selected="false"
                                            class="cursor-pointer block appearance-none border-transparent text-slate-700 dark:text-slate-400
                                                    [&.active]:dark:text-white rounded-md border-0 [&.active]:bg-primary [&.active]:text-white
                                                    [&.active]:font-medium w-full px-2 py-1.5 active ">
                                            Bar
                                            </button>
                                        </li>
                                    </ul>

                                    <div class="tab-content mt-6">
                                        <div
                                            id="donut-chart"
                                            role="tabpanel"
                                            aria-labelledby="donut-chart-tab"
                                            class="tab-pane"
                                            data-transition
                                            data-selector=".active"
                                            data-enter="transition-[visibility,opacity] ease-linear duration-150"
                                            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0"
                                            data-enter-to="visible opacity-100"
                                            data-leave="transition-[visibility,opacity] ease-linear duration-150"
                                            data-leave-from="visible opacity-100"
                                            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0"
                                        >
                                            <div class="relative">
                                                <div class="w-auto" id="emp_bycount_chart_donut_outer">
                                                    <canvas id="emp_bycount_chart_donut" class="chart mt-3"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            id="bar-chart"
                                            role="tabpanel"
                                            aria-labelledby="bar-chart-tab"
                                            class="tab-pane active"
                                            data-transition
                                            data-selector=".active"
                                            data-enter="transition-[visibility,opacity] ease-linear duration-150"
                                            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0"
                                            data-enter-to="visible opacity-100"
                                            data-leave="transition-[visibility,opacity] ease-linear duration-150"
                                            data-leave-from="visible opacity-100"
                                            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0"
                                        >
                                            <div class="relative">
                                                <div class="w-auto" id="emp_bycount_chart_bar_outer">
                                                    <canvas id="emp_bycount_chart_bar" class="chart mt-3"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mx-auto mt-5 w-52 sm:w-auto" id="emp_bycount_chart_label"></div>

                                </div>
                                <div class="col-span-12 border-t border-dashed border-slate-200 p-8 dark:border-darkmode-300 md:col-span-6 xl2:col-span-8 md:border-l md:border-t-0">
                                    
                                    <div class="mt-2 intro-y flex h-10 items-center">
                                        <button id="emp_bycount_download" data-tw-merge="" class="transition duration-200 border shadow-sm inline-flex py-2 px-4 w-60 font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10 relative justify-start rounded-full">
                                            Download Statistik 
                                            <span class="absolute bottom-0 right-0 top-0 my-auto ml-auto mr-0.5 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-white">
                                                <i data-tw-merge="" data-lucide="arrow-right" class="stroke-1.5 h-4 w-4"></i>
                                            </span>
                                        </button>
                                        <small class="ml-auto text-slate-500 text-right">
                                            * Perubahan data terakhir pada<br><span id="emp_bycount_last_activity">-</span>
                                        </small>
                                    </div>
                                    <table class="mt-10 table-auto text-xs border-collapse" id="emp_bycount_table">
                                        <thead class="text-center">
                                            <tr class="bg-gray-100">
                                            <th class="px-2 py-1 border">Kategori</th>
                                            <th class="px-2 py-1 border">Jumlah</th>
                                            <td class="px-2 py-1 border">
                                                <b>Persentasi </b><br>
                                                <small>dari data yang ada </small><br>
                                                (<span class="emp_bycount_total"></span>)
                                            </td>
                                            <td class="px-2 py-1 border">
                                                <b>Persentasi </b><br>
                                                <small>dari seluruh pegawai </small><br>
                                                (<span class="emp_bycount_target"></span>)
                                            </td>
                                            </tr>
                                        </thead>
                                        <tbody id="emp_bycount_table_content"></tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END:   Employee By Count -->

                    <!-- BEGIN: Position Map -->
                    <div class="col-span-12 mt-20">
                        <div class="intro-y flex h-10 items-center">
                            <h2 class="mr-5 truncate text-lg font-medium">Peta Jabatan</h2>
                            <div class="ml-auto">
                                <div>
                                    <ul data-tw-merge role="tablist" class="border-b border-slate-200 dark:border-darkmode-400 w-full flex text-xs">
                                        <li id="org_chart_display-tab" data-tw-merge role="presentation" class="focus-visible:outline-none flex-1 -mb-px">
                                            <button data-tw-merge data-tw-target="#org_chart_display" role="tab"
                                                class="cursor-pointer block appearance-none px-5 py-2.5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white block border-transparent rounded-t-md dark:border-transparent [&.active]:bg-white [&.active]:border-slate-200 [&.active]:border-b-transparent [&.active]:font-medium [&.active]:dark:bg-transparent [&.active]:dark:border-t-darkmode-400 [&.active]:dark:border-b-darkmode-600 [&.active]:dark:border-x-darkmode-400 [&:not(.active)]:hover:bg-slate-100 [&:not(.active)]:dark:hover:bg-darkmode-400 [&:not(.active)]:dark:hover:border-transparent active w-full py-2">Tampilan</button>
                                        </li>
                                        <li id="org_chart_layout-tab" data-tw-merge role="presentation" class="focus-visible:outline-none flex-1 -mb-px">
                                            <button data-tw-merge data-tw-target="#org_chart_layout" role="tab"
                                                class="cursor-pointer block appearance-none px-5 py-2.5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white block border-transparent rounded-t-md dark:border-transparent [&.active]:bg-white [&.active]:border-slate-200 [&.active]:border-b-transparent [&.active]:font-medium [&.active]:dark:bg-transparent [&.active]:dark:border-t-darkmode-400 [&.active]:dark:border-b-darkmode-600 [&.active]:dark:border-x-darkmode-400 [&:not(.active)]:hover:bg-slate-100 [&:not(.active)]:dark:hover:bg-darkmode-400 [&:not(.active)]:dark:hover:border-transparent w-full py-2">Layout</button>
                                        </li>
                                        <li id="org_chart_export-tab" data-tw-merge role="presentation" class="focus-visible:outline-none flex-1 -mb-px">
                                            <button data-tw-merge data-tw-target="#org_chart_export" role="tab"
                                                class="cursor-pointer block appearance-none px-5 py-2.5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white block border-transparent rounded-t-md dark:border-transparent [&.active]:bg-white [&.active]:border-slate-200 [&.active]:border-b-transparent [&.active]:font-medium [&.active]:dark:bg-transparent [&.active]:dark:border-t-darkmode-400 [&.active]:dark:border-b-darkmode-600 [&.active]:dark:border-x-darkmode-400 [&:not(.active)]:hover:bg-slate-100 [&:not(.active)]:dark:hover:bg-darkmode-400 [&:not(.active)]:dark:hover:border-transparent w-full py-2">Ekspor</button>
                                        </li>
                                        <li id="org_chart_action-tab" data-tw-merge role="presentation" class="focus-visible:outline-none flex-1 -mb-px">
                                            <button data-tw-merge data-tw-target="#org_chart_action" role="tab"
                                                class="cursor-pointer block appearance-none px-5 py-2.5 border border-transparent text-slate-700 dark:text-slate-400 [&.active]:text-slate-800 [&.active]:dark:text-white block border-transparent rounded-t-md dark:border-transparent [&.active]:bg-white [&.active]:border-slate-200 [&.active]:border-b-transparent [&.active]:font-medium [&.active]:dark:bg-transparent [&.active]:dark:border-t-darkmode-400 [&.active]:dark:border-b-darkmode-600 [&.active]:dark:border-x-darkmode-400 [&:not(.active)]:hover:bg-slate-100 [&:not(.active)]:dark:hover:bg-darkmode-400 [&:not(.active)]:dark:hover:border-transparent w-full py-2">Aksi</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content border-t">
                                        <div data-transition data-selector=".active"
                                            data-enter="transition-[visibility,opacity] ease-linear duration-150"
                                            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100"
                                            data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100"
                                            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="org_chart_display" role="tabpanel"
                                            aria-labelledby="org_chart_display-tab" class="tab-pane active p-5 leading-relaxed">
                                                <button class="{{$style['btn-xs-grey']}}" id="expandAllBtn"><i class="fas fa-expand-arrows-alt mr-2"></i>Expand All</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="collapseAllBtn"><i class="fas fa-compress-arrows-alt mr-2"></i>Collapse All</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="zoomInBtn"><i class="fas fa-search-plus mr-2"></i>Zoom In</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="zoomOutBtn"><i class="fas fa-search-minus mr-2"></i>Zoom Out</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="fitBtn"><i class="fas fa-expand mr-2"></i>Fit</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="fsBtn"><i class="fas fa-desktop mr-2"></i>Fullscreen</button>
                                        </div>
                                        <div data-transition data-selector=".active"
                                            data-enter="transition-[visibility,opacity] ease-linear duration-150"
                                            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100"
                                            data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100"
                                            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="org_chart_layout" role="tabpanel"
                                            aria-labelledby="org_chart_layout-tab" class="tab-pane p-5 leading-relaxed">
                                                <button class="{{$style['btn-xs-grey']}}" id="layoutRight"><i class="fas fa-arrow-right mr-2"></i>Right</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="layoutTop"><i class="fas fa-arrow-up mr-2"></i>Top</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="layoutLeft"><i class="fas fa-arrow-left mr-2"></i>Left</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="layoutBottom"><i class="fas fa-arrow-down mr-2"></i>Bottom</button>
                                        </div>
                                        <div data-transition data-selector=".active"
                                            data-enter="transition-[visibility,opacity] ease-linear duration-150"
                                            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100"
                                            data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100"
                                            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="org_chart_export" role="tabpanel"
                                            aria-labelledby="org_chart_export-tab" class="tab-pane p-5 leading-relaxed">
                                                <button class="{{$style['btn-xs-grey']}}" id="org_chart_xlsx_btn"><i class="fas fa-file-excel mr-2"></i>Excel</button>
                                                <button class="{{$style['btn-xs-grey']}}" id="org_chart_png_btn"><i class="fas fa-image mr-2"></i>Gambar</button>
                                        </div>
                                        <div data-transition data-selector=".active"
                                            data-enter="transition-[visibility,opacity] ease-linear duration-150"
                                            data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" data-enter-to="visible opacity-100"
                                            data-leave="transition-[visibility,opacity] ease-linear duration-150" data-leave-from="visible opacity-100"
                                            data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" id="org_chart_action" role="tabpanel"
                                            aria-labelledby="org_chart_action-tab" class="tab-pane p-5 leading-relaxed">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative mt-5 intro-y before:box before:absolute before:inset-x-3 before:mt-3 before:h-full before:bg-slate-50 before:content-['']">
                            <div class="box grid grid-cols-12">
                                <div class="col-span-12 flex flex-col justify-center px-8 py-12">
                                    <div id="org_chart" class="bg-slate-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END:   Position Map -->

                </div>
            </div>
        </div>
    </div>
@endsection
@section('addition_css')
    <style>
        #org_chart { width:100%; height:calc(100vh - 48px); }
    </style>
@endsection
@section('addition_script')
    <script src="{{ asset('dist/js/vendors/chartjs.js') }}"></script>
    <script src="{{ asset('dist/js/utils/colors.js') }}"></script>
    <script src="{{ asset('dist/js/vendors/exceljs.min.js') }}"></script>
    <script src="{{ asset('dist/js/vendors/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('dist/js/vendors/FileSaver.min.js') }}"></script>
    <script src="{{ asset('page/js/export.js') }}"></script>
    <script src="{{ asset('dist/js/vendors/d3.v7.min.js') }}"></script>
    <script src="{{ asset('dist/js/vendors/d3-org-chart@2.js') }}"></script>
    <script src="{{ asset('dist/js/vendors/d3-flextree.js') }}"></script>
    <script src="{{ asset('page/js/statistic.js').'?v='.date('YmdH').'1' }}"></script>
    <script src="{{ asset('page/js/statistic-job-chart.js').'?v='.date('YmdH').'1' }}"></script>
@endsection