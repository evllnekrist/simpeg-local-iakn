console.log('____statistic job chart js');

// -------- Helper to render node content (header + optional table) ----
  const sum = (arr, key) => arr.reduce((a,r)=>a+(Number(r[key])||0),0);
  const nodeContent = d => {
    const rows = d.data.rows || [];
    const title = d.data.title || '';
    const subtitle = d.data.subtitle || '';
    if (!rows.length) {
      return `<div style="width:${d.width}px;height:72px;border:1px solid #ccc;border-radius:8px;background:#fff">
                <div style="background:#eee;padding:8px 12px;font-weight:bold">${title}</div>
                <div style="padding:4px 12px;font-size:12px;color:#555">${subtitle}</div>
              </div>`;
    }
    const bTot = sum(rows,'b'), kTot = sum(rows,'k'), delta = kTot-bTot;
    return `<div style="width:${d.width}px;border:1px solid #ccc;border-radius:8px;background:#fff;overflow:hidden">
              <div style="background:#eee;padding:8px 12px;font-weight:bold">
                ${title}
                <span style="float:right;background:${d.data.type==='fungsional'?'#10b981':'#2563eb'};color:#fff;border-radius:4px;padding:2px 6px;font-size:11px">
                  ${d.data.type==='fungsional'?'F':'S'}
                </span>
              </div>
              <div style="padding:4px 12px;font-size:12px;color:#555;display:flex;justify-content:space-between">
                <span>${subtitle}</span>
                <span style="background:#eef2ff;border-radius:4px;padding:2px 6px;font-size:11px">B:${bTot} · K:${kTot} · Delta:${delta}</span>
              </div>
              <table style="width:100%;border-collapse:collapse;font-size:12px">
                <thead><tr style="background:#f9fafb">
                  <th style="text-align:left;padding:4px;border-top:1px solid #ddd">Jabatan</th>
                  <th>KLS</th><th>B</th><th>K</th><th>+/-</th>
                </tr></thead>
                <tbody>
                  ${rows.map(r=>`
                    <tr>
                      <td style="padding:4px;border-top:1px solid #ddd">${r.jabatan}</td>
                      <td style="text-align:center">${r.kls ?? ''}</td>
                      <td style="text-align:center">${r.b ?? ''}</td>
                      <td style="text-align:center">${r.k ?? ''}</td>
                      <td style="text-align:center">${r.delta ?? ''}</td>
                    </tr>`).join('')}
                </tbody>
              </table>
            </div>`;
  };
  let nodes;
  let chart;
// -------- Toolbar actions ----
  document.getElementById('expandAllBtn').addEventListener('click', () => {
    chart.expandAll();
  });
  document.getElementById('collapseAllBtn').addEventListener('click', () => {
    chart.collapseAll();
  });
  document.getElementById('zoomInBtn').addEventListener('click', () => {
    chart.zoomIn();   // API d3-org-chart
  });
  document.getElementById('zoomOutBtn').addEventListener('click', () => {
    chart.zoomOut();  // API d3-org-chart
  });
  document.getElementById('fitBtn').addEventListener('click', () => {
    chart.fit();
  });
  document.getElementById('layoutRight').addEventListener('click', () => {
    chart.layout('right').render().expandAll().fit()
  });
  document.getElementById('layoutTop').addEventListener('click', () => {
    chart.layout('top').render().expandAll().fit()
  });
  document.getElementById('layoutLeft').addEventListener('click', () => {
    chart.layout('left').render().expandAll().fit()
  });
  document.getElementById('layoutBottom').addEventListener('click', () => {
    chart.layout('bottom').render().expandAll().fit()
  });
  document.getElementById('org_chart_png_btn').addEventListener('click', () => {
    const svg = document.querySelector('#org_chart svg');
if (!svg) {
  alert('Chart belum dirender');
  return;
}

const serializer = new XMLSerializer();
let source = serializer.serializeToString(svg);

// pastikan atribut xmlns ada
if (!source.match(/^<svg[^>]+xmlns="http:\/\/www\.w3\.org\/2000\/svg"/)) {
  source = source.replace('<svg', '<svg xmlns="http://www.w3.org/2000/svg"');
}
if (!source.match(/^<svg[^>]+xmlns:xlink="http:\/\/www\.w3\.org\/1999\/xlink"/)) {
  source = source.replace('<svg', '<svg xmlns:xlink="http://www.w3.org/1999/xlink"');
}

// download file
const url = "data:image/svg+xml;charset=utf-8," + encodeURIComponent(source);
const a = document.createElement("a");
a.href = url;
a.download = "peta-jabatan.svg";
a.click();
  });
