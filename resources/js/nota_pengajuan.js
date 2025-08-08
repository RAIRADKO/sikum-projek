document.addEventListener('DOMContentLoaded', function() {
    
    const notaForm = document.getElementById('notaPengajuanForm');
    if (notaForm) {
        notaForm.addEventListener('submit', handlePrint);
    }

    // --- FUNCTIONS ---

    /**
     * Handles the form submission to generate and trigger printing.
     * @param {Event} event - The form submission event.
     */
    function handlePrint(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());

        const printContent = generatePrintableHTML(data);
        
        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContent);
        printWindow.document.close();
    }

    /**
     * Generates the HTML content for the print window.
     * @param {object} data - The form data as a key-value object.
     * @returns {string} - The complete HTML string for printing.
     */
    function generatePrintableHTML(data) {
        return `
            <!DOCTYPE html>
            <html lang="id">
            <head>
                <meta charset="UTF-8">
                <title>Nota Pengajuan SK - Cetak</title>
                <style>
                    body {
                        margin: 0;
                        padding: 20px;
                        font-family: 'Bookman Old Style', serif;
                        font-size: 12pt;
                        line-height: 1.5;
                    }
                    @media print {
                        @page { 
                            margin: 2cm; 
                            size: A4;
                        }
                    }
                    .kop-container {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .kop-image {
                        width: 100%;
                        max-width: 700px;
                        height: auto;
                    }
                    .print-header {
                        text-align: center;
                        text-transform: uppercase;
                        margin: 20px 0 40px;
                        font-size: 16pt;
                        font-weight: bold;
                        text-decoration: underline;
                    }
                    .content-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 30px;
                    }
                    .content-table td {
                        padding: 4px 0;
                        vertical-align: top;
                    }
                    .content-table td:nth-child(1) { width: 22%; }
                    .content-table td:nth-child(2) { width: 3%; }
                    .signature-area {
                        margin-top: 50px;
                        width: 50%;
                        float: right;
                        text-align: center;
                    }
                    .signature-name {
                        font-weight: bold;
                        text-decoration: underline;
                        margin-top: 80px;
                    }
                    .document-code {
                        position: absolute;
                        bottom: 2cm;
                        left: 2cm;
                        font-size: 10pt;
                        color: #555;
                    }
                </style>
            </head>
            <body>
                <div class="kop-container">
                    <img src="https://via.placeholder.com/800x120/ffffff/000000?text=KOP+SURAT+INSTANSI" alt="Kop Surat" class="kop-image">
                </div>
                
                <div class="print-header">NOTA PENGAJUAN</div>
                
                <table class="content-table">
                    <tr><td>Ditujukan Kepada</td><td>:</td><td>${data.tkpd}</td></tr>
                    <tr><td>Melalui</td><td>:</td><td>${data.tmll}</td></tr>
                    <tr>
                        <td>Lewat</td><td>:</td>
                        <td>
                            ${data.tnomor || ''} ${data.tlwt || ''}<br>
                            ${data.tnomor2 || ''} ${data.tlwt2 || ''}
                        </td>
                    </tr>
                    <tr><td>Dari</td><td>:</td><td>${data.tdari}</td></tr>
                    <tr>
                        <td>Perihal</td><td>:</td>
                        <td>
                            ${data.tjudul2}<br>
                            <strong>${data.tjudul}</strong>
                        </td>
                    </tr>
                    <tr><td>Mohon untuk</td><td>:</td><td>${data.tmohon}</td></tr>
                    <tr><td>Tanda Tangan</td><td>:</td><td>${data.tttd}</td></tr>
                    <tr>
                        <td style="vertical-align: top;">Lain-lain</td>
                        <td style="vertical-align: top;">:</td>
                        <td>
                            ${data.t || ''} ${data.tlain || ''}<br>
                            ${data.t2 || ''} ${data.tlain2 || ''}<br>
                            ${data.t3 || ''} ${data.tlain3 || ''}
                        </td>
                    </tr>
                </table>
                
                <div class="signature-area">
                    <div>${data.ttgl}</div>
                    <div>${data.tkabag}</div>
                    <div>${data.tkabag2}</div>
                    <div class="signature-name">${data.tkabag3}</div>
                    <div>${data.tkabag4}</div>
                    <div>NIP. ${data.tnip.replace('NIP. ', '')}</div>
                </div>
                
                <div class="document-code">
                    Kode: ${data.tkode}
                </div>
                
                <script>
                    window.onload = () => window.print();
                <\/script>
            </body>
            </html>
        `;
    }
});