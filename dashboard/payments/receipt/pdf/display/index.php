<?php
       if(isset($_GET['l'])){
           $l = htmlentities($_GET['l'], ENT_QUOTES);
                      require('../../../../../fpdf/fpdf.php');
$p = explode("png/", $l);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../png/'.$p[1].'' ,10,6,194);
$pdf->Output();  
              }