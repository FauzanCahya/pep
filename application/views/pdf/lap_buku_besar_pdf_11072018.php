<?PHP  
ob_start(); 
$base_url2 =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base_url2 .=  "://".$_SERVER['HTTP_HOST'];
$base_url2 .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
?>

<style>
.gridth {
    vertical-align: middle;
    color : #FFF;
    text-align: center;
    font-size: 14px;
}
.gridtd {
    vertical-align: middle;
    font-size: 14px;
    padding-left: 5px;
    padding-right: 5px;
    border:1px dotted black;
}
.grid {
    border-collapse: collapse;
}

.grid {
  /*border: 1px solid black;*/
  padding-top:5px;
  padding-bottom:5px;
}

.kolom_header{
    height: 20px;
}

</style>

<table align="center" style="width:100%;">
    <tr>
        <td align="center">
            <h3>
                Laporan Buku Besar <br>
                <hr>
                PT. Prima Elektrik Power<br>
                Periode berlaku mulai tanggal <?php echo $judul; ?> 
            </h3>
        </td>
    </tr>
</table>

<table align="right">
    <tr>
        <td>Tanggal Cetak : <?php echo date('d-m-Y'); ?></td>
    </tr>
</table>
<hr>

<table align="center" class="grid" style="width:100%;">
    <?php

        $u          = 1 ;
        $baris      = 0 ;
        $kolom      = 0 ;
        $debet      = 0 ;
        $kredit     = 0 ;
        $old_koper  = '' ;
        $next_koper = '' ;
        $last_key   = end(array_keys($dt));
        $total_debet  = 0;
        $total_kredit = 0;
        $debet2  = 0;
        $kredit2 = 0;

        foreach ($dt as $key => $row) {
            $nilDebet   = str_replace(',', '.', $row->DEBET);
            $nilKredit  = str_replace(',', '.', $row->KREDIT); 
            $koper      = trim($row->KODE_AKUN);           

            $sql = "
                SELECT
                    a.ID_VOUCHER,
                    a.NO_BUKTI,
                    a.DEBET,
                    a.KREDIT,
                    (a.DEBET - a.KREDIT) AS SALDO_AWAL,
                    a.TGL
                FROM(
                    SELECT
                        a.ID_VOUCHER,
                        a.NO_BUKTI,
                        SUM(a.DEBET) AS DEBET,
                        SUM(a.KREDIT) AS KREDIT,
                        a.TGL
                    FROM ak_input_voucher_detail a
                    GROUP BY a.TGL
                    ORDER BY a.ID ASC
                ) a
                WHERE a.TGL LIKE '%-$bulan-$tahun%'
            ";
            $qry = $this->db->query($sql);
            $brs = $qry->row();
            $saldo_awal = $brs->SALDO_AWAL;

            if ($old_koper != $koper) {
                
                echo "<tr>" ;
                    echo "<td style='background:#FFF; border:none; height:25px;' class='isi_no_border' colspan='6'>  </td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border'><b style='font-size:15px;'><u>".$koper."</u></b></td>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border' colspan='5'><b style='font-size:15px;'><u>".$row->NAMA_AKUN."</u></b> </td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border'><i>Master Akun</i></td>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border'><i>".$row->KODE_GRUP."&nbsp;&nbsp;".$row->GRUP."</i></td>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none;' class='isi_no_border' colspan='2'></td>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none; text-align:center;' class='isi_no_border' colspan='2'>Mutasi</td>" ;
                echo "<td style='vertical-align:middle; height:15px; background:#FFF; border:none; text-align:center;' class='isi_no_border' colspan='2'>Saldo</td>" ;
                echo "</tr>" ;                

                echo "<tr>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Tanggal </th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:30%; border-bottom:1px solid black;'> Keterangan </th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Debit </th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'> Kredit </th>" ;
                echo "</tr>" ;

                echo "<tr>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>&nbsp;</th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:30%; border-bottom:1px solid black;'> Saldo Awal </th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>&nbsp;</th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>&nbsp;</th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>".number_format($saldo_awal,2,'.',',')."</th>" ;
                echo "<th class='kolom_header' style='text-align:center; width:10%; border-bottom:1px solid black;'>0.00</th>" ;
                echo "</tr>" ;

                $old_koper = $koper ;
            }

            $s = "
                SELECT 
                    a.*,
                    c.KODE_GRUP,
                    c.GRUP,
                    b.NAMA_AKUN 
                FROM (  
                    SELECT 
                        a.ID_VOUCHER,
                        a.NO_BUKTI, 
                        b.TGL, 
                        b.KETERANGAN, 
                        a.KODE_AKUN,
                        SUM(a.DEBET) AS DEBET, 
                        SUM(a.KREDIT) AS KREDIT
                    FROM ak_input_voucher_detail a
                    JOIN ak_input_voucher b ON a.ID_VOUCHER = b.ID
                    WHERE b.TGL LIKE '%-07-2018%'
                    GROUP BY a.NO_BUKTI, b.TGL, b.KETERANGAN, a.KODE_AKUN
                ) a JOIN ak_kode_akuntansi b ON a.KODE_AKUN = b.KODE_AKUN
                LEFT JOIN ak_grup_kode_akun c ON c.KODE_GRUP = b.KODE_GRUP
                WHERE a.ID_VOUCHER = '".$row->ID."'
                ORDER BY a.KODE_AKUN ASC, a.TGL,  a.DEBET DESC
            ";

            if($row->NO_BUKTI == 'SALDO AWAL'){

            echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:center;'> <b> ".$row->TGL." </b> </td>" ;
            echo "<td class='gridtd'><b>".$row->KETERANGAN." </b> </td>" ;
            echo "<td class='gridtd'><b>".number_format($nilDebet, 2, '.', ',')." </b> </td>" ; 
            echo "<td class='gridtd'><b>".number_format($nilKredit, 2, '.', ',')." </b> </td>" ; 
            echo "<td class='gridtd'></td>" ;
            echo "<td class='gridtd'></td>" ;
            echo "</tr>" ;

            } else {

            echo "<tr>" ;
            echo "<td class='gridtd' style='text-align:center;'>".$row->TGL."</td>" ;
            echo "<td class='gridtd'>".$row->KETERANGAN."</td>" ;
            echo "<td class='gridtd'>".number_format($nilDebet, 2, '.', ',')."</td>" ; 
            echo "<td class='gridtd'>".number_format($nilKredit, 2, '.', ',')."</td>" ; 
            echo "<td class='gridtd'></td>" ;
            echo "<td class='gridtd'></td>" ;
            echo "</tr>" ;

            }
        }
    ?>

</table>

<?PHP if(count($dt) == 0){ ?>
<table align="center" class="grid" style="width:100%;">
    <tr>
        <th style='text-align:center; width:15%;' class='kolom_header'> Tanggal </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Uraian </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Nomor Bukti </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Debet </th>
        <th style='text-align:center; width:15%;' class='kolom_header'> Kredit </th>
    </tr>
    <tr>
        <td class='gridtd' colspan='6' align="center"> <b> Tidak ada data yang dapat ditampilkan </b> </td>
    </tr>
</table>
<?PHP } ?>


<?PHP
    $width_custom = 14;
    $height_custom = 8.50; 
    $content = ob_get_clean();
    $width_in_inches = $width_custom;
    $height_in_inches = $height_custom;
    $width_in_mm = $width_in_inches * 26.4;
    $height_in_mm = $height_in_inches * 26.4;
    $html2pdf = new HTML2PDF('L',array($width_in_mm,$height_in_mm),'en');
    $html2pdf->pdf->SetTitle('Laporan Buku Besar');
    $html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_buku_besar.pdf');
?>