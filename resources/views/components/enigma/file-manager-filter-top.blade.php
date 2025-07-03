<!-- BEGIN: File Manager Filter -->
<div class="intro-y flex flex-col-reverse items-center sm:flex-row mb-3">
    <div class="relative mr-auto mt-3 w-full sm:mt-0 sm:w-auto">
        <i data-tw-merge="" data-lucide="search" class="stroke-1.5 absolute inset-y-0 left-0 z-10 my-auto ml-3 h-4 w-4 text-slate-500"></i>
        <input name="_search" value="{{isset($_REQUEST['iso'])?$_REQUEST['iso']:''}}" data-tw-merge="" type="text" placeholder="Cari dari semua data ..." class="_filter disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none group-[.input-group]:[&:not(:first-child)]:border-l-transparent group-[.input-group]:first:rounded-l group-[.input-group]:last:rounded-r group-[.input-group]:z-10 !box px-10 sm:w-64">
    </div>
    
    
    <ul data-tw-merge="" role="tablist" class="flex mx-auto mt-2 w-60 rounded-md border border-dashed border-slate-300 p-1 dark:border-darkmode-300">
        <li id="semua-display-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none flex-1">
            <a href="{{url('/files')}}" data-tw-merge="" data-tw-target="#semua-display" role="tab" class="text-center cursor-pointer block appearance-none border-transparent text-slate-700 dark:text-slate-400 [&.active]:dark:text-white rounded-md border-0 [&.active]:bg-lime [&.active]:text-white [&.active]:font-medium w-full px-2 py-1.5 
            {{@$display_type!='timeseries'?'active':''}}">Semua</a>
        </li>
        <li id="timeseries-display-tab" data-tw-merge="" role="presentation" class="focus-visible:outline-none flex-1">
            <a href="{{url('/files-by-time')}}" data-tw-merge="" data-tw-target="#timeseries-display" role="tab" class="text-center cursor-pointer block appearance-none border-transparent text-slate-700 dark:text-slate-400 [&.active]:dark:text-white rounded-md border-0 [&.active]:bg-lime [&.active]:text-white [&.active]:font-medium w-full px-2 py-1.5 
            {{@$display_type=='timeseries'?'active':''}}">Timeseries</a>
        </li>
    </ul>
    
    <div class="flex w-full sm:w-auto">
        <a href="{{route('file-manager.add')}}"  data-tw-merge="" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">Unggah Berkas Baru</a>
        <div data-tw-merge="" data-tw-placement="bottom-end" class="dropdown relative"><button data-tw-merge="" data-tw-toggle="dropdown" aria-expanded="false" class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed !box px-2"><span class="flex h-5 w-5 items-center justify-center">
                    <i data-tw-merge="" data-lucide="plus" class="stroke-1.5 h-4 w-4"></i>
                </span></button>
            <div data-transition="" data-selector=".show" data-enter="transition-all ease-linear duration-150" data-enter-from="absolute !mt-5 invisible opacity-0 translate-y-1" data-enter-to="!mt-1 visible opacity-100 translate-y-0" data-leave="transition-all ease-linear duration-150" data-leave-from="!mt-1 visible opacity-100 translate-y-0" data-leave-to="absolute !mt-5 invisible opacity-0 translate-y-1" class="dropdown-menu absolute z-[9999] hidden">
                <div data-tw-merge="" class="dropdown-content rounded-md border-transparent bg-white p-2 shadow-[0px_3px_10px_#00000017] dark:border-transparent dark:bg-darkmode-600 w-40">
                    <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 
                        dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item" title="coming soon...">
                        <i data-tw-merge="" data-lucide="share" class="stroke-1.5 mr-2 h-4 w-4"></i>
                        Share Files</a>
                        @if(@$is_deletable)
                        <a class="cursor-pointer flex items-center p-2 transition duration-300 ease-in-out rounded-md hover:bg-slate-200/60 
                            dark:bg-darkmode-600 dark:hover:bg-darkmode-400 dropdown-item text-danger" onclick="doDeleteBulk()">
                            <i data-tw-merge="" data-lucide="trash" class="stroke-1.5 mr-2 h-4 w-4"></i>
                            Delete</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: File Manager Filter -->