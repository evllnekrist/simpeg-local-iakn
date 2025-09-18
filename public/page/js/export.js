
/** Ambil data dari tabel HTML menjadi array 2D */
function tableToArray(tableEl) {
  const rows = Array.from(tableEl.querySelectorAll('tr'));
  return rows.map(tr => Array.from(tr.cells).map(td => td.innerText.trim()));
}

/** Tambah data 2D ke worksheet dengan style basic */
function appendTableToSheet(worksheet, data, opts = {}) {
  const { startRow = 1, startCol = 1, boldHeader = true } = opts;
  data.forEach((row, rIdx) => {
    const rowObj = worksheet.getRow(startRow + rIdx);
    row.forEach((val, cIdx) => {
      const cell = rowObj.getCell(startCol + cIdx);
      cell.value = isNaN(val.replace?.(/[%\s,]/g,'')) ? val : Number(val.replace(/[%\s,]/g,''));
      // align kanan utk angka
      if (typeof cell.value === 'number') cell.alignment = { horizontal: 'right' };
      // header tebal
      if (boldHeader && rIdx === 0) cell.font = { bold: true };
      // border tipis
      cell.border = { top:{style:'thin'}, left:{style:'thin'}, bottom:{style:'thin'}, right:{style:'thin'} };
    });
    rowObj.commit();
  });
  // auto width kolom
  const colCount = data[0]?.length || 0;
  for (let i=0;i<colCount;i++){
    const col = worksheet.getColumn(i+startCol);
    let max = 8;
    data.forEach(r => { max = Math.max(max, String(r[i] ?? '').length); });
    col.width = Math.min(60, Math.max(10, max + 2));
  }
}

/** Tambah gambar (base64 PNG) ke worksheet di posisi sel */
async function addImageToSheet(workbook, worksheet, base64Png, tlCell="H2", brCell="N20") {
  const imageId = workbook.addImage({ base64: base64Png, extension: 'png' });
  worksheet.addImage(imageId, { tl: { col: worksheet.getColumn(tlCell.replace(/[0-9]/g,'')).number-1, row: parseInt(tlCell.replace(/\D/g,''))-1 },
                                 br: { col: worksheet.getColumn(brCell.replace(/[0-9]/g,'')).number-1, row: parseInt(brCell.replace(/\D/g,''))-1 }});
}

/**
 * Export ke Excel: 1 sheet berisi tabel + gambar chart
 * @param {string} tableSelector - selector tabel (misal '#statsTable')
 * @param {string[]} chartCanvasSelectors - array selector canvas chart (misal ['#chartBar','#chartDonut'])
 * @param {string} fileName - nama file xlsx
 * @param {string} sheetName - nama sheet
 */
async function exportStatsToExcel(tableSelector, chartCanvasSelectors=[], fileName='statistik.xlsx', sheetName='Statistik') {
  const tableEl = document.querySelector(tableSelector);
  if (!tableEl) { alert('Tabel tidak ditemukan'); return; }

  // 1) Siapkan workbook & sheet
  const wb = new ExcelJS.Workbook();
  const ws = wb.addWorksheet(sheetName);
  ws.properties.defaultRowHeight = 22;
  // 2) Masukkan tabel
  const data = tableToArray(tableEl);
  appendTableToSheet(ws, data, { startRow: 1, startCol: 1, boldHeader: true });
//   ws.getCell('B1').value = 'Exported Statistics';
//   ws.getCell('B1').font = { bold: true, size: 14 };
  // 3) Tambahkan gambar chart (bila ada)
  // letakkan berderet ke kanan tabel
  let tlCols = ['H','N','T']; // posisi untuk beberapa chart
  for (let i=0;i<chartCanvasSelectors.length;i++){
    const canvas = document.querySelector(chartCanvasSelectors[i]);
    if (!canvas) continue;
    // gunakan background putih supaya tidak transparan di Excel
    const png = canvas.toDataURL('image/png');
    // rentang sel untuk gambar
    const tl = tlCols[i] ?? 'H';
    const br = String.fromCharCode((tl.charCodeAt(0)+5)) + '29'; // lebar kira-kira 6 kolom
    await addImageToSheet(wb, ws, png, `${tl}2`, br);
  }
  // 4) Generate & download
  const buf = await wb.xlsx.writeBuffer();
  saveAs(new Blob([buf], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" }), fileName);
}
