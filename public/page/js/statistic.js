console.log('____statistics js');

const empProps      = JSON.parse($('#emp_properties').val());
const charts        = {};
const chartProps    = {};

function destroyChart(chartId) {
  if (charts[chartId]) {
    charts[chartId].destroy();
    delete charts[chartId];
  }
}

function chartDonut(chartId, listId){
    if ($(chartId).length) {
        if (charts[chartId]) {
            charts[chartId].destroy();
        }
        
        if(chartProps[listId]['label'].length >= 15){ // biggest
            $(chartId+'_outer').removeClass("h-[320px]");
            $(chartId+'_outer').removeClass("h-[196px]");
            $(chartId+'_outer').addClass("h-[400px]");
        }
        else if(chartProps[listId]['label'].length <= 5){ // small
            $(chartId+'_outer').removeClass("h-[320px]");
            $(chartId+'_outer').removeClass("h-[400px]");
            $(chartId+'_outer').addClass("h-[196px]");
        }else{ // medium
            $(chartId+'_outer').removeClass("h-[400px]");
            $(chartId+'_outer').removeClass("h-[196px]");
            $(chartId+'_outer').addClass("h-[320px]");
        }
        
        const ctx = $(chartId)[0].getContext("2d");
        charts[chartId] = new Chart(ctx, {
            type: "doughnut",
            data: 
            {
                labels: chartProps[listId]['label'],
                datasets: [
                    {
                        data: chartProps[listId]['data'],
                        backgroundColor: chartProps[listId]['color'],
                        hoverBackgroundColor: chartProps[listId]['color'],
                        borderWidth: 1,
                        borderColor: () =>
                            $("html").hasClass("dark")
                                ? getColor("darkmode.700")
                                : getColor("white"),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                            display: true,
                            position: 'bottom', // 👈 THIS
                            labels: {
                            boxWidth: 20,
                            padding: 15
                        }
                    }
                }
            },
        });
        helper.watchClassNameChanges($("html")[0], (currentClassName) => {
            charts[chartId].update();
        });
    }
}

function chartBar(chartId, listId) {
    if ($(chartId).length) {
        if (charts[chartId]) {
            charts[chartId].destroy();
        }
        
        if(chartProps[listId]['label'].length >= 15){ // biggest
            $(chartId+'_outer').removeClass("h-[400px]");
            $(chartId+'_outer').removeClass("h-[275px]");
            $(chartId+'_outer').addClass("h-[525px]");
        }
        else if(chartProps[listId]['label'].length <= 5){ // small
            $(chartId+'_outer').removeClass("h-[400px]");
            $(chartId+'_outer').removeClass("h-[525px]");
            $(chartId+'_outer').addClass("h-[275px]");
        }else{ // medium
            $(chartId+'_outer').removeClass("h-[525px]");
            $(chartId+'_outer').removeClass("h-[275px]");
            $(chartId+'_outer').addClass("h-[400px]");
        }

        const XS = 9; // Tailwind text-xs
        const ctx = $(chartId)[0].getContext("2d");
        charts[chartId] = new Chart(ctx, {
            type: "bar",
            data: {
                labels: chartProps[listId]['label'],
                datasets: [
                    {
                        data: chartProps[listId]['data'],
                        backgroundColor: chartProps[listId]['color'],
                        hoverBackgroundColor: chartProps[listId]['color'],
                        borderWidth: 1,
                        borderColor: () =>
                            $("html").hasClass("dark")
                                ? getColor("darkmode.700")
                                : getColor("white"),
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: XS },
                            generateLabels: (chart) => {
                                const { labels, datasets } = chart.data;
                                const colors = datasets[0].backgroundColor;
                                return labels.map((text, i) => ({
                                    text,
                                    fillStyle: Array.isArray(colors) ? colors[i] : colors,
                                    strokeStyle: 'transparent',
                                    lineWidth: 0,
                                    hidden: !chart.getDataVisibility(i), // ← reflect current visibility
                                    index: i
                                }));
                            }
                        },
                        onClick: (e, item, legend) => {
                        const chart = legend.chart;
                        const i = item.index;
                        chart.toggleDataVisibility(i); // ← built-in per-index toggle
                        chart.update();
                        }
                    },
                    tooltip: {
                        mode: "index",
                        intersect: false,
                    },
                },
                responsive: true,
                scales: {
                    x: {
                        ticks: { font: { size: XS } }, // ← axis tick font xs
                        grid: { display: false },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { size: XS } }, // ← axis tick font xs
                        grid: {
                        color: $("html").hasClass("dark")
                            ? getColor("darkmode.600")
                            : getColor("slate.200"),
                        },
                    },
                },
            },
        });
        helper.watchClassNameChanges($("html")[0], () => { // re-render on theme class change
            charts[chartId].update();
        });
    }
}

