const id_el_list = '#data-list';

function doDelete(id,name){
  if(confirm("Apakah Anda yakin menghapus group pengguna '"+name+"'? Aksi ini tidak dapat dibatalkan.")){
    axios.post(baseUrl+'/api/user-group/post-delete/'+id, {}, apiHeaders)
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200 && response.data.status) {
        Swal.fire({
          icon: 'success',
          width: 600,
          title: "Berhasil",
          // html: "...",
          confirmButtonText: 'Ya, terima kasih',
        });
        window.location = baseUrl+'/user-group';
      }else{
        Swal.fire({
          icon: 'warning',
          width: 600,
          title: "Gagal",
          html: response.data.message,
          confirmButtonText: 'Ya',
        });
      }
      $('#loading').hide();
      $('#form').show();
    })
    .catch(function (error) {
      Swal.fire({
        icon: 'error',
        width: 600,
        title: "Error",
        html: error,
        confirmButtonText: 'Ya',
      });
      $('#loading').hide();
      $('#form').show();
    });
  }else{
    Swal.fire({
      icon: 'info',
      width: 600,
      html: 'Batal dihapus',
      confirmButtonText: 'Ya',
    });
  }
}
function getData(move_to_page=null){
  $(id_el_list).html(loadingElementImg);
  if(move_to_page){
    $('[name="_page"]').val(move_to_page);
  }
  let url = baseUrl+'/api/user-group'
  let payload = {};
  payload['_dir'] = {}
  $("._dir").each(function() {
    if($(this).data('dir')){
      payload['_dir'][$(this).attr('id').replace('th_','')] = $(this).data('dir');
    }
  });
  $("._filter").each(function() {
    payload[$(this).attr('name')] = $(this).val();
  });
  // console.log('payload',payload); 
  // return;
  axios.get(url, {params: payload}, apiHeaders)
  .then(function (response) {
    console.log('[DATA] response..',response.data);
    if(response.data.status) {
        let deletable = 0;
        if($('[name="is_deletable"]').length && $('[name="is_deletable"]').val()){
          deletable = 1;
        }
        if(response.data.data.products && response.data.data.products.length > 0) {
          // i::data display-------------------------------------------------------------------------------START
            let template = ``;
            (response.data.data.products).forEach((item) => {
              imgToDisplay = baseUrl+'/image/no-image-clean.png'
              img = new Image();
              img.src = item.img_main+"?_="+(new Date().getTime());
              img.onload = function () {
                imgToDisplay = item.img_main
                $('#product_'+item.id+'_img').attr("src",imgToDisplay)
              }
              template +=
              `<div class="intro-y col-span-12 md:col-span-6">
                  <div class="box `+(!item.is_enabled?`bg-slate-300`:``)+`">
                      <div class="flex flex-col items-center p-2 lg:flex-row">
                          <div class="image-fit h-24 w-24 lg:mr-1 lg:h-12 lg:w-12">
                              <img title="" src="`+imgToDisplay+`" id="product_`+item.id+`_img" alt="Gambar Satuan Kerja">
                          </div>
                          <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:mt-0 lg:text-left">
                              <a class="font-medium" href="">
                                    `+item.nickname+`
                              </a>
                              <div class="mt-0.5 text-xs text-slate-500">
                                    `+item.fullname+`
                              </div>
                          </div>
                          <div class="mt-4 flex lg:mt-0">
                                <a href="`+baseUrl+'/user-group/'+item.id+`" data-tw-merge="" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-slate-500 dark:border-darkmode-100/40 dark:text-slate-300 [&:hover:not(:disabled)]:bg-secondary/20 [&:hover:not(:disabled)]:dark:bg-darkmode-100/10 px-2 py-2">
                                    <i class="fa fa-pen"></i>
                                </a>`;
                if(deletable){
                template +=    `
                                <button onclick="doDelete(`+item.id+`,'`+item.name+`')" data-tw-merge="" class="transition duration-200 border shadow-sm inline-flex items-center justify-center rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed border-secondary text-danger dark:border-danger mr-2 px-2 py-2">
                                    <i class="fa fa-trash"></i>
                                </button>`;
                }
                template +=
                          `</div>
                      </div>
                  </div>
              </div>`;
            });
            $(id_el_list).html(template);
          // i::data display---------------------------------------------------------------------------------END
          // i::data statistics----------------------------------------------------------------------------START
            $('#products_count_start').html(response.data.data.products_count_start);
            $('#products_count_end').html(response.data.data.products_count_end);
            $('#products_count_total').html(response.data.data.products_count_total);
          // i::data statistics------------------------------------------------------------------------------END
          // i::data pagination----------------------------------------------------------------------------START
            template = '';
            let max_page = Math.ceil(response.data.data.products_count_total/response.data.data.filter._limit);
            template += 
            `<li class="flex-1 sm:flex-initial">
                <a onclick="getData(`+1+`)"  
                data-tw-merge="" class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">
                <i class="fas fa-angle-double-left"></i>
                </a>
            </li>`; 
            if(response.data.data.filter._page > 1){
              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+(response.data.data.filter._page-1)+`)" 
                  data-tw-merge="" class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">
                  `+(response.data.data.filter._page-1)+`
                  </a>
              </li>`; 
            }

            template += 
            `<li class="flex-1 sm:flex-initial">
                <a data-tw-merge="" class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3 !box dark:bg-darkmode-400">
                `+response.data.data.filter._page+`
                </a>
            </li>`;
            
            if(response.data.data.filter._page < max_page){
              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+(response.data.data.filter._page+1)+`)" 
                  data-tw-merge="" class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">
                  `+(response.data.data.filter._page+1)+`
                  </a>
              </li>`; 
            }
            if(response.data.data.filter._page+1 < max_page){
              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+(response.data.data.filter._page+2)+`)" 
                  data-tw-merge="" class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">
                  `+(response.data.data.filter._page+2)+`
                  </a>
              </li>`; 
            }
            template += 
            `<li class="flex-1 sm:flex-initial">
                <a onclick="getData(`+max_page+`)"  
                data-tw-merge="" class="transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3">\
                <i class="fas fa-angle-double-right"></i>
                </a>
            </li>`; 

            $(id_el_list+'-pagination').html(template);
            $('[name="_page"]').val(response.data.data.filter._page);
          // i::data pagination------------------------------------------------------------------------------END
        }else{
          $(id_el_list).html('<h3 class="mt-5">Tidak ada data</h3>');
        }
          
    }else{
      Swal.fire({
        icon: 'warning',
        width: 600,
        title: "Gagal",
        html: response.data.message,
        confirmButtonText: 'Ya',
      });
    }
  })
  .catch(function (error) {
    Swal.fire({
      icon: 'error',
      width: 600,
      title: "Error",
      html: error,
      confirmButtonText: 'Ya',
    });
    console.log(error);
  });
}

$(function () {
  getData();
});