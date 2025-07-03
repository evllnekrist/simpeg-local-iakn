<div class="py-5">
    <div>
        <div class="flex w-full sm:w-auto">
            <!-- 
            @--php
                print_r();
            @--endphp
             -->
            @if(@$btn_add)
                <a href="{{$btn_add['link']}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{@$btn_add['label']?$btn_add['label']:'Tambah data'}}
                </a>
            @endif
        </div>
        <div class="text-center">
            Menampilkan <span id="products_count_start"></span> - <span id="products_count_end"></span> dari <span id="products_count_total"></span> data
            <br><input name="_page" value="1" class="_filter" hidden>
        </div>
        <div class="mt-3 flex text-center">
            <div data-tw-placement="bottom-end" class="dropdown relative"></div>
        </div>
    </div>

    <div class="mt-5 table-responsive">
        <table class="table table-striped small">
            <thead class="">
                <tr>
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
                                    <input name="_{{$column['var_name']}}" type="text" placeholder="{{ isset($column['search']['placeholder']) ? $column['search']['placeholder'] : '' }}" data-other-column-parent="{{ isset($column['search']['other_column']) ? $column['var_name_parent'] : '' }}" data-other-column-child="{{ isset($column['search']['other_column']) ? $column['var_name_child'] : '' }}" class="_filter _filter_search form-control">
                                    @break
                                    @case('number')
                                        <input name="_{{$column['var_name']}}" type="number" placeholder="{{ isset($column['search']['placeholder']) ? $column['search']['placeholder'] : '' }}" data-other-column-parent="{{ isset($column['search']['other_column']) ? $column['var_name_parent'] : '' }}" data-other-column-child="{{ isset($column['search']['other_column']) ? $column['var_name_child'] : '' }}" class="_filter _filter_search form-control">
                                    @break
                                    @case('select')
                                        <select name="_{{$column['var_name']}}" id="_{{$column['var_name']}}"
                                            onchange="getData();
                                            @if(isset($column['search']['for']))
                                                updateOtherSelects(this, '_{{$column['search']['for']}}', '{{$column['search']['for_url']}}', '{{$column['search']['for_column']}}');
                                            @endif"
                                            class="_filter _filter_search form-control">
                                            <option value="">--Pilih--</option>
                                            @foreach ($column['search']['options'] as $option)
                                                    <option value="{{$option[$column['search']['id']]}}">{{$option[$column['search']['label']]}}</option>
                                                @endforeach
                                        </select>
                                    @break
                                    @case('date')
                                        <input name="_{{$column['var_name']}}" type="date" placeholder="{{ isset($column['search']['placeholder']) ? $column['search']['placeholder'] : '' }}" data-other-column-parent="{{ isset($column['search']['other_column']) ? $column['var_name_parent'] : '' }}" data-other-column-child="{{ isset($column['search']['other_column']) ? $column['var_name_child'] : '' }}" class="_filter _filter_search form-control">
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

    <div class="row mt-2">
        <div class="col-sm-6">
            <nav aria-label="table navigation">
                <ul class="pagination" id="data-list-pagination">
                </ul>
            </nav>
        </div>
        <div class="col-sm-6 text-end">
            <select name="_limit" onchange="getData()" class="_filter form-select form-control-sm auto-width">
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
</div>
