console.log("_________________________________ FORMJS");
apiHeaders['headers']['Authorization'] = 'Bearer '+$("meta[name='tapi']").attr("content");
// import { ClassicEditor, SourceEditing } from 'ckeditor5';

$(document).ready(function() {
  
  $('.form-select').select2({
    minimumInputLength: typeof select_type !== 'undefined' ? select_type : ''
  });
  
  $('.form-select-tags').select2({
    tags: true,
  });
  
  $('.wysiwyg-editor').each(function(i, obj) {
    $('#wysiwyg-editor-'+i).summernote({
      placeholder: 'tuliskan di sini....',
      tabsize: 2,
      height: 250
    })
  });
});

function getData(moveToPage=null){
  const object  = $(id_list).data('object');
  $(id_list).html(loadingElementImg);

  if(moveToPage){
      $('[name="_page"]').val(moveToPage);
  }
  let payload = {}; payload['_dir'] = {}
  $("._dir").each(function() {
      if($(this).data('dir')){
      payload['_dir'][$(this).attr('id').replace('th_','')] = $(this).data('dir');
      }
  });
  $("._filter").each(function() {
      let var_name = $(this).attr('name');
      let other_column_parent = $(this).data('other-column-parent'); // Ambil parameter data-other-column
      let other_column_child = $(this).data('other-column-child'); 
      let other_column_m = $(this).data('other-column-m'); 
      
      payload[var_name] = $(this).val();
      
      if (other_column_parent) {
          payload['column_parent'+var_name] = other_column_parent;
          payload['column_child'+var_name] = other_column_child; // Tambahkan parameter other_column ke payload
          payload['column_m'+var_name] = other_column_m; 
      }
  });
  console.log('payload',payload); 
  // return;
  axios.get(baseUrl+'/api/'+object, { params: payload })
  .then(function (response) {
      console.log('[DATA] response..',response.data);
      if(response.data.status) {
          if(response.data.data.products && response.data.data.products.length > 0) {
          // i::data display-------------------------------------------------------------------------------START
              let template = ``; let num = ((response.data.data.filter._page-1)*response.data.data.filter._limit);
              let imgToDisplay = ``; let imgToDisplayHtml = ``;
              let temp =``;
              let class_vnc, icon, color, tempClass, tempName = '';
              (response.data.data.products).forEach((item) => {
              if(item.img_main){
                  imgToDisplay = baseUrl+'/asset/images/no-image-clean.png'
                  img = new Image();
                  img.src = item.img_main+"?_="+(new Date().getTime());
                  img.onload = function () {
                      imgToDisplay = item.img_main
                      $('#product_'+item.id+'_img').attr("src",imgToDisplay)
                      $('#product_'+item.id+'_img').attr("title",item.img_main)
                  }
                  imgToDisplayHtml = `<img src="`+imgToDisplay+`" id="product_`+item.id+`_img" title="invalid image" style="width:80px">`;
              }else{
                  imgToDisplayHtml = `<center>-</center>`;
              }

              template += `<tr data-tw-merge="" class="intro-x box whitespace-nowrap rounded-2xl shadow-[5px_3px_5px_#00000005]">`;
              
              if (checkbox !== null && checkbox === true) {
                  template += `<td><input type="checkbox" class="data-checkbox" value="jQuery{item.id}"></td>`;
              }
              
              jQuery.each(columns, function (key, val) {
                  if(val.var_name_custom){
                      jQuery.each(val.var_name_custom, function (key_var, val_var) { 
                          tempName = item[val_var['var_name']];
                          if(val_var['class']){
                              class_vnc = val_var['class'];
                          }
                          if(val_var['var_name']=='gender'){
                              if (tempName == 'L') {
                                  icon = 'fa-mars';
                                  color = '#3490dc'; // Elegan biru
                              } else {
                                  icon = 'fa-venus';
                                  color = '#ff66b3'; // Elegan pink
                              }
                          } else if(val_var['var_name']=='status'){
                              if (tempName == true) {
                                  icon = 'fa-check-circle';
                                  color = '#38c172'; // Elegan hijau
                              } else {
                                  icon = 'fa-check-circle';
                                  color = '#343a40'; // Elegan abu-abu gelap
                              }
                          } else if(val_var['var_name']=='marital_status'){
                              if (tempName == 'Kawin') {
                                  icon = 'fa-heart';
                                  color = '#e3342f'; // Elegan merah
                              } else if (tempName == 'Belum Kawin') {
                                  icon = 'fa-heart';
                                  color = '#38c172'; // Elegan hijau
                              } else if (tempName == 'Cerai Hidup') {
                                  icon = 'fa-heart';
                                  color = '#343a40'; // Elegan abu-abu gelap
                              } else {
                                  icon = 'fa-heart';
                                  color = '#6c757d'; // Elegan abu-abu
                              }
                          } else if(val_var['var_name']=='method'){
                              if (tempName == 'Berdiri') {
                                  icon = 'fa-child';
                                  color = '#9561e2'; // Elegan ungu
                              } else {
                                  icon = 'fa-bed';
                                  color = '#ff5733'; // Elegan oranye
                              }
                          }else {
                              if (tempName == 'Islam') {
                                  icon = 'fa-mosque';
                                  color = '#38c172'; // Elegan hijau
                              } else if (tempName == 'Kristen') {
                                  icon = 'fa-church';
                                  color = '#3490dc'; // Elegan biru
                              } else if (tempName == 'Katolik') {
                                  icon = 'fa-church';
                                  color = '#9561e2'; // Elegan ungu
                              } else if (tempName == 'Hindu') {
                                  icon = 'fa-gopuram';
                                  color = '#6c757d'; // Elegan abu-abu
                              } else if (tempName == 'Buddha') {
                                  icon = 'fa-vihara';
                                  color = '#ffb03b'; // Elegan oranye
                              } else {
                                  icon = 'fa-yin-yang';
                                  color = '#e3342f'; // Elegan merah
                              }
                          }
                          temp += val_var['divider'];
                          if('var_name_parent' in val_var){
                              itemTemp = item[val_var['var_name_parent']][val_var['var_name_child']];
                          }else{
                              itemTemp = tempName;
                          }
                          if(itemTemp == 'perorangan'){
                              itemTemp = 'Perorangan';
                              class_vnc = 'bg-primary';
                          }else if (itemTemp == 'keluarga'){
                              itemTemp = 'Keluarga';
                              class_vnc = 'bg-success';
                          }else if (itemTemp == 'rumah_tangga'){
                              itemTemp = 'Rumah Tangga';
                              class_vnc = 'bg-warning';
                          }else if(itemTemp == true){
                              itemTemp = 'Sudah Terealisasi';
                          }else if(itemTemp == false){
                              itemTemp = 'Belum Terealisasi';
                          }
                          if(val_var['type']=='badge'){
                              temp += `<span class="rounded-full `+class_vnc+` py-[3px] pl-2 pr-1 text-xs font-medium text-white">`+itemTemp+`</span>`;   
                          }else if(val_var['type']=='icon'){
                              temp += `<i title="`+itemTemp+`" class="fas `+icon+`" style="color: `+color+`; font-size: `+val_var['font_size']+`; margin-left: 4px;"></i>`;   
                          }else{
                              temp+= `<span class="`+class_vnc+`">`+(itemTemp ? itemTemp : `-`)+`</span>`;
                          }
                          temp += val_var['closer']?val_var['closer']:``;
                      });
                  }
                  if(val.type == 'seq_number'){
                      template += `<td class="border border-gray-300 p-2"><center>`+(++num)+`</center></td>`;
                  }else if(val.type == 'action'){
                      template += `<td class="border border-gray-300 p-2">`;
                      if('is_result' in val){
                          template += `<a onclick="fetchMeasurementResult(`+item.measurement_result.id+`)" class="mr-3 items-center text-success">
                                          <i class="fa fa-table"></i>
                                      </a>`;
                      }
                      if((typeof no_editable_items !== 'undefined') || (!'is_editable' in val || val.is_editable == true)){
                          if(no_editable_items.includes(item[pk])){
                              template += `<i class="small text-muted2">tidak dapat diedit</i>`;
                              if(no_deletable_items.includes(item[pk])){
                                  template += `<br>`;
                              }
                          }else{
                              template += `<a class="mr-3 items-center" href="`+baseUrl+'/'+object+'/'+item[pk]+`">
                                              <i class="fa fa-pen"></i>
                                          </a>`;
                          }
                      }else{
                          template += `<a class="mr-3 items-center" href="`+baseUrl+'/'+object+'/'+item[pk]+`">
                                          <i class="fa fa-pen"></i>
                                      </a>`;
                      }
                      if((typeof no_deletable_items !== 'undefined') || (!'is_deletable' in val || val.is_deletable == true)){
                          if(no_deletable_items.includes(item[pk])){
                              template += `<i class="small text-muted2">tidak dapat dihapus</i>`;
                          }else{
                              template += `<a onclick="doDelete(`+item.id+`,'`+item[val['delete_name']]+`')" class="items-center text-danger">
                                              <i class="fa fa-trash"></i>
                                          </a>`;
                          }
                      }else{
                          template += `<a onclick="doDelete(`+item.id+`,'`+item[val['delete_name']]+`')" class="items-center text-danger">
                                          <i class="fa fa-trash"></i>
                                      </a>`;
                      }
                      template += `</td>`;
                  }else if(val.var_name == 'img_main'){
                      template += `<td class="border border-gray-300 p-2">`+imgToDisplayHtml+`</td>`;
                  }else{
                      if('var_names' in val){
                          template += `<td class="border border-gray-300 p-2 truncate" onclick="expandable(this)" style="max-width:400px">`;
                          
                          jQuery.each(val.var_names, function (key_var, val_var) {                
                              template += `<span class="`+(val_var.class?val_var.class:``)+`">`+('key' in val_var?(item[key_var].map(item_temp => item_temp[val_var['key']])):(item[key_var]?item[key_var]:``))+`</span>`;
                              template += `&nbsp;`+('separator' in val_var?val_var.separator:`<br>`)+``;
                          });
                          template += `</td>`;
                      }else if('var_name_parent' in val){
                          template += `<td class="border border-gray-300 p-2 truncate `+(val.class?val.class:``)+`" onclick="expandable(this)" style="max-width:400px">`+(item[val.var_name_parent][val.var_name_child]?item[val.var_name_parent][val.var_name_child]:'<center>-</center>')+temp+`</td>`;
                      }else{               
                          if(item[val.var_name] === 'perorangan'){
                              tempClass = 'bg-success text-white'
                          }else if(item[val.var_name] === 'keluarga'){
                              tempClass = 'bg-warning'
                          }else if(item[val.var_name] === 'rumah_tangga'){
                              tempClass = 'bg-danger text-white'
                          }
                          template += `<td class="border border-gray-300 p-2 truncate `+(val.class?val.class:``)+` `+tempClass+`" onclick="expandable(this)" style="max-width:400px">`+
                          (item[val.var_name] === true ? 'Aktif' : 
                              item[val.var_name] === false ? 'Tidak Aktif' : 
                              item[val.var_name] === 'perorangan' ? 'Perorangan' : 
                              item[val.var_name] === 'keluarga' ? 'Keluarga' : 
                              item[val.var_name] === 'rumah_tangga' ? 'Rumah Tangga' : 
                              (item[val.var_name] ? item[val.var_name] : '<center>-</center>'))+temp+`</td>`;
                          tempClass = '';
                       }
                      temp=``;
                      class_vnc=``;
                      icon=``;
                      color=``;
                  }
              });
              template += `</tr>`;
              });
              $(id_list).html(template);
          // i::data display---------------------------------------------------------------------------------END
          // i::data statistics----------------------------------------------------------------------------START
              $('#products_count_start').html(response.data.data.products_count_start);
              $('#products_count_end').html(response.data.data.products_count_end);
              $('#products_count_total').html(response.data.data.products_count_total);
          // i::data statistics------------------------------------------------------------------------------END
          // i::data pagination----------------------------------------------------------------------------START
              template = '';
              let max_page = Math.ceil(response.data.data.products_count_total/response.data.data.filter._limit);
              template += // first
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+1+`)" class="`+style.pagination+`"> << </a>
              </li>`; 
              if(response.data.data.filter._page > 1){
              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+(response.data.data.filter._page-1)+`)" class="`+style.pagination+`">`+(response.data.data.filter._page-1)+`</a>
              </li>`; 
              }

              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a  class="`+style.pagination+` !box dark:bg-darkmode-400">`+response.data.data.filter._page+`</a>
              </li>`;
              
              if(response.data.data.filter._page < max_page){
              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+(response.data.data.filter._page+1)+`)" class="`+style.pagination+`">`+(response.data.data.filter._page+1)+`</a>
              </li>`; 
              }
              if(response.data.data.filter._page+1 < max_page){
              template += 
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+(response.data.data.filter._page+2)+`)" class="`+style.pagination+`">`+(response.data.data.filter._page+2)+`</a>
              </li>`; 
              }
              template += // last
              `<li class="flex-1 sm:flex-initial">
                  <a onclick="getData(`+max_page+`)" class="`+style.pagination+`"> >> </a>
              </li>`; 

              $(id_list+'-pagination').html(template);
              $('[name="_page"]').val(response.data.data.filter._page);
          // i::data pagination------------------------------------------------------------------------------END
          }else{
          $(id_list).html(`<tr>
                                  <td colspan="100%" class="py-5"><center><i>no data</i></center></td>
                              </tr>`);
          }
          
      }else{
      iziToast.warning({
          title: "Failed",
          html: response.data.message,
          position: 'center',
          buttons: [
              ['<button>OK</button>', function (instance, toast) {
                  instance.hide({
                      transitionOut: 'fadeOutUp',
                  }, toast, 'Tombol OK');
              }]
          ],
      });
      }
  })
  .catch(function (error) {
      console.log(error);
      iziToast.error({
          title: "Failed",
          message: error.response?error.response.data.message:error.message,
          position: 'center',
          buttons: [
              ['<button>OK</button>', function (instance, toast) {
                  instance.hide({
                      transitionOut: 'fadeOutUp',
                  }, toast, 'Tombol OK');
              }]
          ],
      });
  });
}

$(".input-file").css("opacity", "0");

$(".file-browser").click(function(e) {
  e.preventDefault();
  let iii = event.target.getAttribute('data-index-input-file');
  $("#input-file-el-"+iii).trigger("click");
});

$("#btn-submit-add").on('click', function(e) {
  let form_id   = 'form-add';
  let form      = document.getElementById(form_id);
  const object  = $(form).data('object');
  
  form.reportValidity()
  if (!form.checkValidity()) {
  } else if($('[name="check_validity"]').val() == 0){
    iziToast.warning({
        title: "Gagal",
        message: 'Masih ada isian yang belum valid, mohon diperbaiki',
        position: 'center',
    });
  } else {
    $('.form-main'+'-loading').show();
    $('.form-main').hide();
    let formData = new FormData(form);
    $('.wysiwyg-editor').each(function(i, obj) {
      // formData.append($(obj).attr('name'),CKEDITOR.instances['wysiwyg-editor-'+i].getData());
      formData.append($(obj).attr('name'),$('#wysiwyg-editor-'+i).summernote('code'));
    });
    // for (const [key, value] of formData) {
    //   console.log('»', key, value)
    // }; return;
    axios.post(baseUrl+'/api/'+object, formData, apiHeaders)
    .then(function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        if($('#custom-inputs').length){ 
          let customInputs = jQuery.parseJSON($('#custom-inputs').html());
          form      = document.getElementById('form-add-custom');
          formData  = new FormData(form);
          formData.append('ref_id',response.data.data.id);
          // for (const [key, value] of formData) {
          //     console.log('»', key, value)
          // }
          try{
            let axiosSub = [];
            customInputs.forEach(async function(item) {
              axiosSub[item.type] = await axios.post(item.api_url, formData, apiHeaders) 
              .then(async function (response2) {
                console.log('response2..',response2);
              })
              .catch(function (error) {
                console.log('error',error)
                iziToast.error({
                    timeout: 20000,
                    title: "Gagal [* Layer 2]",
                    message: error.message,
                    position: 'center',
                    buttons: [
                        ['<button>OK</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                            }, toast, 'Tombol OK');
                        }]
                    ],
                });
                $('.form-main'+'-loading').hide();
                $('.form-main').show();
                return;
              });
            });
            iziToast.success({
              title: response.data.message,
                message: 'Anda akan diarahkan ke daftar data [* Layer 2]',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
              window.location = baseUrl+'/'+object;
            }, 1500);
          }catch(err){
            console.log(err);
            iziToast.error({
                timeout: 20000,
                title: "Gagal [* lapis ke-2 saat catch]",
                message: "lihat console",
                position: 'center',
            });
            $('.form-main'+'-loading').hide();
            $('.form-main').show();
          }
        }else{
          iziToast.success({
              title: response.data.message,
              message: 'Anda akan diarahkan ke daftar data',
              position: 'center',
              progressBarColor: 'rgb(0, 255, 184)',
          });
          setTimeout(function() {
            window.location = baseUrl+'/'+object;
          }, 1500);
        }
      }else{
        iziToast.warning({
            title: "Gagal",
            message: response.data.message,
            position: 'center',
            buttons: [
                ['<button>OK</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                    }, toast, 'Tombol OK');
                }]
            ],
        });
      }
      $('.form-main'+'-loading').hide();
      $('.form-main').show();
    })
    .catch(function (error) {
      iziToast.error({
          timeout: 20000,
          title: "Gagal",
          message: error.response?error.response.data.message:error.message,
          position: 'center',
          buttons: [
              ['<button>OK</button>', function (instance, toast) {
                  instance.hide({
                      transitionOut: 'fadeOutUp',
                  }, toast, 'Tombol OK');
              }]
          ],
      });
      $('.form-main'+'-loading').hide();
      $('.form-main').show();
    });
  }
});

$("#btn-submit-edit").on('click', function(e) {
  let form_id   = 'form-edit';
  let form      = document.getElementById(form_id);
  const object  = $(form).data('object');
  const id      = $(form).data('id');

  form.reportValidity()
  if (!form.checkValidity()) {
  } else if($('[name="check_validity"]').val() == 0){
    iziToast.warning({
        title: "Gagal",
        message: 'Masih ada isian yang belum valid, mohon diperbaiki',
        position: 'center',
    });
  } else {
    $('.form-main'+'-loading').show();
    $('.form-main').hide();
    let formData = new FormData(form);
    $('.wysiwyg-editor').each(function(i, obj) {
      // formData.append($(obj).attr('name'),CKEDITOR.instances['wysiwyg-editor-'+i].getData());
      formData.append($(obj).attr('name'),$('#wysiwyg-editor-'+i).summernote('code'));
    });
    // for (const [key, value] of formData) {
    //   console.log('»', key, value)
    // }; return;
    axios.post(baseUrl+'/api/'+object+'/'+id, formData, apiHeaders) // why not put? put cant send multipart format
    .then(async function (response) {
      console.log('response..',response);
      if(response.status == 200) {
        if($('#custom-inputs').length){
          let customInputs = jQuery.parseJSON($('#custom-inputs').html());
          form      = document.getElementById('form-edit-custom');
          formData  = new FormData(form);
          formData.append('ref_id',id);

          try{
            let axiosSub = [];
            customInputs.forEach(async function(item) {
              // eval(item.type+'Exec')();
              axiosSub[item.type] = await axios.post(item.api_url, formData, apiHeaders) 
              .then(async function (response2) {
                console.log('response2..',response2);
              })
              .catch(function (error) {
                console.log('error',error)
                iziToast.error({
                    timeout: 20000,
                    title: "Gagal [* Layer 2]",
                    message: error.message,
                    position: 'center',
                    buttons: [
                        ['<button>OK</button>', function (instance, toast) {
                            instance.hide({
                                transitionOut: 'fadeOutUp',
                            }, toast, 'Tombol OK');
                        }]
                    ],
                });
                $('.form-main'+'-loading').hide();
                $('.form-main').show();
                return;
              });
            });
            iziToast.success({
              title: response.data.message,
                message: 'Anda akan diarahkan ke daftar data [* Layer 2]',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
            //   window.location = baseUrl+'/'+object;
            }, 1500);
          }catch(err){
            console.log(err);
            iziToast.error({
                timeout: 20000,
                title: "Gagal [* lapis ke-2 saat catch]",
                message: "lihat console",
                position: 'center',
            });
            $('.form-main'+'-loading').hide();
            $('.form-main').show();
          }
        }else{
          iziToast.success({
            title: response.data.message,
              message: 'Anda akan diarahkan ke daftar data',
              position: 'center',
              progressBarColor: 'rgb(0, 255, 184)',
          });
          setTimeout(function() {
            // window.location = baseUrl+'/'+object;
          }, 1500);
        }
      }else{
        iziToast.warning({
            title: "Gagal",
            message: response.data.message,
            position: 'center',
            buttons: [
                ['<button>OK</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                    }, toast, 'Tombol OK');
                }]
            ],
        });
      }
      $('.form-main'+'-loading').hide();
      $('.form-main').show();
    })
    .catch(function (error) {
      iziToast.error({
          timeout: 20000,
          title: "Gagal",
          message: error.response?error.response.data.message:error.message,
          position: 'center',
          buttons: [
              ['<button>OK</button>', function (instance, toast) {
                  instance.hide({
                      transitionOut: 'fadeOutUp',
                  }, toast, 'Tombol OK');
              }]
          ],
      });
      $('.form-main'+'-loading').hide();
      $('.form-main').show();
    });
  }
});

// $(".position-open-form-btn").on('click', function(e) {});

$("#position-add-btn").on('click', function(e) {
    if(!$('#position-draft-type').val() || !$('#position-draft-position').val() || !$('#position-draft-order').val()){
        iziToast.warning({
        title: "Nah!",
        message: "Filling must be complete",
        position: 'center',
        });
        return;
    }
  
    // let position = {};
    let counter_temp    = 0;
    let this_continue        = true;
    $('.position-item').each(function() {
        counter_temp = $(this).data('counter');
        // position[counter_temp] = {};
        // position[counter_temp]['type'] = $('[name="position['+counter_temp+'][type]"]').val();
        // position[counter_temp]['position'] = $('[name="position['+counter_temp+'][position]"]').val();
        // console.log($('#position-draft-type').val()+'=='+$('[name="position['+counter_temp+'][type]"]').val()+' && '+$('#position-draft-position').val()+'=='+$('[name="position['+counter_temp+'][position]"]').val())
        if($('#position-draft-type').val() == $('[name="position['+counter_temp+'][type]"]').val() && $('#position-draft-position').val() == $('[name="position['+counter_temp+'][position]"]').val()){
            iziToast.warning({
                title: "Well...",
                message: "you have already registered a similar combination of type and position, please edit the order if necessary or delete that item to be able to add this item.",
                position: 'center',
                timeout: 10000,
            });
            this_continue = false;
            return;
        }
    });
    // console.log('position',position)
    
    if(this_continue){
        let counter = $('#position-wrap').data('count');
        let template = `<tr class="position-item" data-counter="`+(++counter)+`" style="max-width:200px" id="position-item-`+counter+`">
                          <td>
                              <input type="text" class="input-sm border-0 bg-slate-100" name="position[`+counter+`][type]" value="`+$('#position-draft-type').val()+`" readonly>
                          </td>
                          <td>
                              <input type="text" class="input-sm border-0 bg-slate-100" name="position[`+counter+`][position]" value="`+$('#position-draft-position').val()+`" readonly>
                          </td>
                          <td>
                              <input type="number" class="input-sm border-0" name="position[`+counter+`][order]" value="`+$('#position-draft-order').val()+`">
                          </td>
                          <td><span class="flex items-center"><a onclick="removePosition(`+counter+`)"><i class="fa fa-trash text-danger"></i></a></span></td>
                        </tr>`;
        $('#position-wrap').data('count',counter);
        $('#position-wrap').append(template);
        $('#accordion-collapse-menu-position').addClass('hidden');
    }
});

$('.minmax').on('click', function(e) { 
    $('#'+$(this).data('wrap-id')).toggleClass('hidden')
});

function removePosition(counter){
    if(confirm("Please confirm deletion")){
      $('#position-item-'+counter).remove();
    }
}