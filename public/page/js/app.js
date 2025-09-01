console.log('____app js');

const baseUrl = window.location.origin;
const formatterMonth = new Intl.DateTimeFormat('en-US', { month: 'short' });
let apiHeaders = {
    headers: {
        "Accept": "*/*",
        "Access-Control-Allow-Origin": "*",
        "Content-Type": "multipart/form-data",
    }
};
let isDark = $('html.dark').length;
let loadingElementImg = `<div class="col-span-12"><img src="../../image/loading.gif" class="mx-auto"></div>`;
let loadingElement = `<div class="mx-auto">memuat...</div>`;
let imgToDisplay = ``, img = ``;
const extensions = {
    'img' : ['.png','.jpg','.webp','.heic','.heif'],
    'doc' : ['.pdf','.doc','.docx','.xls','.xlsx','.csv','.ppt','.pptx']
}; // ,'.'

function nospace(event,changeWith=""){
    if((event.target.value).includes(' ')){
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            html: 'Input ini tidak menerima spasi'+(changeWith != ""?', otomatis diganti karakter '+changeWith:''),
            showConfirmButton: false,
            timer: 2000
        });
    }
    event.target.value =  event.target.value.replaceAll(" ",changeWith)
}
$('.nospace').on('keyup', function(event) {
    nospace(event);
});
$('.nospace_rw_underscore').on('keyup', function(event) {
    nospace(event,'_');
});

function numeric(event){
    if ((event.target.value).match(/[^$,.\d]/)){
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            html: 'Input ini hanya boleh angka',
            showConfirmButton: false,
            timer: 2000
        });
    }
    event.target.value =  event.target.value.replace(/[^\d]+/g,'')
}
$('.numeric').on('keyup', function(event) {
    numeric(event);
});

function uppercase(event){
    event.target.value =  event.target.value.toUpperCase()
}
$('.uppercase').on('keyup', function(event) {
    uppercase(event);
});

function lowercase(event){
    event.target.value =  event.target.value.toLowerCase()
}
$('.lowercase').on('keyup', function(event) {
    lowercase(event);
});

function expandable(el){
    let is_truncated = true;
    $($(el).data('target')).each(function() {
        if($(this).hasClass('truncate')){
            $(this).removeClass('truncate');
            is_truncated = false;
        }else{
            $(this).addClass('truncate');
        }
    });
    if(!is_truncated){
        $(el).addClass('bg-warning/20');
        $(el).removeClass('bg-white dark:bg-darkmode-600');
    }else{
        $(el).removeClass('bg-warning/20');
        $(el).addClass('bg-white dark:bg-darkmode-600');
    }
}

function inputFile(event){
    let iii = event.target.getAttribute('data-index-input-file');
    const files = event.target.files
    let url='', template='';
    // console.log('change input image');
    // console.log(iii,event);
    for(i = 0; i < files.length; i++){
        // console.log(iii,event.target.files[i]);
        url = URL.createObjectURL(event.target.files[i]);
        if($.inArray(event.target.files[i]['type'], accept_mimes['img']) >= 0){
            $('#input-file-preview-'+iii).removeClass('w-4/5');
            template += `<img class="mx-auto" width="50%" src="`+url+`">`;
        }else if(event.target.files[i]['type'] == 'application/pdf'){
            $('#input-file-preview-'+iii).removeClass('w-4/5');
            template += `
            <iframe style="border:1px solid #666CCC;min-width: 500px;" title="displaying PDF" src="`+url+`"
                frameborder="1"
                scrolling="auto"
                height="400px">
            </iframe>`;
        }else{
            $('#input-file-preview-'+iii).addClass('w-4/5');
            template += `
            <div class="mx-auto w-2/5">
                <div class="relative block bg-center bg-no-repeat bg-contain before:content-[''] before:pt-[100%] before:w-full before:block bg-file-icon-file">
                    <div class="absolute bottom-0 left-0 right-0 top-0 m-auto flex items-center justify-center text-white">
                        `+(event.target.files[i]['name']).split('.').pop().toUpperCase()+`
                    </div>
                </div>
            </div>`;
        }
    }
    // console.log('template',template)
    $('#input-file-preview-'+iii).html(template);
    $('#input-file-preview-'+iii).removeClass('hidden');
    $('#input-file-none-'+iii).addClass('hidden');
    $('#input-file-btn-'+iii).removeClass('hidden');
}
$('.input-file').on('change', function(event) {
    inputFile(event);
});
function initiateFileFromInput(){
    let iii = 0, template = '', type_of_extension = '';
    $('[type="file"]').each(function(index) {
        // console.log('_____', typeof $(this).data('value') !== 'undefined', $(this).data('value'));
        iii = $(this).data('index-input-file');
        if(typeof $(this).data('value') !== 'undefined' && $(this).data('value')){
            type_of_extension = $(this).data('value').split('.').pop();
            if(extensions['img'].includes('.'+type_of_extension)){
                $('#input-file-preview-'+iii).removeClass('w-4/5');
                template += `<img class="mx-auto" width="50%" src="`+$(this).data('value')+`">`;
            }else if(type_of_extension == 'pdf'){
                $('#input-file-preview-'+iii).removeClass('w-4/5');
                template += `
                <iframe style="border:1px solid #666CCC;min-width: 500px;" title="displaying PDF" src="`+$(this).data('value')+`"
                    frameborder="1"
                    scrolling="auto"
                    height="400px">
                </iframe>`;
            }else{
                $('#input-file-preview-'+iii).addClass('w-4/5');
                template += `
                <div class="mx-auto w-2/5">
                    <div class="relative block bg-center bg-no-repeat bg-contain before:content-[''] before:pt-[100%] before:w-full before:block bg-file-icon-file">
                        <div class="absolute bottom-0 left-0 right-0 top-0 m-auto flex items-center justify-center text-white">
                            `+type_of_extension.toUpperCase()+`
                        </div>
                    </div>
                </div>`;
            }
            $('#input-file-preview-'+iii).html(template);
        }
    });
}

