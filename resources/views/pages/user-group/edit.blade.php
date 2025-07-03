@extends('layouts.app-enigma', ['breadcrumbs'=>[['label'=>'Satuan Kerja','url'=>route('user-group')],['label'=>'Edit']]])
@section('title', 'Edit | Satuan Kerja')
@section('content')
    {{-- <h2 class="intro-y mt-10 text-lg font-medium">Satuan Kerja</h2> --}}
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="intro-y box lg:mt-5">
                <div class="flex items-end border-b border-slate-200/60 p-5 dark:border-darkmode-400">
                    <h2 class="mr-auto text-slate-300 font-medium">
                        Informasi Umum
                    </h2>
                </div>
                <form id="form-edit" class="p-5">
                    <div class="flex flex-col xl:flex-row">
                        <div class="mt-6 flex-1 xl:mt-0">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 md:col-span-6">
                                    <input name="id" value="{{@$selected->id}}" hidden>
                                    <div>
                                        <label data-tw-merge="" class="of-required inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                            Nama Lengkap
                                        </label>
                                        <input required name="fullname" type="text" value="{{@$selected->fullname}}" placeholder="Badan Keuangan & Aset Daerah Kabupaten Katingan"
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                    </div>
                                    <div class="mt-3">
                                        <label data-tw-merge="" class="of-required inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                            Singkatan Nama
                                        </label>
                                        <input required name="nickname" type="text" value="{{@$selected->nickname}}"  placeholder="BKAD"
                                        class="nospace uppercase disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <div class="mt-3 md:mt-0">
                                        <label data-tw-merge="" class="of-required inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                            Email
                                        </label>
                                        <input required name="email" type="email" value="{{@$selected->email}}"  placeholder="singkatannama@katingankab.go.id" 
                                        class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                    </div>
                                    <div class="mt-3">
                                        <label data-tw-merge="" class="of-required inline-block mb-2 group-[.form-inline]:mb-2 group-[.form-inline]:sm:mb-0 group-[.form-inline]:sm:mr-5 group-[.form-inline]:sm:text-right">
                                            Kontak Telepon
                                        </label>
                                        <input required name="phone" type="text" value="{{@$selected->phone}}" placeholder="08**********" maxlength="15"
                                        class="nospace numeric disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    {{--  --}}
                                </div>
                            </div>
                        </div>
                        <div class="mx-auto w-2/5 xl:ml-6 xl:mr-0">
                            {{-- https://tailwindcomponents.com/component/tailwind-css-file-upload --}}
                            <label class="text-sm font-bold text-gray-500 tracking-wide">Logo Group Pengguna</label>
                            <div class="grid grid-cols-1 space-y-2 border-dashed border-2 px-5 my-2 border-indigo-600">
                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 py-5 px-2 group text-center">
                                        <div class="h-full w-full text-center flex flex-col items-center justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"  id="input-file-none-0"
                                                class="w-10 h-10 text-blue-400 group-hover:text-blue-600 {{@$selected->img_main?'hidden':''}}"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <div class="flex flex-auto max-h-48 w-4/5 mx-auto py-3 {{!@$selected->img_main?'hidden':''}}" id="input-file-preview-0">
                                                <img class="has-mask h-36 object-center" src="{{asset(@$selected->img_main)}}">
                                            </div>
                                            <p class="pointer-none text-gray-500 "><span class="text-sm">Drag & drop</span> disini <br /> atau <a href="" id="" class="text-blue-600 hover:underline">pilih</a> dari komputer</p>
                                        </div>
                                        <input name="img_main" id="input-file-btn-0" data-index-input-file="0" type="file" accept="{{implode(',',Config::get('app.accept_mimes')['img'])}}"
                                        class="input-file mt-2 block w-full text-xs border border-gray-300 rounded-lg cursor- hidden">
                                    </label>
                                </div>
                            </div>
                            <p class="text-sm text-slate-300">
                                <i>* tipe gambar, max 2MB</i>
                            </p>
                            <div>
                                <button type="button" id="btn-submit-edit" 
                                class="my-5 w-full flex justify-center bg-primary text-white p-4  rounded-full tracking-wide font-semibold  focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                                    Simpan Perubahan
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{ asset('page/js/user-group-cu.js').'?v='.date('YmdH').'1' }}"></script>
@endsection