function chartByCountEmployee(listId, mainVar, data, target){
    // ---- prep data
        let selectedProp = (empProps.columns).find(item => item.var_name === mainVar);
        chartProps[listId] = {};
        // console.log('>>>>>>>--------\n');
        // console.log('>>> main var\n',mainVar);
        console.log('>>> selected prop\n',selectedProp);
        // console.log('>>> raw data\n',data);
        // console.log('>>>>>>>--------\n');
        if(selectedProp.search.type == 'select'){
            chartProps[listId]['key']     = $.map(selectedProp.search.options, function(item) { return item[selectedProp.search.id]; });
            chartProps[listId]['label']   = $.map(selectedProp.search.options, function(item) { return item[selectedProp.search.label]; });
            if('color_type' in (selectedProp?.search ?? {}) && selectedProp.search.color_type == 'generated_by_range'){
                chartProps[listId]['color'] = chartProps[listId]['key'].map((num, index) => {
                    return adjustColorLightness(selectedProp.search.color, index * 5); // Convert hex to HSL, adjust lightness progressively
                });
            }else{
                chartProps[listId]['color']   = $.map(selectedProp.search.options, function(item) { return item[selectedProp.search.color]; });
            }
        }else if(selectedProp.search.type == 'number'){
            // Generate chartProps[listId]['key'] from max → 1
            chartProps[listId]['key'] = Array.from({ length: selectedProp.search.max }, (_, i) => selectedProp.search.max - i);
            // Generate chartProps[listId]['label'] as string
            chartProps[listId]['label'] = chartProps[listId]['key'].map(num => num.toString());
            // Generate chartProps[listId]['color'] (decreasing lightness)
            chartProps[listId]['color'] = chartProps[listId]['key'].map((num, index) => {
                return adjustColorLightness(selectedProp.search.color, index * 5); // Convert hex to HSL, adjust lightness progressively
            });
        }
        const lookup = Object.fromEntries(data.map(item => [item.category, item.count]));
        chartProps[listId]['data'] = chartProps[listId]['key'].map(key => lookup[key] ?? 0);
        console.log('>>>>>>>--------\n');
        console.log('chartProps data',chartProps[listId]['data']);
        console.log('chartProps label',chartProps[listId]['label']);
        console.log('chartProps color',chartProps[listId]['color']);
        console.log('>>>>>>>--------\n');
    // ---- chart
        chartDonut('#emp_bycount_chart_donut', listId);
        chartBar('#emp_bycount_chart_bar', listId);
    // ---- legend
        let temp = ``, total = chartProps[listId]['data'].reduce((sum, num) => sum + num, 0),
        chartPercentOfTotal = $.map(chartProps[listId]['data'], function(value) {
            return ((value / total) * 100).toFixed(2); // 2 decimal
        }),
        chartPercentOfTarget = $.map(chartProps[listId]['data'], function(value) {
            return ((value / target) * 100).toFixed(2); // 2 decimal
        });
        $.each(chartProps[listId]['label'], function(i, label) {
            // temp += `<div class="flex items-center">
            //             <div class="mr-3 h-2 w-2 rounded-full" style="background-color:`+chartProps[listId]['color'][i]+`"></div>
            //             <span class="truncate">`+label+`</span>
            //             <span class="ml-auto font-medium">`+chartProps[listId]['data'][i]+`</span>
            //         </div>`;
            temp    += `<tr>
                            <td class="px-2 py-1 border">
                                <div class="flex">
                                    <div class="mr-3 h-2 w-2 rounded-full" style="background-color:`+chartProps[listId]['color'][i]+`"></div> `+label+`
                                </div>    
                            </td>
                            <td class="px-2 py-1 border text-right">`+chartProps[listId]['data'][i]+`</td>
                            <td class="px-2 py-1 border text-right">`+chartPercentOfTotal[i]+` %</td>
                            <td class="px-2 py-1 border font-bold text-right">`+chartPercentOfTarget[i]+` %</td>
                        </tr>`;
        });
        // $("#emp_bycount_chart_label").html(temp);
        $("#emp_bycount_table_content").html(temp);
        $(".emp_bycount_total").html(total);
        $(".emp_bycount_target").html(target);
}

function getByCountEmployee(){
    let mainVar = $('select[name="emp_bycount_var"]').val();
    const listId = 'emp_bycount';
    $("#"+listId).html(loadingElementImg);

    let payload = {}; payload['_dir'] = {}
    $("."+listId+"_filter").each(function() {
        let var_name = $(this).attr('name');
        payload[var_name] = $(this).val();
    });
    // console.log('payload',payload); return;
    axios.get(baseUrl+'/api/statistic/emp/by-count/'+mainVar, {params: payload}, apiHeaders)
    .then(function (response) {
        // console.log('[DATA] response..',response.data);
        if(response.data.status) {
            chartByCountEmployee(listId, mainVar, response.data.data, response.data.target);
            $("#"+listId+"_last_activity").html(formatDateToID(response.data.last_activity, "WIB"))
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

// ------------------------------------------------------------ DOCUMENT READY
$(document).on('click', '[role="tab"][data-tw-target]', function (e) {
  e.preventDefault();
  const $btn = $(this);
  const target = $btn.attr('data-tw-target');

  // update buttons
  $btn.closest('[role="tablist"]').find('[role="tab"]').removeClass('active').attr('aria-selected', 'false');
  $btn.addClass('active').attr('aria-selected', 'true');

  // update panels
  const $content = $btn.closest('.col-span-12, .tab-content').find('.tab-content'); // robust scope
  $content.find('.tab-pane').removeClass('active');
  $(target).addClass('active');
});

function isVisible(id) {
    const el = document.getElementById(id);
    if (!el) return false;
    const style = getComputedStyle(el);
    if (style.display === 'none' || style.visibility === 'hidden' || +style.opacity === 0) return false;
    const rect = el.getBoundingClientRect();
    return rect.width > 0 && rect.height > 0;
}

$('#emp_bycount_download').on('click', function () {
    let chartIsVisible = ['#emp_bycount_chart_bar']; // isinya bisa saja lebih dari 1
    if(isVisible('#emp_bycount_chart_donut')){
        chartIsVisible = ['#emp_bycount_chart_donut'];
    }
    // ganti selector sesuai elemen Anda:
    exportStatsToExcel(
        '#emp_bycount_table',                  // tabel di sisi kanan
        chartIsVisible,
        'statistik-pegawai-'+getTodayDateTimeFormatted()+'.xlsx',
        'Statistik Pegawai'
    );
});

(function () {
    "use stirct";
    getByCountEmployee();
})();
