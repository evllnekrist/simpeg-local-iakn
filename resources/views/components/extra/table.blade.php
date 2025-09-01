<div class="py-5">
    <div class="intro-y col-span-12">
        @php
            // echo "<pre>";
            // print_r($columns);
            // echo "</pre>";
             $style = [
                'input' => "disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 text-xs py-1.5 px-2 mt-2 mt-2"
             ];
        @endphp  
    </div>
    <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center xl:flex-nowrap"> 
        @if(@$btn_add)
            <a href="{{$btn_add['link']}}" data-tw-merge="" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{@$btn_add['label']?$btn_add['label']:'Tambah data'}}
            </a>
        @endif
        <div class="text-center">
            Menampilkan <span id="products_count_start"></span> - <span id="products_count_end"></span> dari <span id="products_count_total"></span> data
            <br><input name="_page" value="1" class="_filter" hidden>
        </div>
        <div class="mt-3 flex text-center">
            <div data-tw-placement="bottom-end" class="dropdown relative"></div>
        </div>
    </div>

    <div class="intro-y mt-5 col-span-12 overflow-auto lg:overflow-visible">
        <table data-tw-merge="" class="w-full text-left -mt-2 border-separate border-spacing-y-[2px]">
            <thead data-tw-merge="" class="">
                <tr data-tw-merge="" class="">
                    @if(isset($checkbox) && $checkbox === true)
                        <th>
                            <input type="checkbox" id="select-all" class="form-checkbox">
                            <label for="select-all" class="sr-only">Pilih semua</label>
                        </th>
                    @endif
                    @foreach ($columns as $column)
                        @if((!@$column['is_order']) || in_array(@$column['type'],['action','order','number_formula']))
                            <th>{!!$column['label']!!}</th>
                        @else
                            <th style="{{$column['var_name']!='id'?'min-width:120px':'min-width:50px'}}" onclick="changeDir('{{$column['var_name']}}')" id="th_{{$column['var_name']}}" data-dir="" class="_dir">
                                {!!$column['label']!!}
                                @if(@$column['sublabel'])
                                    <br><span class="font-weight-light text-xs">{!!$column['sublabel']!!}</span>
                                @endif
                                <span class="ml-2">
                                    <i class="fa fa-sort text-muted2"></i>
                                    <i class="fa fa-sort-up text-primary" style="display:none"></i>
                                    <i class="fa fa-sort-down text-primary" style="display:none"></i>
                                </span>
                            </th>
                        @endif
                    @endforeach
                </tr>
                <tr class="intro-x box whitespace-nowrap rounded-2xl shadow-[5px_3px_5px_#00000005]">
                        @if(isset($checkbox) && $checkbox === true)
                            <th></th> <!-- Kolom untuk checkbox -->
                        @endif                    @foreach ($columns as $column)
                        @if(!array_key_exists("search",$column))
                            <th></th>
                        @else
                            <th class="py-2">
                                @switch($column['search']['type'])
                                    @case('text')
                                    <input name="_{{$column['var_name']}}" type="text" placeholder="{{ isset($column['search']['placeholder']) ? $column['search']['placeholder'] : '' }}" data-other-column-parent="{{ isset($column['search']['other_column']) ? $column['var_name_parent'] : '' }}" data-other-column-child="{{ isset($column['search']['other_column']) ? $column['var_name_child'] : '' }}" class="_filter _filter_search {{$style['input']}}">
                                    @break
                                    @case('number')
                                        <input name="_{{$column['var_name']}}" type="number" placeholder="{{ isset($column['search']['placeholder']) ? $column['search']['placeholder'] : '' }}" data-other-column-parent="{{ isset($column['search']['other_column']) ? $column['var_name_parent'] : '' }}" data-other-column-child="{{ isset($column['search']['other_column']) ? $column['var_name_child'] : '' }}" class="_filter _filter_search {{$style['input']}}">
                                    @break
                                    @case('select')
                                        <select name="_{{$column['var_name']}}" id="_{{$column['var_name']}}"
                                            onchange="getData();
                                            @if(isset($column['search']['for']))
                                                updateOtherSelects(this, '_{{$column['search']['for']}}', '{{$column['search']['for_url']}}', '{{$column['search']['for_column']}}');
                                            @endif"
                                            class="_filter _filter_search {{$style['input']}}">
                                            <option value="">--Pilih--</option>
                                            @foreach ($column['search']['options'] as $option)
                                                    <option value="{{$option[$column['search']['id']]}}">{{$option[$column['search']['label']]}}</option>
                                                @endforeach
                                        </select>
                                    @break
                                    @case('date')
                                        <input name="_{{$column['var_name']}}" type="date" placeholder="{{ isset($column['search']['placeholder']) ? $column['search']['placeholder'] : '' }}" data-other-column-parent="{{ isset($column['search']['other_column']) ? $column['var_name_parent'] : '' }}" data-other-column-child="{{ isset($column['search']['other_column']) ? $column['var_name_child'] : '' }}" class="_filter _filter_search {{$style['input']}}">
                                    @break
                                    @default
                                    @break
                                @endswitch
                                <small id="_filter_msg_{{$column['var_name']}}"></small>
                            </th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody id="data-list" data-object="{{@$object}}">
                <tr>
                    <td colspan="{{sizeof($columns)}}">
                        <center><img src="{{asset('assets/images/app/loading.gif')}}" style="width:100px"></center>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="intro-y mt-5 col-span-12 flex flex-wrap items-center sm:flex-row sm:flex-nowrap">
        <nav aria-label="table navigation" class="w-full sm:mr-auto sm:w-auto">
            <ul class="flex w-full mr-0 sm:mr-auto sm:w-auto" id="data-list-pagination">
            </ul>
        </nav>
        <select name="_limit" onchange="getData()" data-tw-merge="" class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out text-sm border-slate-200 shadow-sm rounded-md py-2 px-3 pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 !box mt-3 w-20 sm:mt-0">
            @if(@$fix_limit)            
                <option value="{{$fix_limit}}">{{$fix_limit=='all'?'Semua':$fix_limit}}</option>
            @else
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="all">Semua</option>
            @endif
        </select>
    </div>
</div>
