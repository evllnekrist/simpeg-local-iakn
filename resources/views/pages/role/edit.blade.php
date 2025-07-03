@extends('layouts.app-enigma', ['breadcrumbs'=>[['label'=>'Kelola Akses','url'=>route('role')],['label'=>'Edit']]])
@section('title', 'Edit | Kelola Akses')
@section('content')
    {{-- <h2 class="intro-y mt-10 text-lg font-medium">Kelola Akses</h2> --}}
    <form id="form-edit"> 
        <div class="max-w-full md:max-w-none rounded-[30px] md:rounded-none px-4 md:px-[22px] min-w-0 min-h-screen bg-slate-100 flex-1 md:pt-20 pb-10 mt-5 md:mt-1 relative dark:bg-darkmode-700 before:content-[''] before:w-full before:h-px before:block">
            <input name="id" value="{{@$selected->id}}" hidden>
            <div>
                <input type="checkbox" name="is_enabled" {{@$selected->is_enabled?'checked':''}} 
                class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50 w-[38px] h-[24px] p-px rounded-full relative before:w-[20px] before:h-[20px] before:shadow-[1px_1px_3px_rgba(0,0,0,0.25)] before:transition-[margin-left] before:duration-200 before:ease-in-out before:absolute before:inset-y-0 before:my-auto before:rounded-full before:dark:bg-darkmode-600 checked:bg-primary checked:border-primary checked:bg-none before:checked:ml-[14px] before:checked:bg-white">
                <label class="cursor-pointer ml-2">Aktif</label>
            </div>
            <input name="name" value="{{@$selected->name}}" required type="text" placeholder="Nama peran" class="mt-5 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-y !box px-4 py-3 pr-10">
            <textarea name="description" placeholder="Deskripsi" class="mt-5 disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent 
            [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm 
            border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 
            dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none 
            group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 intro-y !box px-4 py-3 pr-10">{{@$selected->description}}</textarea>
                            
            <div class="intro-y grid grid-cols-12 gap-5 mt-5">
                <!-- BEGIN: Post Content -->
                <div class="intro-y col-span-12 2xl:col-span-8">
                    <div class="intro-y box mt-5 overflow-hidden">
                        <ul data-tw-merge="" role="tablist" class="border-b w-full flex flex-col border-transparent bg-slate-200 dark:border-transparent dark:bg-darkmode-800 sm:flex-row">
                            <li id="content-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none -mb-px">
                                <button data-tw-merge="" data-tw-target="#content" role="tab" class="cursor-pointer appearance-none border border-transparent dark:text-slate-400 [&.active]:dark:text-white rounded-t-md dark:border-transparent [&.active]:bg-white [&.active]:font-medium [&.active]:dark:border-b-darkmode-600 [&:not(.active)]:dark:hover:border-transparent active flex items-center justify-center w-full px-0 py-0 sm:w-40 text-slate-500 [&:not(.active)]:hover:border-transparent [&:not(.active)]:hover:bg-transparent [&:not(.active)]:hover:text-slate-600 [&:not(.active)]:hover:dark:bg-transparent [&:not(.active)]:hover:dark:text-slate-300 [&.active]:text-primary [&.active]:border-transparent [&.active]:dark:bg-darkmode-600 [&.active]:dark:border-x-transparent [&.active]:dark:border-t-transparent">
                                    <span data-placement="top" title="Fill in the article content" aria-controls="content" aria-selected="true" class="tooltip cursor-pointer flex w-full items-center justify-center py-4">
                                        <i data-tw-merge="" data-lucide="list-checks" class="stroke-1.5 mr-2 h-4 w-4"></i> Hak Akses
                                    </span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div 
                                data-transition="" 
                                data-selector=".active" 
                                data-enter="transition-[visibility,opacity] ease-linear duration-150" 
                                data-enter-from="!p-0 !h-0 overflow-hidden invisible opacity-0" 
                                data-enter-to="visible opacity-100" 
                                data-leave="transition-[visibility,opacity] ease-linear duration-150" 
                                data-leave-from="visible opacity-100" 
                                data-leave-to="!p-0 !h-0 overflow-hidden invisible opacity-0" 
                                id="content" role="tabpanel" aria-labelledby="content-tab" class="tab-pane active p-5">
                                <div class="p-5">
                                    <div class="grid grid-cols-4 gap-4">
                                        @foreach($menus as $item)
                                        <div class="rounded-md border border-slate-200/60 p-5 dark:border-darkmode-400">
                                            <label class="font-bold text-primary">{{$item->name}}</label>
                                            @foreach($item['menu_action_list'] as $item_child)
                                            <div class="flex items-center mt-2" title="{{$item_child->description}}">
                                                <input  name="menu_action[]" type="checkbox" class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50"
                                                        value="{{$item_child->id}}"
                                                        {{ in_array($item_child->id, $selected_menu_actions ?? []) ? 'checked' : '' }}>
                                                <label  class="cursor-pointer ml-2">{{$item_child->name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                        <div>
                                            <button type="button" id="btn-submit-edit" 
                                            class="my-10 w-full flex justify-center bg-primary text-white p-4 rounded-full tracking-wide font-semibold  focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                                                Simpan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Post Content -->
            </div>

        </div>
    </form>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{ asset('page/js/role-cu.js').'?v='.date('YmdH').'1' }}"></script>
@endsection