const regexExp_slug = /^[a-z][-a-z0-9]*$/;
function checkSlug(str){
    if(regexExp_slug.test(str)){
    $('#slug-info').html('<i class="text-info">Slug valid</i>');
    $('[name="check_validity"]').val(1)
    }else{
    $('#slug-info').html('<b class="text-danger">Slug tidak valid</b>');
    $('[name="check_validity"]').val(0)
    }
    // console.log('check_validity',$('[name="check_validity"]').val() )
}
$('.slug').on('keyup', function(event) {
    checkSlug(event.target.value)
});

$('[name="_search"]').on("keyup",function search(e) {
    if(e.which == 13) {
        getData();
    }
});

function display(id,id2){
    // console.log(id,id2);
    let action = $('#'+id).data('display')
    if(action == 'hide'){
    $('#'+id).show()
    $('#'+id2).hide()
    $('#'+id).data('display', 'show')
    $('#'+id+'-action-text').html('Batal Ganti Gambar')
    }else{
    $('#'+id).hide()
    $('#'+id2).show()
    $('#'+id).data('display', 'hide')
    $('#'+id+'-action-text').html('Ganti Gambar')
    }
}

function copyToClipboard(copyText) {
    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);
    // Alert the copied text
    alert(`Anda sudah mengcopy: "` + copyText + `"`);
}

function hideLoading(appendTo){
    // console.log(appendTo+'Loading','toHide')
    $(appendTo+'_loading').hide()
}

function changeDir(field){
    let el = $('#th_'+field);

    switch (el.data('dir')) {
      case 'asc': // currently ASC to be DESC
        el.data('dir','desc');
        el.find('.fas').addClass('hidden');
        el.find('.fa-sort-down').removeClass('hidden');
        break;
      case 'desc': // currently DESC to be NEUTRAL
        el.data('dir','');
        el.find('.fas').addClass('hidden');
        el.find('.fa-sort').removeClass('hidden');
        break;
      default: // curently NEUTRAL to ASC
        el.data('dir','asc');
        el.find('.fas').addClass('hidden');
        el.find('.fa-sort-up').removeClass('hidden');
        break;
    }
    getData();
}

function shorten(text, maxLength, delimiter, overflow) {
    if(text){
        delimiter = delimiter || "&hellip;";
        overflow = overflow || false;
        var ret = text;
        if (ret.length > maxLength) {
        var breakpoint = overflow ? maxLength + ret.substr(maxLength).indexOf(" ") : ret.substr(0, maxLength).lastIndexOf(" ");
        ret = ret.substr(0, breakpoint) + delimiter;
        }
        return ret;
    }else{
        return "";
    }
}

function influencedColorScheme(){
    let template = `<img style="width: 30vw" src="`+assetUrl+`image/logo.gif">`;
    // let template = `<img style="width: 30vw" src="`+assetUrl+`image/logo-transp-medium-eng-dark.gif">`;
    // if(isDark){
    //   template = `<img style="width: 30vw" src="`+assetUrl+`image/logo-transp-medium-eng-dark.gif">`;
    // }
    $('#gif-influenced-color-sceme').html(template)
}

$('#global-file-search').on('keyup', function(event) {
    const id_search_list    = '#global-file-search-result';
    const class_search_info = '.global-file-search-result-more';
    let str = event.target.value;

    $(class_search_info).hide();
    if(str.length < 3){
        $(id_search_list).html('<center><i>Pencarian minimal dari 3 karakter</i></center>');
    }else{
        $(id_search_list).html(loadingElementImg);
        let url = baseUrl+'/api/file/get-min'
        axios.post(url, {'_search':str}, apiHeaders)
        .then(function (response) {
          if(response.data.status) {
              $(id_search_list+'-total').html(response.data.data.products_count_total);
              $(id_search_list+'-open-link').attr('href','/files?iso='+str);
              if(response.data.data.products && response.data.data.products.length > 0) {
                // i::data display-------------------------------------------------------------------------------START
                  let template = ``;
                  (response.data.data.products).forEach((item) => {
                   template += `
                   <a class="mt-2 flex items-center" href="/file/edit/`+item.id+`" target="_blank">
                        <div class="ml-3"><i>`+item.title+`</i></div>
                        <div class="ml-auto w-48 truncate text-right text-xs text-slate-500">
                            <b>`+(item.owner_user_group?item.owner_user_group.nickname:`<span class="text-white">_</span>`)+`</b>
                        </div>
                    </a>`;
                  });
                  $(id_search_list).html(template);
                  $(class_search_info).show();
                // i::data display---------------------------------------------------------------------------------END
              }else{
                $(id_search_list).html('<h3 class="mt-5">Tidak ada data yang sesuai</h3>');
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
});

function cleanUrl(str){
    return str.replace(/([^:])(\/\/+)/g, '$1/');
}

$(function (){

});
