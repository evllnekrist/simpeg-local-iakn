<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Peta Jabatan – D3.js (Vertikal, Tabel, Pagination, Ekspor)</title>
  <style>
    :root {
      --bg: #ffffff; --card: #ffffff; --text: #000000; --muted: #444444; --line: #cccccc;
      --header: #f3f4f6; --accent: #2f80ed; --accent2: #10b981; --vacant: #f59e0b; --hilite: #d1fae5;
    }
    html, body { height:100%; margin:0; background:var(--bg); color:var(--text); font-family: ui-sans-serif, system-ui, Segoe UI, Roboto, Helvetica, Arial; }
    header { padding: 14px 18px; display:flex; flex-wrap:wrap; gap:10px; align-items:center; justify-content:space-between; border-bottom:1px solid var(--line); background:#fafafa; position:sticky; top:0; z-index:10; }
    .title { font-weight:700; letter-spacing:.3px; font-size:18px; }
    .controls { display:flex; flex-wrap:wrap; gap:8px; align-items:center; }
    .btn { background:#fff; color:#000; border:1px solid #ccc; padding:6px 10px; border-radius:6px; cursor:pointer; }
    .btn:hover { background:#f0f0f0; }
    .legend { display:flex; gap:14px; flex-wrap:wrap; align-items:center; font-size:12px; color:var(--muted); }
    .legend .item { display:inline-flex; align-items:center; gap:6px; }
    .swatch { width:12px; height:12px; border-radius:3px; display:inline-block; }
    .container { height: calc(100% - 64px); }

    .tooltip { position:fixed; pointer-events:none; background:#fff; color:#000; border:1px solid #ccc; padding:6px 8px; border-radius:6px; font-size:12px; box-shadow:0 4px 12px rgba(0,0,0,.2); }

    .node-title { font-weight:800; font-size:12px; fill:#000; }
    .node-sub { font-size:11px; fill: var(--muted); }
    .node-rect { fill: var(--card); stroke: var(--line); rx:8; ry:8; }

    .tbl-head { fill: var(--header); }
    .tbl-text { font-size:11px; fill: #000; }
    .tbl-muted { font-size:10px; fill: var(--muted); }
    .tbl-grid { stroke: var(--line); stroke-width:1; }
    .tbl-highlight { fill: var(--hilite); fill-opacity:.9; }

    .badge { font-size:10px; font-weight:800; fill:#000; }
    .chip { font-size:10px; font-weight:700; fill:#111827; }
    .link { fill:none; stroke:#aaa; stroke-width:1.2px; }
  </style>
</head>
<body>
  <header>
    <div class="title">Peta Jabatan – D3.js (Vertikal + Pagination + Ekspor)</div>
    <div class="controls">
      <button class="btn" id="fitBtn">Fit ke Layar</button>
      <button class="btn" id="expandAllBtn">Expand Semua</button>
      <button class="btn" id="collapseAllBtn">Collapse Semua</button>
      <button class="btn" id="pngBtn">Export PNG</button>
      <button class="btn" id="pdfBtn">Export PDF</button>
      <button class="btn" id="svgBtn">Export SVG</button>
      <div class="legend">
        <span class="item"><span class="swatch" style="background: var(--accent)"></span> Struktural</span>
        <span class="item"><span class="swatch" style="background: var(--accent2)"></span> Fungsional</span>
        <span class="item"><span class="swatch" style="background: var(--vacant)"></span> Kosong</span>
        <span class="item"><span class="swatch" style="background: var(--hilite)"></span> Baris disorot</span>
      </div>
    </div>
  </header>
  <div class="container" id="chart"></div>

  <script src="https://cdn.jsdelivr.net/npm/d3@7/dist/d3.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jspdf@2.5.1/dist/jspdf.umd.min.js"></script>
  <script>
  // ===== UTIL =====
  const sumB = rows => rows.reduce((a,r)=>a+(+r.b||0),0);
  const sumK = rows => rows.reduce((a,r)=>a+(+r.k||0),0);
  const sumVacant = rows => Math.max(0, sumK(rows) - sumB(rows));

  // ===== DATA (diperluas sampai mencakup jurusan & prodi) =====
  const data = {
    id:'dir', title:'REKTOR', subtitle:'IAKN PALANGKA RAYA', type:'struktural', pageSize: 10,
    rows:[],
    children:[
      {
        id:'biro-auak', title:'Biro Administrasi Umum, Akademik dan Kemahasiswaan', type:'struktural', pageSize:8,
        rows:[
          { jabatan:'Arsiparis Muda', kls:'9', b:0, k:0, delta:0 },
          { jabatan:'Pengembang Teknologi Pembelajaran Muda', kls:'9', b:0, k:0, delta:0 },
          { jabatan:'Pranata Komputer Muda', kls:'9', b:0, k:0, delta:0 }
        ],
        children:[
          {
            id:'bagAAK', title:'Bag. Adm. Akademik & Kemahasiswaan, Perencanaan, dan Sistem Informasi', subtitle:'Kelas 9', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Analis Data dan Informasi', kls:'7', b:1, k:0, delta:+1, highlight:true },
              { jabatan:'Arsiparis Ahli', kls:'7', b:0, k:1, delta:0 },
              { jabatan:'Pranata Komputer Ahli', kls:'7', b:1, k:0, delta:0 },
              { jabatan:'Pustakawan Ahli', kls:'6', b:2, k:0, delta:0 },
              { jabatan:'Pengolah Data', kls:'6', b:1, k:0, delta:0 },
              { jabatan:'Sekretaris', kls:'6', b:1, k:0, delta:0 },
              { jabatan:'Pustakawan', kls:'6', b:1, k:0, delta:0 },
              { jabatan:'Pengadministrasi Umum', kls:'5', b:2, k:0, delta:0 },
              { jabatan:'Pramubakti', kls:'3', b:1, k:0, delta:0 }
            ]
          }
        ]
      },
      // ===== Pembantu Direktur II =====
      {
        id:'pd2', title:'Pembantu Direktur II', type:'struktural', pageSize:8,
        rows:[
          { jabatan:'Analis Pengawasan BMN', kls:'7', b:0, k:1, delta:-1 },
          { jabatan:'Bendahara', kls:'7', b:1, k:0, delta:0 },
          { jabatan:'Pranata Komputer Ahli', kls:'7', b:2, k:0, delta:0 }
        ],
        children:[
          {
            id:'subKepeg', title:'Kepala Subbagian Administrasi Kepegawaian', subtitle:'Kelas 9', type:'struktural', pageSize:8,
            rows:[
              { jabatan:'Analis Kepegawaian Ahli', kls:'7', b:1, k:1, delta:-1 },
              { jabatan:'Analis Hukum', kls:'7', b:0, k:1, delta:0 },
              { jabatan:'Pengadministrasi Kepegawaian', kls:'5', b:1, k:0, delta:0 }
            ]
          }
        ]
      },
      // ===== Pembantu Direktur III =====
      {
        id:'pd3', title:'Pembantu Direktur III', type:'struktural', pageSize:8,
        rows:[
          { jabatan:'Perencana', kls:'7', b:0, k:1, delta:-1 },
          { jabatan:'Pengadministrasi Keuangan', kls:'6', b:0, k:2, delta:0 },
          { jabatan:'Pengelola BMN', kls:'6', b:0, k:2, delta:0 },
          { jabatan:'Pengolah Data', kls:'6', b:1, k:0, delta:0 }
        ], children:[]
      },

      // ===== Klaster Jurusan & Prodi =====
      {
        id:'jurusan', title:'Ketua Jurusan & Program Studi', subtitle:'Ringkasan Keperawatan • Kebidanan • Gizi', type:'struktural', pageSize:10,
        rows:[
          { jabatan:'Ketua Jurusan Keperawatan (Lektor Kepala)', kls:'11', b:1, k:0, delta:0, highlight:true },
          { jabatan:'Ketua Prodi DIII Keperawatan', kls:'9', b:1, k:0, delta:0 },
          { jabatan:'Ketua Prodi DIV Keperawatan', kls:'9', b:1, k:0, delta:0 },
          { jabatan:'Ketua Jurusan Kebidanan (Lektor Kepala)', kls:'11', b:1, k:0, delta:0, highlight:true },
          { jabatan:'Ketua Prodi DIII Kebidanan', kls:'9', b:1, k:0, delta:0 },
          { jabatan:'Ketua Prodi DIV Kebidanan', kls:'9', b:1, k:0, delta:0 },
          { jabatan:'Ketua Jurusan Gizi (Lektor Kepala)', kls:'11', b:1, k:0, delta:0, highlight:true },
          { jabatan:'Ketua Prodi DIII Gizi', kls:'9', b:1, k:0, delta:0 },
          { jabatan:'Ketua Prodi DIV Gizi', kls:'9', b:1, k:0, delta:0 }
        ],
        children:[
          // === KESEHATAN: KEperawatan ===
          {
            id:'prodi_d3_keperawatan', title:'Ketua Prodi DIII Keperawatan', subtitle:'Detail Formasi', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Lektor', kls:'9', b:0, k:0, delta:0 },
              { jabatan:'Asisten Ahli', kls:'8', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Muda', kls:'8', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pertama', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Penyelia', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana Lanjutan', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Dosen', kls:'7', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana', kls:'6', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pemula', kls:'5', b:0, k:0, delta:0 }
            ]
          },
          {
            id:'prodi_d4_keperawatan', title:'Ketua Prodi DIV Keperawatan', subtitle:'Detail Formasi', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Lektor', kls:'9', b:0, k:0, delta:0 },
              { jabatan:'Asisten Ahli', kls:'8', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Muda', kls:'8', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pertama', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Penyelia', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Dosen', kls:'7', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana', kls:'6', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pemula', kls:'5', b:0, k:0, delta:0 }
            ]
          },

          // === KEBIDANAN ===
          {
            id:'prodi_d3_kebidanan', title:'Ketua Prodi DIII Kebidanan', subtitle:'Detail Formasi', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Lektor', kls:'9', b:0, k:0, delta:0 },
              { jabatan:'Asisten Ahli', kls:'8', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Muda', kls:'8', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pertama', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Dosen', kls:'7', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana', kls:'6', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pemula', kls:'5', b:0, k:0, delta:0 }
            ]
          },
          {
            id:'prodi_d4_kebidanan', title:'Ketua Prodi DIV Kebidanan', subtitle:'Detail Formasi', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Lektor', kls:'9', b:0, k:0, delta:0 },
              { jabatan:'Asisten Ahli', kls:'8', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Muda', kls:'8', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pertama', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Dosen', kls:'7', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana', kls:'6', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pemula', kls:'5', b:0, k:0, delta:0 }
            ]
          },

          // === GIZI ===
          {
            id:'prodi_d3_gizi', title:'Ketua Prodi DIII Gizi', subtitle:'Detail Formasi', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Lektor', kls:'9', b:0, k:0, delta:0 },
              { jabatan:'Asisten Ahli', kls:'8', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Muda', kls:'8', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pertama', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Dosen', kls:'7', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana', kls:'6', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pemula', kls:'5', b:0, k:0, delta:0 }
            ]
          },
          {
            id:'prodi_d4_gizi', title:'Ketua Prodi DIV Gizi', subtitle:'Detail Formasi', type:'struktural', pageSize:10,
            rows:[
              { jabatan:'Lektor', kls:'9', b:0, k:0, delta:0 },
              { jabatan:'Asisten Ahli', kls:'8', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Muda', kls:'8', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pertama', kls:'7', b:0, k:0, delta:0 },
              { jabatan:'Dosen', kls:'7', b:2, k:0, delta:0, highlight:true },
              { jabatan:'Pranata Lab. Pendidikan Pelaksana', kls:'6', b:0, k:0, delta:0 },
              { jabatan:'Pranata Lab. Pendidikan Pemula', kls:'5', b:0, k:0, delta:0 }
            ]
          }
        ]
      }
    ]
  };

  // ===== RENDER =====
  const container = document.getElementById('chart');
  const width = container.clientWidth; const height = container.clientHeight;
  const svg = d3.select('#chart').append('svg').attr('width', width).attr('height', height).attr('viewBox', [0,0,width,height]).style('display','block');
  const g = svg.append('g');
  const zoom = d3.zoom().scaleExtent([0.3,2.5]).on('zoom',(ev)=>g.attr('transform',ev.transform)); svg.call(zoom);
  const dx = 360, dy = 200; const tree = d3.tree().nodeSize([dx,dy]); const diagonal = d3.linkVertical().x(d=>d.x).y(d=>d.y);
  const root = d3.hierarchy(data); root.x0 = width/2; root.y0 = 0; root.children && root.children.forEach(collapse);
  function collapse(d){ if(d.children){ d._children = d.children; d._children.forEach(collapse); d.children=null; } }

  const tooltip = d3.select('body').append('div').attr('class','tooltip').style('opacity',0);
  const getCSS = (v)=>getComputedStyle(document.documentElement).getPropertyValue(v);
  const colorByType = (d)=> d.data.type==='fungsional'?getCSS('--accent2'):getCSS('--accent');

  function nodeSizeFor(d){ const base = 76, rowH = 22; const rows = (d.data.rows||[]).length; const pageSize = d.data.pageSize||10; const visible = Math.min(rows, pageSize); return { w: 460, h: base + visible*rowH + 18 }; }
  function pageInfo(d){ const rows = d.data.rows||[]; const size = d.data.pageSize||10; const pages = Math.max(1, Math.ceil(rows.length/size)); const page = Math.min(pages, Math.max(1, d.data._page||1)); return {page,pages,size}; }
  function rowsForPage(d){ const rows = d.data.rows||[]; const {page,size} = pageInfo(d); const start=(page-1)*size; return rows.slice(start,start+size); }

  function drawTable(sel,d){ const {w,h}=nodeSizeFor(d); const pad=12;
    sel.append('rect').attr('class','node-rect').attr('x',-w/2).attr('y',-h/2).attr('width',w).attr('height',h);
    sel.append('rect').attr('x',-w/2).attr('y',-h/2).attr('width',w).attr('height',36).attr('fill',getCSS('--header')).attr('stroke',getCSS('--line'));
    sel.append('text').attr('class','node-title').attr('x',-w/2+10).attr('y',-h/2+22).attr('text-anchor','start').text(d.data.title);
    if(d.data.subtitle){ sel.append('text').attr('class','node-sub').attr('x',-w/2+10).attr('y',-h/2+38).attr('text-anchor','start').text(d.data.subtitle); }
    sel.append('rect').attr('x', w/2 - 60).attr('y', -h/2 + 8).attr('rx',6).attr('ry',6).attr('width', 44).attr('height', 18).attr('fill', colorByType(d));
    sel.append('text').attr('class','badge').attr('x', w/2 - 38).attr('y', -h/2 + 21).attr('text-anchor','middle').text(d.data.type==='fungsional'?'F':'S');

    const bTot = sumB(d.data.rows||[]), kTot = sumK(d.data.rows||[]), vTot = Math.max(0,kTot-bTot);
    const badgeX = w/2 - 200, badgeY = -h/2 + 8;
    sel.append('rect').attr('x', badgeX).attr('y', badgeY).attr('rx',6).attr('ry',6).attr('width', 126).attr('height', 18).attr('fill', '#eef2ff').attr('stroke', getCSS('--line'));
    sel.append('text').attr('class','tbl-text').attr('x', badgeX+63).attr('y', badgeY+13).attr('text-anchor','middle').text(`B:${bTot}  K:${kTot}  Vac:${vTot}`);

    const pi = pageInfo(d);
    if(pi.pages>1){ sel.append('rect').attr('x', -w/2 + 10).attr('y', -h/2 + 8).attr('rx',4).attr('ry',4).attr('width', 20).attr('height', 18).attr('fill', '#e5e7eb').attr('stroke', getCSS('--line')).style('cursor','pointer').on('click', ()=>{ d.data._page = Math.max(1,(d.data._page||1)-1); update(d); }); sel.append('text').attr('x', -w/2 + 20).attr('y', -h/2 + 21).attr('text-anchor','middle').attr('class','tbl-text').text('◀'); sel.append('rect').attr('x', -w/2 + 34).attr('y', -h/2 + 8).attr('rx',4).attr('ry',4).attr('width', 52).attr('height', 18).attr('fill', '#fff').attr('stroke', getCSS('--line')); sel.append('text').attr('x', -w/2 + 60).attr('y', -h/2 + 21).attr('text-anchor','middle').attr('class','tbl-text').text(`${pi.page}/${pi.pages}`); sel.append('rect').attr('x', -w/2 + 90).attr('y', -h/2 + 8).attr('rx',4).attr('ry',4).attr('width', 20).attr('height', 18).attr('fill', '#e5e7eb').attr('stroke', getCSS('--line')).style('cursor','pointer').on('click', ()=>{ d.data._page = Math.min(pi.pages,(d.data._page||1)+1); update(d); }); sel.append('text').attr('x', -w/2 + 100).attr('y', -h/2 + 21).attr('text-anchor','middle').attr('class','tbl-text').text('▶'); }

    const col = [ -w/2 + pad, w/2 - (pad + 140), w/2 - (pad + 104), w/2 - (pad + 68), w/2 - (pad + 26) ];
    const headY = -h/2 + 58; sel.append('rect').attr('x', -w/2 + 1).attr('y', headY - 18).attr('width', w - 2).attr('height', 26).attr('fill', getCSS('--header')).attr('stroke', getCSS('--line'));
    sel.append('text').attr('class','tbl-text').attr('x', col[0]).attr('y', headY).text('Jabatan'); sel.append('text').attr('class','tbl-text').attr('x', col[1]).attr('y', headY).text('KLS'); sel.append('text').attr('class','tbl-text').attr('x', col[2]).attr('y', headY).text('B'); sel.append('text').attr('class','tbl-text').attr('x', col[3]).attr('y', headY).text('K'); sel.append('text').attr('class','tbl-text').attr('x', col[4]).attr('y', headY).text('+/-');
    sel.append('line').attr('class','tbl-grid').attr('x1', col[1]-8).attr('y1', headY-18).attr('x2', col[1]-8).attr('y2', h/2 - 12);
    sel.append('line').attr('class','tbl-grid').attr('x1', col[2]-8).attr('y1', headY-18).attr('x2', col[2]-8).attr('y2', h/2 - 12);
    sel.append('line').attr('class','tbl-grid').attr('x1', col[3]-8).attr('y1', headY-18).attr('x2', col[3]-8).attr('y2', h/2 - 12);
    sel.append('line').attr('class','tbl-grid').attr('x1', col[4]-12).attr('y1', headY-18).attr('x2', col[4]-12).attr('y2', h/2 - 12);

    const rows = rowsForPage(d); let y = headY + 22;
    rows.forEach(r=>{ if(r.highlight){ sel.append('rect').attr('class','tbl-highlight').attr('x', -w/2 + 1).attr('y', y-16).attr('width', w-2).attr('height', 22); }
      sel.append('text').attr('class','tbl-muted').attr('x', col[0]).attr('y', y).text(r.jabatan);
      sel.append('text').attr('class','tbl-muted').attr('x', col[1]).attr('y', y).text(r.kls??'');
      sel.append('text').attr('class','tbl-muted').attr('x', col[2]).attr('y', y).text(r.b??'');
      sel.append('text').attr('class','tbl-muted').attr('x', col[3]).attr('y', y).text(r.k??'');
      sel.append('text').attr('class','tbl-muted').attr('x', col[4]).attr('y', y).text(r.delta??'');
      sel.append('line').attr('class','tbl-grid').attr('x1', -w/2 + 1).attr('y1', y + 6).attr('x2', w/2 - 1).attr('y2', y + 6);
      y += 22; });
  }

  function update(source){ const nodes = root.descendants().reverse(); const links = root.links(); tree(root); const t = svg.transition().duration(400);
    const node = g.selectAll('g.node').data(nodes, d=>d.id || (d.id = d.data.id));
    const nodeEnter = node.enter().append('g').attr('class','node').attr('transform', d=>`translate(${source.x0},${source.y0})`).style('cursor','pointer')
      .on('click', (_e,d)=>{ d.children = d.children ? null : d._children; d._children = d.children ? null : d._children; update(d); })
      .on('mousemove', (ev,d)=>{ const b=sumB(d.data.rows||[]), k=sumK(d.data.rows||[]), v=Math.max(0,k-b); tooltip.style('opacity',1).html(`<b>${d.data.title}</b><div>${d.data.subtitle||''}</div><div>B:${b} K:${k} Vac:${v}</div><div style=\"opacity:.8\">Klik untuk expand/collapse</div>`).style('left',(ev.clientX+12)+'px').style('top',(ev.clientY+12)+'px'); })
      .on('mouseleave', ()=>tooltip.style('opacity',0));
    nodeEnter.each(function(d){ d3.select(this).call(sel=>drawTable(sel, d)); });
    nodeEnter.merge(node).transition(t).attr('transform', d=>`translate(${d.x},${d.y})`);
    node.exit().transition(t).attr('transform', d=>`translate(${source.x},${source.y})`).remove();
    const link = g.selectAll('path.link').data(links, d=>d.target.id);
    link.enter().append('path').attr('class','link').attr('d', d=>{ const o={x:source.x0,y:source.y0}; return diagonal({source:o,target:o}); }).merge(link).transition(t).attr('d', diagonal);
    link.exit().transition(t).attr('d', d=>{ const o={x:source.x,y:source.y}; return diagonal({source:o,target:o}); }).remove();
    root.eachBefore(d=>{ d.x0=d.x; d.y0=d.y; }); }

  function fitToScreen(padding=60){ const b=g.node().getBBox(); const fw=svg.node().clientWidth, fh=svg.node().clientHeight; const w=b.width+padding*2, h=b.height+padding*2; const midX=b.x+b.width/2, midY=b.y+b.height/2; const s=Math.max(0.3, Math.min(2.0, 0.9/Math.max(w/fw, h/fh))); const t=[fw/2 - s*midX, fh/2 - s*midY]; svg.transition().duration(500).call(zoom.transform, d3.zoomIdentity.translate(t[0],t[1]).scale(s)); }
  function expandAll(d=root){ if(d._children){ d.children=d._children; d._children=null; } if(d.children) d.children.forEach(expandAll); }
  function collapseAll(d=root){ if(d.children){ d.children.forEach(collapseAll); d._children=d.children; d.children=null; } }

  document.getElementById('fitBtn').addEventListener('click', ()=>fitToScreen());
  document.getElementById('expandAllBtn').addEventListener('click', ()=>{ expandAll(); update(root); fitToScreen(); });
  document.getElementById('collapseAllBtn').addEventListener('click', ()=>{ collapseAll(); update(root); fitToScreen(); });

  // EXPORT
  document.getElementById('pngBtn').addEventListener('click', async ()=>{ const node=document.getElementById('chart'); const canvas=await html2canvas(node,{backgroundColor:'#ffffff',useCORS:true,scale:2}); const dataURL=canvas.toDataURL('image/png'); const a=document.createElement('a'); a.href=dataURL; a.download='peta-jabatan.png'; a.click(); });
  document.getElementById('pdfBtn').addEventListener('click', async ()=>{ const node=document.getElementById('chart'); const canvas=await html2canvas(node,{backgroundColor:'#ffffff',useCORS:true,scale:2}); const img=canvas.toDataURL('image/png'); const { jsPDF }=window.jspdf; const pdf=new jsPDF({orientation:'landscape',unit:'pt',format:[canvas.width,canvas.height]}); pdf.addImage(img,'PNG',0,0,canvas.width,canvas.height); pdf.save('peta-jabatan.pdf'); });
  document.getElementById('svgBtn').addEventListener('click', ()=>{ const serializer=new XMLSerializer(); const svgNode=document.querySelector('#chart svg'); let source=serializer.serializeToString(svgNode); if(!source.match(/^<svg[^>]+xmlns=\"http:\/\/www\.w3\.org\/2000\/svg\"/)) source=source.replace('<svg','<svg xmlns="http://www.w3.org/2000/svg"'); if(!source.match(/^<svg[^>]+xmlns:xlink=\"http:\/\/www\.w3\.org\/1999\/xlink\"/)) source=source.replace('<svg','<svg xmlns:xlink="http://www.w3.org/1999/xlink"'); const url='data:image/svg+xml;charset=utf-8,'+encodeURIComponent(source); const a=document.createElement('a'); a.href=url; a.download='peta-jabatan.svg'; a.click(); });

  update(root); setTimeout(()=>fitToScreen(), 300);
  const ro=new ResizeObserver(()=>{ const w=container.clientWidth, h=container.clientHeight; svg.attr('width',w).attr('height',h).attr('viewBox',[0,0,w,h]); fitToScreen(); }); ro.observe(container);
  </script>
</body>
</html>
