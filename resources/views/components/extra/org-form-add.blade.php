
<div class="app-wrapper-container animated fadeIn">

            <h3>Tambah {{$breadcrumbs[0]['label']}}</h3>

            <img src="{{asset('assets/images/app/loading.gif')}}" class="mx-auto form-main-loading" style="display: none">

            <form action="#" method="post" id="form-add" data-object="{{@$object}}" class="row form-main">
                @php
                    $file_count = 0;
                    $editor_count = 0;

                    function calculateGrid($inputs) {
                        $size = sizeof($inputs);  // Menentukan jumlah elemen pada input
                        $result = [];

                        while ($size > 0) {
                            if($size == 1 && sizeof($inputs)%2!=0){
                                $result[] = 10;
                            }else{
                                $result[] = 5;
                            }
                            $size--; 
                        }

                        return $result;

                    }

                    $card_sizes = calculateGrid($inputs);
                    // dump($card_sizes);
                @endphp
                <div class="mt-5 row d-flex justify-content-center gap-2">
                    @for($i=0;$i<sizeof($inputs);$i++)
                        <div class="mt-3 col-sm-12 col-md-{{$card_sizes[$i]}} card">
                            @if(sizeof($inputs[$i])>0)
                            <div class="card-body">
                                @foreach ($inputs[$i] as $input)
                                    <div class="form-group mt-3">
                                        @if(!@$input['is_hidden'])
                                            <div class="text-xs">
                                                <label class="font-weight-bold">{{$input['label']}}
                                                    @if(@$input['is_required'])
                                                        <span class="text-danger mx-2">*</span>
                                                    @endif
                                                </label>
                                                @if(@$input['sublabel'])
                                                    <div class="text-muted3">{!!$input['sublabel']!!}</div>
                                                @endif
                                            </div>
                                        @endif
                                        @switch($input['type'])
                                            @case('text')
                                                <input  class="{{@$input['class']}} form-control form-control-sm"
                                                        type="text" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}"
                                                        {{@$input['is_disabled']?'disabled':''}}
                                                        {{@$input['min']?'minlength='.$input['min']:''}} {{@$input['max']?'maxlength='.$input['max']:''}}
                                                        {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}
                                                        data-affects_to="{{@$input['el_data']['affects_to']}}">
                                                @break
                                            @case('number')
                                                <input  class="{{@$input['class']}} form-control form-control-sm"
                                                        type="number" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}"
                                                        {{@$input['is_disabled']?'disabled':''}}
                                                        {{@$input['min']?'min='.$input['min']:''}} {{@$input['max']?'max='.$input['max']:''}}
                                                        {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                                @break
                                            @case('email')
                                                <input  class="{{@$input['class']}} form-control form-control-sm"
                                                        type="email" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}"
                                                        {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                                @break
                                            @case('password')
                                                <input  class="{{@$input['class']}} form-control form-control-sm"
                                                        type="password" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}" autocomplete="off"
                                                        {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                                <input  class="{{@$input['class']}} form-control form-control-sm"
                                                        type="password" name="{{$input['var_name']}}_confirmation" placeholder="Confirmation: write the same password" autocomplete="off">
                                                @break
                                            @case('textarea')
                                                <textarea   class="{{@$input['class']}} form-control form-control-sm"
                                                            name="{{$input['var_name']}}" placeholder="{{@$input['format']}}"
                                                            {{@$input['is_required']?'required':''}} style="{{@$input['height']?'height:'.@$input['height']:''}}" rows="5"></textarea>
                                                @break
                                            @case('editor')
                                                <textarea   class="wysiwyg-editor {{@$input['class']}}"
                                                            name="{{$input['var_name']}}" placeholder="{{@$input['format']}}" id="wysiwyg-editor-{{$editor_count++}}"
                                                            {{@$input['is_required']?'required':''}}></textarea>
                                                @break
                                            @case('select')
                                                {{-- @php
                                                    dump($input['select_attr']['options']);
                                                @endphp --}}
                                                <select class="{{@$input['is_hidden']?'hidden':(@$input['select_attr']['is_tags']?'form-select-tags':'form-select w-full')}} {{@$input['class']}}" name="{{$input['var_name']}}"
                                                    {{@$input['select_attr']['is_tags']?'multiple="multiple"':''}}
                                                    {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}}
                                                    {{@$input['is_disabled']?'disabled':''}}>
                                                    <option></option>
                                                    @if(is_array($input['select_attr']['label']))
                                                        @php
                                                            $label_sum      = sizeof($input['select_attr']['label']);
                                                        @endphp
                                                        @foreach ($input['select_attr']['options'] as $item)
                                                            <option value="{{$item[$input['select_attr']['id']]}}"
                                                                {{$item[$input['select_attr']['id']]==@$input['value']?'selected':''}}>
                                                                @for($label_idx=0;$label_idx<$label_sum;$label_idx++)
                                                                    {{$item[$input['select_attr']['label'][$label_idx]]}}
                                                                    @if($label_idx < $label_sum-1 && $item[$input['select_attr']['label'][$label_idx]] != '')
                                                                        &nbsp;-&nbsp;
                                                                    @endif
                                                                @endfor
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($input['select_attr']['options'] as $item)
                                                            <option value="{{$item[$input['select_attr']['id']]}}"
                                                                {{$item[$input['select_attr']['id']]==@$input['value']?'selected':''}}>
                                                                {{$item[$input['select_attr']['label']]}}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            @break
                                            @case('radio')
                                                @foreach ($input['select_attr']['options'] as $item)
                                                <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="{{$input['var_name']}}" id="{{$input['var_name']}}" value="{{$item[$input['select_attr']['id']]}}">
                                                        <label class="form-check-label" for="{{$input['var_name']}}">
                                                            {{$item[$input['select_attr']['label']]}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @break
                                            @case('file')
                                                <div class="upload-wrapper">
                                                    <div class="upload-container">
                                                        <div class="upload-container-in">
                                                            <div class="border-container-in">
                                                                <div class="icons fa-4x mt-3" id="input-file-none-{{$file_count}}">
                                                                    <i class="fa fa-file-image-o" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                                    <i class="fa fa-folder-open" data-fa-transform="shrink-2 up-4"></i>
                                                                    <i class="fa fa-file-pdf-o" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                                </div>
                                                                <div class="flex flex-auto mx-auto" id="input-file-preview-{{$file_count}}"></div>
                                                                <input  type="file" class="input-file" id="input-file-el-{{$file_count}}" data-index-input-file="{{$file_count}}"
                                                                        name="{{$input['var_name']}}"
                                                                        accept="{{@$input['file_attr']['accept']?implode(',',Config::get('filesystems.accept_mimes')[$input['file_attr']['accept']]):''}}"
                                                                        {{@$input['is_required']?'required':''}}>
                                                                <p>
                                                                    <small>
                                                                        Drag & drop file, atau <a href="#" class="file-browser" data-index-input-file="{{$file_count}}">cari (click di sini)</a>
                                                                    </small><br>
                                                                    <small class="text-muted2">menerima {{implode(', ', Config::get('filesystems.accept_extensions')[$input['file_attr']['accept']])}}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $file_count++;
                                                @endphp
                                            @break
                                            @default
                                                <input  class="{{@$input['class']}} form-control form-control-sm"
                                                        type="{{@$input['type']}}" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}"
                                                        {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                            @break
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    @endfor
                </div> 
            </form>


            <form action="#" method="post" id="form-add-custom" data-object="{{@$object}}" class="row form-main">
                @if(@$custom_inputs)
                    <textarea id="custom-inputs" hidden>{{json_encode($custom_inputs)}}</textarea>
                    @for($i=0;$i<sizeof($custom_inputs);$i++)
                        @switch($custom_inputs[$i]['type'])
                            @case('menu_action')
                                <div class="mt-5 intro-y box p-5">
                                    <div class="flex justify-between border-b border-slate-200/60 px-5 py-2 dark:border-darkmode-400">
                                        <span>{{$custom_inputs[$i]['label']}}</span>
                                        <span class="text-slate-400 ml-auto text-xs">{{$custom_inputs[$i]['sublabel']}}</span>
                                    </div>
                                    <div class="mt-5 grid grid-cols-12 gap-5">
                                        @foreach ($custom_inputs[$i]['data']['menus'] as $item)
                                            <div data-id="{{@$item['id']}}" class="intro-y col-span-12 block sm:col-span-4 xl:col-span-3">
                                                <div class="box zoom-in relative rounded-md p-3">
                                                    <div class="block truncate text-center font-medium">
                                                        {!!@$item['name']!!}
                                                    </div>
                                                    <div>
                                                        @if(sizeof(@$item['child_menus']))
                                                            @foreach ($item['child_menus'] as $item_child)
                                                                <div>
                                                                    <br>
                                                                    <b>{!!@$item_child['name']!!}</b>
                                                                    @foreach ($item_child['actions'] as $item2)
                                                                        <div data-tw-merge class="flex items-center mt-2 mt-2">
                                                                            <input  data-tw-merge
                                                                                    type="checkbox" name="menu_action[]" value="{{@$item2['id']}}"
                                                                                    class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50"
                                                                                    id="checkbox-switch-{{@$item['id']}}-{{@$item_child['id']}}-{{@$item2['id']}}"/>
                                                                            <label  data-tw-merge for="checkbox-switch-{{@$item['id']}}-{{@$item_child['id']}}-{{@$item2['id']}}" class="cursor-pointer mx-2">
                                                                                {{@$item2['code']}}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            @foreach ($item['actions'] as $item2)
                                                                <div data-tw-merge class="flex items-center mt-2 mt-2">
                                                                    <input  data-tw-merge
                                                                            type="checkbox" name="menu_action[]" value="{{@$item2['id']}}"
                                                                            class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50"
                                                                            id="checkbox-switch-{{@$item['id']}}-{{@$item2['id']}}"/>
                                                                    <label  data-tw-merge for="checkbox-switch-{{@$item['id']}}-{{@$item2['id']}}" class="cursor-pointer mx-2">
                                                                        {{@$item2['code']}}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @break
                            @case('menu_position')
                                <div class="mt-5 grid grid-cols-12 gap-6">
                                    <div class="intro-y col-span-12 lg:col-span-12">
                                       <div class="intro-y box p-5">
                                            <div class="flex justify-between border-b border-slate-200/60 px-5 py-2 dark:border-darkmode-400">
                                                <span>{{$custom_inputs[$i]['label']}}</span>
                                                <span class="text-slate-400 ml-auto text-xs">{{$custom_inputs[$i]['sublabel']}}</span>
                                            </div>
                                            <div class="p-5">
                                                <div class="flex flex-col xl:flex-row">
                                                    <div class="mt-6 flex-1 xl:mt-0">
                                                        <div class="container mx-auto">
                                                            <table class="mx-auto border-collapse border border-gray-300 mb-5">
                                                                {{-- <thead>
                                                                    <tr>
                                                                        <th class="border border-gray-300 p-2">Type</th>
                                                                        <th class="border border-gray-300 p-2">Position</th>
                                                                        <th class="border border-gray-300 p-2">Order</th>
                                                                        <th class="border border-gray-300 p-2">Action</th>
                                                                    </tr>
                                                                </thead> --}}
                                                                <tbody id="position-wrap" data-count="0"></tbody>
                                                            </table>
                                                        </div>
                                                        <div class="grid grid-cols-12 gap-x-5">
                                                            <div class="col-span-12" id="accordion-collapse" data-accordion="collapse">
                                                                <center id="accordion-collapse-heading-position">
                                                                    <button class="position-open-form-btn transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning text-slate-900 dark:border-warning shadow-md mb-2 mr-1 w-24"
                                                                            type="button" title="Add"
                                                                            data-accordion-target="#accordion-collapse-menu-position" aria-expanded="false" aria-controls="accordion-collapse-menu-position">
                                                                        <span class="btn-title"><i class="fa fa-plus"></i></span>
                                                                    </button>
                                                                </center>
                                                                <div class="mt-5 hidden" id="accordion-collapse-menu-position" aria-labelledby="accordion-collapse-heading-position">
                                                                  <div class="intro-y box p-5 bg-slate-100">
                                                                    <small>Fill in the attributes:</small>
                                                                    <table class="mx-auto w-full my-5">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><span class="text-slate-400 text-xs">This is</span></td>
                                                                                <td><span class="text-slate-400 text-xs">Position</span></td>
                                                                                <td><span class="text-slate-400 text-xs">Order</span></td>
                                                                                <td></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>
                                                                                    <select class="form-select w-full" id="position-draft-type" style="width:100px" readonly>
                                                                                        @foreach (array('menu'=>'Menu','page'=>'Page') as $key => $value)
                                                                                            @if($object==$key)
                                                                                                <option value="{{$key}}" selected>{{$value}}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td>
                                                                                    <select class="form-select w-full" id="position-draft-position" style="width:100px">
                                                                                        @foreach (array('footer'=>'Footer','header'=>'Header') as $key => $value)
                                                                                            <option value="{{$key}}">{{$value}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </td>
                                                                                <td><input type="number" value="10" class="input-sm" id="position-draft-order" style="width:100px"></td>
                                                                                <td>
                                                                                    <center>
                                                                                        <button class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-warning border-warning text-slate-900 dark:border-warning shadow-md mb-2 mr-1 w-24"
                                                                                                id="position-add-btn" type="button">
                                                                                                Add
                                                                                        </button>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            @break
                        @endswitch
                    @endfor
                @endif
            </form>

    <div class="text-center mt-4">
        <button type="button" class="btn btn-primary" id="btn-submit-add">Simpan Baru</button>
    </div>
</div>