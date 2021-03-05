<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Laporan_model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->load->library('pdf'); // panggil library pdf yang telah dibuat
        $this->laporan_model = new Laporan_model();

    }


    Public function cetakpdf(){

        //SCRIPT UNTUK MENGHASILKAN FILE PDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false); // generate PDF

        $pdf->SetTitle('Laporan-Transaksi-pdf'); // TITLE pada HTML
        $pdf->SetTopMargin(20);  // Margin atas
        $pdf->setFooterMargin(10); // Margin Bawah 
        // margin kanan dan kiri
        $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT, '10');  
        $pdf->SetAutoPageBreak(true); // membuat page break otomatis
        // menampilkan garis pada header
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        
        $pdf->SetDisplayMode('real', 'default');
        // menambahkan halaman 
        $pdf->AddPage('P'); // (L, untuk lanscape P utk Portrait)

        // Judul di header pdf, diawali dengan posisi dari batas atas
        $pdf->Write(10, 'Laporan Penjualan + tcpdf');

        // ISI PDF 
        $html = '<br><br> <h1> HALAMAN CETAK PDF </h1> 
                 <br><br> Ini adalah isi PDF </br>';

        //menulis isi kedalam file PDF 
        $pdf->Writehtml($html);

        // mengahasilkan outputfile PDF berisi nama file , dan perintah pada browser
        $pdf->Output('Laporan-Transaksi-pdf.pdf', 'I'); 
        // I, untuk menampilkan pdf di browser, D untuk mengunduh file pdf 

    } // tutup fucntion


    public function laporan_transaksi_pdf() {
        // memanggil data dari databse
        $datapasien= $this->laporan_model->get_all_transaksi()->result_array();
  
        $pdf = new TCPDF('', 'mm','A4', true, 'UTF-8', false);
        // konfigurasi  
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $pdf->SetTopMargin(20); // Margin atas
        $pdf->setFooterMargin(10); // Margin Bawah 
        $pdf->SetMargins('10', '10','10', '10');     
        $pdf->SetAutoPageBreak(TRUE);  
        $pdf->SetFont('helvetica', '', 10); 
  
        // munculkan file
        $pdf->AddPage('P');  
        $html = '
          <br><br> 

          &nbsp; AKACI - Laporan Penjualan :<br><br>
          <table cellspacing="1" bgcolor="#666666" cellpadding="2" width="90%">
            <tr bgcolor="#ffffff">
              <th width="5%" align="center">No</th>
              <th width="20%" align="center">Nama Pelanggan</th>
              <th width="20%" align="center">Waktu Pesan</th>
              <th width="20%" align="center">Harga Total</th>

            </tr>';
            // memecah data dari model dan menampilkannya di table
            foreach ($datatransaksi as $row) {
            $html.='<tr bgcolor="#ffffff">
                      <td align="center">'.$row['id_pmsn'].'</td>
                      <td>'.$row['id_plgn'].'</td>
                      <td>'.$row['waktu_pmsn'].'</td>
                      <td>'.$row['total_harga'].'</td>
                  </tr>';
                  }; // tutup foerach table
          $html.='</table>'; // menyambung html table
          $pdf->writeHTML($html); 
          $pdf->Output('list_data_pasien.pdf', 'D');
      }



}