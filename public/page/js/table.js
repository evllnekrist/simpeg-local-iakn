console.log("_________________________________ TABLEJS");
apiHeaders['Authorization'] = 'Bearer '+$("meta[name='tapi']").attr("content");
loadingElementImg   = `<tr>
                            <td colspan="100%"><center><img src="../../asset/images/loading2.gif"></center></td>
                        </tr>`;
const id_list       = '#data-list';
const style         =   {
                            'pagination':`transition duration-200 border items-center justify-center py-2 rounded-md cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed min-w-0 sm:min-w-[40px] shadow-none font-normal flex border-transparent text-slate-800 sm:mr-2 dark:text-slate-300 px-1 sm:px-3`,
                        }

function doDelete(id,name){
    const object  = $(id_list).data('object');
    if(confirm("Yakin menghapus '"+name+"'? Tindakan ini tidak dapat dibatalkan.")){
        axios.delete(baseUrl+'/api/'+object+'/'+id, {data:{}, headers:apiHeaders})
        .then(function (response) {
        // console.log('response..',response);
        if(response.status == 200) {
            iziToast.success({
                title: response.data.message,
                // message: '',
                position: 'center',
                progressBarColor: 'rgb(0, 255, 184)',
            });
            setTimeout(function() {
                window.location = baseUrl+'/'+object;
            }, 500);
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
        $('#loading').hide();
        })
        .catch(function (error) {
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
        $('#loading').hide();
        });
    }else{
        iziToast.info({
            title: 'Info',
            message: 'Batal dihapus',
        });
    }
}

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
    // console.log('payload',payload);
    // return;
    axios.get(baseUrl+'/api/'+object, {params: payload}, apiHeaders)
    .then(function (response) {
        // console.log('[DATA] response..',response.data);
        if(response.data.status) {
            if(response.data.data.products && response.data.data.products.length > 0) {
            // i::data display-------------------------------------------------------------------------------START
                let template = ``; let num = ((response.data.data.filter._page-1)*response.data.data.filter._limit);
                let imgToDisplay = ``; let imgToDisplayHtml = ``;
                let temp =``;
                let class_vnc, icon, color, tempClass, tempName = '';
                let calc_result = 0;
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
                    template += `<td><input type="checkbox" class="data-checkbox" value="${item.id}"></td>`;
                }

                columns.forEach(function (val, key) {
                    if(val.var_name_custom){
                        val.var_name_custom.forEach(function (val_var, key_var) {
                            tempName = item[val_var['var_name']];
                            if(val_var['class']){
                                class_vnc = val_var['class'];
                            }

                            //custom icon
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
                            template += `<a onclick="fetchEppgbmMeasurementResult(`+item.id+`)" class="mr-3 items-center text-success">
                                            <i class="fa fa-table"></i>
                                        </a>`;
                        }
                        
                        if(!('visibility_edit' in val) || (val.visibility_edit == true)){
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
                        }
                        if(!('visibility_deletion' in val) || (val.visibility_deletion == true)){
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
                        }
                        template += `</td>`;
                    }else if(val.type == 'link'){
                            template += `<td    class="border border-gray-300 p-2 truncate `+(val.class?val.class:``)+` `+tempClass+`" 
                                                onclick="expandable(this)" style="max-width:400px">
                                                <a class="mr-3 items-center" target="_blank" href="`+baseUrl+'/'+object+'/'+item[pk]+`">`+item[val.var_name]+
                                                `</a>`+
                                        `</td>`;
                    }else if(val.var_name == 'img_main'){
                        template += `<td class="border border-gray-300 p-2">`+imgToDisplayHtml+`</td>`;
                    }else if(val.type == 'number_formula'){
                        calc_result = 0;
                        val.formula.forEach(formula_item => {
                            switch (formula_item.op) {
                                case '+':
                                    calc_result = item[formula_item.var1] + item[formula_item.var2];
                                    break;
                                case '-':
                                    calc_result = item[formula_item.var1] - item[formula_item.var2];
                                    break;
                                case '*':
                                    calc_result = item[formula_item.var1] * item[formula_item.var2];
                                    break;
                                case '/':
                                    calc_result = item[formula_item.var2] !== 0 ? item[formula_item.var1] / item[formula_item.var2] : null; // Avoid division by zero
                                    break;
                                default:
                                    calc_result = null; // Handle unsupported operators
                            }
                            // console.log(`Result of ${item[formula_item.var1]} ${formula_item.op} ${item[formula_item.var2]}:`, calc_result,val.formula); // Check
                        });
                        template += `<td class="border border-gray-300 p-2"><center>`+calc_result+`</center></td>`;
                    }else{
                        if('var_names' in val){
                            template += `<td class="border border-gray-300 p-2 truncate" onclick="expandable(this)" style="max-width:400px">`;

                            val.var_names.forEach(function (val_var, key_var) {
                                template += `<span class="`+(val_var.class?val_var.class:``)+`">`+('key' in val_var?(item[key_var].map(item_temp => item_temp[val_var['key']])):(item[key_var]?item[key_var]:``))+`</span>`;
                                template += `&nbsp;`+('separator' in val_var?val_var.separator:`<br>`)+``;
                            });
                            template += `</td>`;
                        }else if('var_name_parent' in val){
                            // console.log(val.var_name_parent, val.var_name_child);
                            template += `<td class="border border-gray-300 p-2 truncate `+(val.class?val.class:``)+`" onclick="expandable(this)" style="max-width:400px">`+(item[val.var_name_parent] && item[val.var_name_parent][val.var_name_child] ? item[val.var_name_parent][val.var_name_child] : '<center>-</center>')+temp+`</td>`;
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
                ['<button>OK Gas</button>', function (instance, toast) {
                    instance.hide({
                        transitionOut: 'fadeOutUp',
                    }, toast, 'Tombol OK');
                }]
            ],
        });
    });
}

$('._filter_search').on('keyup', function() {
    let var_name = $(this).attr('name');
    // console.log('#_filter_msg_'+var_name);

    switch ($(this).attr('type')) {
        case 'number': break;
        case 'select': break;
        default:
        if($(this).val().length != 0 && $(this).val().length < 3){
            $('#_filter_msg'+var_name).html('<br>* Isi minimum 3 karakter untuk melakukan pencarian. Kosongkan kolom untuk reset ke awal.');
            return;
        }else{
            $('#_filter_msg'+var_name).html('');
        }
        break;
    }
    getData();
});

$(function () {
    getData();
});

function openModal() {
    document.getElementById('resultModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('resultModal').classList.add('hidden');
}