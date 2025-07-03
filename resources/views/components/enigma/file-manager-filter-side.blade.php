
{{-- <h2 class="intro-y mr-auto mt-2 text-lg font-medium"></h2> --}}
<!-- BEGIN: File Manager Menu -->
<div class="intro-y box p-5">
    <div>
        <a class="mt-2 flex items-center rounded-md px-3 py-2" href="">
            <div class="mr-3 h-2 w-2 rounded-full bg-success"></div>
            Publik
        </a>
        <a class="mt-2 flex items-center rounded-md px-3 py-2" href="">
            <div class="mr-3 h-2 w-2 rounded-full bg-warning"></div>
            Satuan Kerja
        </a>
        {{-- <a class="mt-2 flex items-center rounded-md px-3 py-2" href="">
            <div class="mr-3 h-2 w-2 rounded-full bg-pending"></div>
            Privat
        </a> --}}
    </div>
    <div class="mt-4 border-t border-slate-200 pt-4 dark:border-darkmode-400">
        @foreach ($keywords as $item)
            <button data-tw-merge class="keyword-item bg-slate-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full mt-2"
                onclick="getData(null,'{{$item->subject}}')" id="keyword-item-{{$item->subject}}">
                {{$item->subject}}
            </button>
        @endforeach
        <a class="mt-5 flex items-center rounded-md px-3 py-2" href="#" title="lakukan penambahan/perubahan berkas dengan kata kunci baru">
            <i data-tw-merge="" data-lucide="plus" class="stroke-1.5 mr-2 h-4 w-4"></i>
            Tambah Kata Kunci
        </a>
    </div>
</div>
<!-- END: File Manager Menu -->