// -------- Fullscreen toggle (container)
  const container = document.getElementById('org_chart');
  const goFull = () => container.requestFullscreen ? container.requestFullscreen() :
                    container.webkitRequestFullscreen ? container.webkitRequestFullscreen() :
                    container.msRequestFullscreen && container.msRequestFullscreen();
  const exitFull = () => document.exitFullscreen ? document.exitFullscreen() :
                    document.webkitExitFullscreen ? document.webkitExitFullscreen() :
                    document.msExitFullscreen && document.msExitFullscreen();

  document.getElementById('fsBtn').addEventListener('click', () => {
    if (!document.fullscreenElement &&
        !document.webkitFullscreenElement &&
        !document.msFullscreenElement) {
      goFull();
      // setelah fullscreen, agakkan fit biar pas
      setTimeout(()=>chart.fit(), 200);
    } else {
      exitFull();
      setTimeout(()=>chart.fit(), 200);
    }
  });

  function exportExcelHierarchyWithSummaryV2(nodesArray, filename='peta-jabatan.xlsx') {
    if (!window.XLSX) { alert('SheetJS (xlsx) belum termuat'); return; }

    // --- index & adjacency
    const byId = Object.fromEntries(nodesArray.map(n => [n.id, n]));
    const children = {};
    nodesArray.forEach(n => { if (n.parentId) (children[n.parentId] ||= []).push(n.id); });

    const hier = [];        // rows untuk sheet Hierarki
    const levelOfRow = [];  // outline level (tidak menjadi kolom, hanya styling Excel)

    function dfs(id, level, path) {
      const n = byId[id];
      const currentPath = [...path, (n.title || '')];
      const pathStr = currentPath.join(' > '); // pakai " > " sesuai permintaan
      const rows = Array.isArray(n.rows) ? n.rows : [];

      if (!rows.length) {
        // tetap tampilkan node kosong
        hier.push({
          id: n.id,
          parent_id: n.parentId || '',
          path: pathStr,
          title: n.title || '',
          subtitle: n.subtitle || '',
          jabatan: '',
          kls: '',
          b: 0,
          k: 0,
          delta: 0
        });
        levelOfRow.push(level);
      } else {
        rows.forEach(r => {
          hier.push({
            id: n.id,
            parent_id: n.parentId || '',
            path: pathStr,
            title: n.title || '',
            subtitle: n.subtitle || '',
            jabatan: r.jabatan ?? '',
            kls: r.kls ?? '',
            b: Number(r.b || 0),
            k: Number(r.k || 0),
            delta: Number(r.delta || 0)
          });
          levelOfRow.push(level);
        });
      }
      (children[id] || []).forEach(cid => dfs(cid, level + 1, currentPath));
    }

    // start from roots (no parentId)
    nodesArray.filter(n => !n.parentId).forEach(root => dfs(root.id, 0, []));

    // ---- Sheet 1: Hierarki (kolom sesuai spesifikasi)
    const hierHeader = ["id","parent_id","path","title","subtitle","jabatan","kls","b","k","delta"];
    const hierData = [hierHeader, ...hier.map(r => [
      r.id, r.parent_id, r.path, r.title, r.subtitle, r.jabatan, r.kls, r.b, r.k, r.delta
    ])];

    const ws1 = XLSX.utils.aoa_to_sheet(hierData);
    // outline levels (baris 0 header)
    ws1['!rows'] = [{}, ...levelOfRow.map(lvl => ({ level: lvl }))];
    ws1['!cols'] = [
      {wch:18}, // id
      {wch:18}, // parent_id
      {wch:70}, // path
      {wch:36}, // title
      {wch:30}, // subtitle
      {wch:50}, // jabatan
      {wch:6},  // kls
      {wch:6},  // b
      {wch:6},  // k
      {wch:8},  // delta
    ];

    // ---- Sheet 2: Summary (agregasi per id)
    // kunci = id node; simpan juga parent_id/title/path untuk konteks
    const summaryMap = {};
    hier.forEach(r => {
      const key = r.id;
      if (!summaryMap[key]) {
        summaryMap[key] = {
          id: r.id,
          // parent_id: r.parent_id,
          title: r.title,
          // path: r.path,
          B: 0, K: 0, Vac: 0, Delta: 0
        };
      }
      summaryMap[key].B += Number(r.b || 0);
      summaryMap[key].K += Number(r.k || 0);
      summaryMap[key].Delta += Number(r.delta || 0);
      // Vacant dihitung dari agregat K - B (>=0)
      // catatan: agregasi Vac langsung tiap-baris juga ok, tapi hasil sama ketika dijumlahkan
    });
    // hitung Vacant akhir per id
    Object.values(summaryMap).forEach(x => { x.Vac = Math.max(0, x.K - x.B); });

    // urutkan by path asc untuk rapi
    const summaryRows = Object.values(summaryMap)
      .sort((a,b) => a.path.localeCompare(b.path))
      .map(x => [x.id, x.parent_id, x.title, x.path, x.B, x.K, x.Vac, x.Delta]);

    // total (opsional) – berdasarkan agregat semua id
    const totals = summaryRows.reduce((acc, row) => {
      acc.B += row[4]; acc.K += row[5]; acc.Vac += row[6]; acc.Delta += row[7];
      return acc;
    }, {B:0,K:0,Vac:0,Delta:0});
    summaryRows.push(['TOTAL','','','', totals.B, totals.K, totals.Vac, totals.Delta]);

    const ws2 = XLSX.utils.aoa_to_sheet([
      ["id","parent_id","title","path","B","K","Vacant","Delta"],
      ...summaryRows
    ]);
    ws2['!cols'] = [
      {wch:18},{wch:18},{wch:36},{wch:70},
      {wch:8},{wch:8},{wch:10},{wch:8}
    ];

    // ---- write workbook
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws1, 'Hierarki');
    XLSX.utils.book_append_sheet(wb, ws2, 'Summary');
    XLSX.writeFile(wb, filename);
}

  
  document.getElementById('org_chart_xlsx_btn').addEventListener('click', () => {
    // exportExcelHierarchy(nodes, 'Peta-Jabatan-IAKN-PalangkaRaya.xlsx');
    exportExcelHierarchyWithSummaryV2(nodes, 'struktur-iakn-palangka-raya.xlsx');
  });
// -------- Build chart ----
  function chartOrg(listId){
    chart = new d3.OrgChart()
      .container("#"+listId)
      .data(nodes)
      .nodeWidth(()=>440)
      .nodeHeight(d => (d.data.rows||[]).length ? 72 + 30 + (d.data.rows.length * 26) : 72)
      .childrenMargin(()=>40)
      .compact(false)
      .nodeContent(nodeContent)
      .render();

    chart.layout('left').render().expandAll().fit(); // default bukaan root kiri, expand all, fit screen
  }
  function getJobChart(){
      const listId = 'org_chart';
      $("#"+listId).html(loadingElementImg);

      let payload = {}; payload['_dir'] = {}
      // console.log('payload',payload); return;
      axios.get(baseUrl+'/api/statistic/org/chart', {params: payload}, apiHeaders)
      .then(function (response) {
          console.log('[DATA] response..',response.data);
          if(response.data.status) {
              nodes = response.data.data;
              $("#"+listId).html(``);
              chartOrg(listId);
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

    
(function () {
    "use stirct";
    getJobChart();
})();

  