<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>d3-org-chart – with children</title>
    <!-- https://www.npmjs.com/package/d3-org-chart -->
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-org-chart@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <style>
        html, body { height:100%; margin:0; }
        #toolbar { padding:8px; border-bottom:1px solid #e5e7eb; display:flex; gap:8px; flex-wrap:wrap; }
        #org_chart { width:100%; height:calc(100vh - 48px); }
        button { padding:6px 10px; border:1px solid #d1d5db; border-radius:6px; background:#fff; cursor:pointer; }
        button:hover { background:#f3f4f6; }
    </style>
</head>
<body>
  <div id="toolbar">
    <button id="expandAllBtn">Expand All</button>
    <button id="collapseAllBtn">Collapse All</button>
    <button id="zoomInBtn">Zoom In</button>
    <button id="zoomOutBtn">Zoom Out</button>
    <button id="fitBtn">Fit</button>
    <button id="fsBtn">Fullscreen</button>
    <button id="org_chart_xlsx_btn">Export Excel</button>
  </div>
  <div id="org_chart"></div>
  <script>
    // ---- Helper to render node content (header + optional table) ----
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

    // ---- DATA: root + parents (with summary tables) + children (per job-family) ----
    const nodes = [
      { id: 'rektor', title: 'Rektor', subtitle: 'IAKN Palangka Raya', rows: [] },
      { parentId: 'rektor', id: 'kabiro-auak', title: 'Kepala Biro', subtitle: 'Administrasi Umum, Akademik dan Kemahasiswaan', rows: [] },
      { parentId: 'kabiro-auak', id: 'kjf-biro-auak',  title: 'Kelompok Jabatan Fungsional',
        rows: [
          { jabatan:'Analis SDM Aparatur Ahli Madya', kls:12, b:0, k:0, delta:0 },
          { jabatan:'Pengelola Pengadaan Barang/Jasa Ahli Madya', kls:12, b:0, k:0, delta:0 },
          { jabatan:'Perencana Ahli Madya', kls:12, b:0, k:0, delta:0 },
          { jabatan:'Analis Pengelolaan Keuangan APBN Ahli Madya', kls:12, b:0, k:0, delta:0 },
          { jabatan:'Analis Kebijakan Ahli Madya', kls:12, b:0, k:0, delta:0 },
          { jabatan:'Analis Anggaran Ahli Madya', kls:12, b:0, k:0, delta:0 },
        ]
      },
      { parentId: 'kabiro-auak', id: 'kjp-biro-auak',  title: 'Kelompok Jabatan Pelaksana',
        rows: [
          { jabatan:'Pranata Hubungan Masyarakat Ahli Muda', kls:9, b:0, k:0, delta:0 },
          { jabatan:'Pranata Keuangan APBN Penyelia', kls:9, b:0, k:0, delta:0 },
          { jabatan:'Analis SDM Aparatur Ahli Pertama', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Analis Pengelolaan Keuangan APBN Ahli Pertama', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Perencana Ahli Pertama', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Analis Kebijakan Ahli Pertama', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Perancang Peraturan Perundang-undangan Ahli Pertama', kls:8, b:0, k:0, delta:0 },
        ]
      },
      { parentId: 'kabiro-auak', id: 'kabag-ula',  title: 'Kepala Bagian',  subtitle: 'Umum dan Layanan Akademik',  rows: [] },
      { parentId: 'kabag-ula', id: 'kjf-bag-ula',  title: 'Kelompok Jabatan Fungsional',
        rows: [
          { jabatan:'Analis SDM Aparatur Ahli Madya', kls:9, b:2, k:0, delta:-2 },
          { jabatan:'Pengelola Pengadaan Barang/Jasa Ahli Madya', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Perencana Ahli Madya', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Analis Pengelolaan Keuangan APBN Ahli Madya', kls:8, b:0, k:0, delta:0 },
          { jabatan:'Analis Kebijakan Ahli Madya', kls:8, b:0, k:0, delta:0 },
        ]
      },
      { parentId: 'kabag-ula', id: 'kjp-bag-ula',  title: 'Kelompok Jabatan Pelaksana',
        rows: [
          { jabatan:'Pranata Hubungan Masyarakat Ahli Muda', kls:7, b:2, k:0, delta:-2 },
          { jabatan:'Pranata Keuangan APBN Penyelia', kls:7, b:1, k:0, delta:-1 },
          { jabatan:'Analis SDM Aparatur Ahli Pertama', kls:7, b:1, k:0, delta:-1 },
          { jabatan:'Analis Pengelolaan Keuangan APBN Ahli Pertama', kls:7, b:1, k:0, delta:-1 },
          { jabatan:'Perencana Ahli Pertama', kls:7, b:1, k:0, delta:-1 },
          { jabatan:'Analis Kebijakan Ahli Pertama', kls:7, b:1, k:0, delta:-1 },
          { jabatan:'Perancang Peraturan Perundang-undangan Ahli Pertama', kls:6, b:1, k:1, delta:0 },
          { jabatan:'Perancang Peraturan Perundang-undangan Ahli Pertama', kls:5, b:3, k:2, delta:-1 },
        ]
      },
    ];

    // ---- Build chart ----
    const chart = new d3.OrgChart()
      .container('#org_chart')
      .data(nodes)
      .nodeWidth(()=>440)
      .nodeHeight(d => (d.data.rows||[]).length ? 72 + 30 + (d.data.rows.length * 26) : 72)
      .childrenMargin(()=>40)
      .compact(false)
      .nodeContent(nodeContent)
      .render();

    chart.fit();
    // chart.expandAll(); // uncomment if you want everything open on load

    // ---- toolbar actions ----
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

    // Fullscreen toggle (container)
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

    // ---- Export Excel (hierarki satu sheet dengan outline level) ----
    function flattenHierarchy(dataArray) {
      // build map for parent traversal
      const byId = Object.fromEntries(dataArray.map(n => [n.id, n]));
      // children lists
      const children = {};
      dataArray.forEach(n => {
        if (n.parentId) {
          (children[n.parentId] ||= []).push(n.id);
        }
      });

      const out = [];
      function dfs(id, level, path) {
        const n = byId[id];
        const currentPath = [...path, n.title];
        const rows = n.rows || [];
        if (!rows.length) {
          // tetap keluarkan baris kosong agar node terlihat di Excel
          out.push({ Path: currentPath.join(' / '), Unit: n.title, Subtitle: n.subtitle||'', Level: level, Jabatan:'', KLS:'', B:'', K:'', PlusMinus:'', Type: n.type||'' });
        } else {
          rows.forEach(r=>{
            out.push({
              Path: currentPath.join(' / '),
              Unit: n.title,
              Subtitle: n.subtitle || '',
              Level: level,
              Jabatan: r.jabatan,
              KLS: r.kls ?? '',
              B: r.b ?? '',
              K: r.k ?? '',
              PlusMinus: r.delta ?? '',
              Type: n.type || ''
            });
          });
        }
        (children[id]||[]).forEach(cid => dfs(cid, level+1, currentPath));
      }
      // roots (no parentId)
      dataArray.filter(n => !n.parentId).forEach(root => dfs(root.id, 0, []));
      return out;
    }

    document.getElementById('org_chart_xlsx_btn').addEventListener('click', () => {
      if (!window.XLSX) { alert('SheetJS (xlsx) belum termuat'); return; }
      const rows = flattenHierarchy(nodes);
      const header = ["Path","Unit","Subtitle","Level","Jabatan","KLS","B","K","+/-","Type"];
      const table = [header, ...rows.map(r => [r.Path,r.Unit,r.Subtitle,r.Level,r.Jabatan,r.KLS,r.B,r.K,r.PlusMinus,r.Type])];
      const ws = XLSX.utils.aoa_to_sheet(table);
      // outline levels per row (Excel grouping)
      ws['!rows'] = [ {}, ...rows.map(r => ({ level: r.Level })) ];
      ws['!cols'] = [
        {wch:60},{wch:28},{wch:22},{wch:6},{wch:40},
        {wch:6},{wch:6},{wch:6},{wch:6},{wch:10}
      ];
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, 'Hierarki');
      XLSX.writeFile(wb, 'peta-jabatan-hierarki.xlsx');
    });

  </script>
</body>
</html>
