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
    const bTot = sum(rows,'b'), kTot = sum(rows,'k'), vac = Math.max(0,kTot-bTot);
    return `<div style="width:${d.width}px;border:1px solid #ccc;border-radius:8px;background:#fff;overflow:hidden">
              <div style="background:#eee;padding:8px 12px;font-weight:bold">
                ${title}
                <span style="float:right;background:${d.data.type==='fungsional'?'#10b981':'#2563eb'};color:#fff;border-radius:4px;padding:2px 6px;font-size:11px">
                  ${d.data.type==='fungsional'?'F':'S'}
                </span>
              </div>
              <div style="padding:4px 12px;font-size:12px;color:#555;display:flex;justify-content:space-between">
                <span>${subtitle}</span>
                <span style="background:#eef2ff;border-radius:4px;padding:2px 6px;font-size:11px">B:${bTot} · K:${kTot} · Vac:${vac}</span>
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
// ===== EXPORT EXCEL (Hierarki 1 sheet, outline per level) =====
  function exportExcelHierarchy(nodesArray, filename = 'peta-jabatan-hierarki.xlsx') {
    if (!window.XLSX) { alert('SheetJS (xlsx) belum termuat'); return; }

    // Build index & adjacency
    const byId = Object.fromEntries(nodesArray.map(n => [n.id, n]));
    const children = {};
    nodesArray.forEach(n => { if (n.parentId) (children[n.parentId] ||= []).push(n.id); });

    const out = [];
    function dfs(id, level, path) {
      const n = byId[id];
      const currentPath = [...path, n.title];
      const rows = Array.isArray(n.rows) ? n.rows : [];

      if (!rows.length) {
        // Tetap keluarkan 1 baris agar node tanpa rows muncul di Excel
        out.push({
          Path: currentPath.join(' / '),
          Unit: n.title || '',
          Subtitle: n.subtitle || '',
          Level: level,
          Jabatan: '',
          KLS: '',
          B: '',
          K: '',
          PlusMinus: '',
          Type: n.type || ''   // opsional: jika punya properti type
        });
      } else {
        rows.forEach(r => {
          out.push({
            Path: currentPath.join(' / '),
            Unit: n.title || '',
            Subtitle: n.subtitle || '',
            Level: level,
            Jabatan: r.jabatan ?? '',
            KLS: r.kls ?? '',
            B: r.b ?? '',
            K: r.k ?? '',
            PlusMinus: r.delta ?? '',
            Type: n.type || ''
          });
        });
      }

      (children[id] || []).forEach(cid => dfs(cid, level + 1, currentPath));
    }

    // Mulai dari semua root (tanpa parentId)
    nodesArray.filter(n => !n.parentId).forEach(root => dfs(root.id, 0, []));

    // Buat worksheet
    const header = ["Path","Unit","Subtitle","Level","Jabatan","KLS","B","K","+/-","Type"];
    const data = [header, ...out.map(r => [
      r.Path, r.Unit, r.Subtitle, r.Level, r.Jabatan, r.KLS, r.B, r.K, r.PlusMinus, r.Type
    ])];

    const ws = XLSX.utils.aoa_to_sheet(data);

    // Outline level per row (baris 0 = header, mulai level di baris 1)
    ws['!rows'] = [{}, ...out.map(r => ({ level: r.Level }))];

    // Lebar kolom biar nyaman dibaca
    ws['!cols'] = [
      { wch: 60 }, // Path
      { wch: 32 }, // Unit
      { wch: 24 }, // Subtitle
      { wch: 6  }, // Level
      { wch: 44 }, // Jabatan
      { wch: 6  }, // KLS
      { wch: 6  }, // B
      { wch: 6  }, // K
      { wch: 6  }, // +/-
      { wch: 10 }  // Type
    ];

    // Tulis file
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Hierarki');
    XLSX.writeFile(wb, filename);
  }
  
  document.getElementById('org_chart_xlsx_btn').addEventListener('click', () => {
    console.log('ayyyee')
    exportExcelHierarchy(nodes, 'Peta-Jabatan-IAKN-PalangkaRaya.xlsx');
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

    // chart.fit();
    // chart.expandAll(); // uncomment if you want everything open on load
    chart.collapseAll()
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

  