const empProps  = JSON.parse($('#emp_properties').val());
const charts    = {};

function destroyChart(chartId) {
  if (charts[chartId]) {
    charts[chartId].destroy();
    delete charts[chartId];
  }
}

function chartByCountEmployee(mainVar, data){
    const chartId = "#emp_bycount_chart_donut";
    if ($(chartId).length) {
        if (charts[chartId]) {
            charts[chartId].destroy();
        }
        // ---- prep data
            let selectedProp = (empProps.columns).find(item => item.var_name === mainVar);
            let chartData, chartKeys, chartLabels, chartColors   = () => [];
            if(selectedProp.search.type == 'select'){
                chartKeys     = $.map(selectedProp.search.options, function(item) { return item[selectedProp.search.id]; });
                chartLabels   = $.map(selectedProp.search.options, function(item) { return item[selectedProp.search.label]; });
                chartColors   = $.map(selectedProp.search.options, function(item) { return item.color; });
            }
            const lookup = Object.fromEntries(data.map(item => [item.category, item.count]));
            chartData = chartKeys.map(key => lookup[key] ?? 0);
            
            // console.log('>>> main var\n',mainVar);
            console.log('>>> selected prop\n',selectedProp);
            // console.log('>>> raw data\n',data);
            // console.log('>>>>>>>--------\n');
            // console.log('chartData',chartData);
            // console.log('chartLabels',chartLabels);
            // console.log('chartColors',chartColors);
            // console.log('>>>>>>>--------\n');

        // ---- chart
            const ctx = $(chartId)[0].getContext("2d");
            charts[chartId] = new Chart(ctx, {
                type: "doughnut",
                data: 
                {
                    labels: chartLabels,
                    datasets: [
                        {
                            data: chartData,
                            backgroundColor: chartColors,
                            hoverBackgroundColor: chartColors,
                            borderWidth: 5,
                            borderColor: () =>
                                $("html").hasClass("dark")
                                    ? getColor("darkmode.700")
                                    : getColor("white"),
                        },
                    ],
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {}
                },
            });
            helper.watchClassNameChanges($("html")[0], (currentClassName) => {
                charts[chartId].update();
            });

        // ---- legend
            let temp = ``, sum = 0;
            $.each(chartLabels, function(i, label) {
                temp += `<div class="flex items-center">
                            <div class="mr-3 h-2 w-2 rounded-full" style="background-color:`+chartColors[i]+`"></div>
                            <span class="truncate">`+label+`</span>
                            <span class="ml-auto font-medium">`+chartData[i]+`</span>
                        </div>`;
                sum += chartData[i];
            });
            $("#emp_bycount_chart_label").html(temp);
            $("#emp_bycount_total").html(sum);
    }
}

function getByCountEmployee(){
    let mainVar = $('select[name="emp_bycount_var"]').val();
    const id_list = 'emp_bycount';
    $("#"+id_list).html(loadingElementImg);

    let payload = {}; payload['_dir'] = {}
    $("."+id_list+"_filter").each(function() {
        let var_name = $(this).attr('name');
        payload[var_name] = $(this).val();
    });
    // console.log('payload',payload); return;
    axios.get(baseUrl+'/api/statistic/emp/by-count/'+mainVar, {params: payload}, apiHeaders)
    .then(function (response) {
        // console.log('[DATA] response..',response.data);
        if(response.data.status) {
            chartByCountEmployee(mainVar, response.data.data);
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
(function () {
    "use stirct";
    getByCountEmployee();
})();
