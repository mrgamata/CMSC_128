<?php
session_start();
require "fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=library','root','');


class myPDF extends FPDF{

	

    function header(){
        if ($this->PageNo() == 1 ) {
            if(isset($_POST['submit'])){
                $to=$_POST['to'];
                $from=$_POST['from'];
                $to1=date("F d, Y", strtotime($to));
                $from1=date("F d, Y", strtotime($from));



                $this->Ln();
                $this->Ln();
                $this->SetFont('Times','',12);
                $this->Cell(276,5, "Republic of the Philippines",0,0, 'C');
                $this->Ln();
                $this->Cell(276,5, "Department of Education",0,0, 'C');
                $this->Ln();
                $this->Cell(276,5, "Region I - Ilocos Region",0,0, 'C');
                $this->Ln();
                $this->SetFont('Times','B',12);
                $this->Cell(276,5, "Teodoro Hernaez National High School",0,0, 'C');
                $this->Ln();
                $this->SetFont('Times','',10);
                $this->Cell(276,5, "Barangay Sabuanan, Santa Lucia, 2712 Ilocos Sur, Philippines",0,0, 'C');
                $this->Ln();
                $this->Ln();  
                $this->Ln(15);;

                $this->SetFont('Times','B',16);
                $this->Cell(276,5, "TRANSACTION HISTORY",0,0, 'C');
                $this->Ln();
                $this->SetFont('Times','',12);
                $this->Cell(276, 10, 'From  ' .$from1.' to ' .$to1. '' ,0,0,'C');
                $this->Ln(20); 
            } 
        } else{
             $this->Ln(20); 
        }
    }
    function header2(){
        $this->SetFont('Times','B',14);
        $this->Cell(276,5, "RETURNED BOOKS",0,0, 'C');
        $this->Ln(10);  
    }
    function header3(){
        $this->SetFont('Times','B',14);
        $this->Cell(276,5, "CURRENTLY BORROWED BOOKS",0,0, 'C');
        $this->Ln(10);  
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont ('Arial','',8);
        $this->Cell(0,10, 'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->SetFont('Times', 'B',12);
        $this->Cell(30, 10, 'Transaction ID',1,0, 'C');
        $this->Cell(30, 10, 'Accession No.',1,0, 'C');
        $this->Cell(100, 10, 'Title',1,0, 'C');
        $this->Cell(60, 10, 'Borrower',1,0,'C');
        $this->Cell(30, 10, 'Date Borrowed',1,0, 'C');
        $this->Cell(30,10, 'Date Returned',1,0,'C');
        $this->Ln();
    }
    function headerTable2(){
        $this->SetFont('Times', 'B',12);
        $this->Cell(35, 10, 'Transaction ID',1,0, 'C');
        $this->Cell(35, 10, 'Accession No.',1,0, 'C');
        $this->Cell(110, 10, 'Title',1,0, 'C');
        $this->Cell(60, 10, 'Borrower',1,0,'C');
        $this->Cell(40, 10, 'Date Borrowed',1,0, 'C');
        $this->Ln();
    }




    function viewTable($db){
        $this->SetFont('Times','',12);
        if(isset($_POST['submit'])){
            $to=$_POST['to'];
            $from=$_POST['from'];
    		$sql = "SELECT * FROM past_transaction natural join books natural join borrower WHERE borrow_date BETWEEN '$from' AND ' $to' order by trans_id ASC";
            $stmt = $db->query($sql);
            while($data=$stmt->fetch(PDO::FETCH_OBJ)){
                $this->Cell(30, 10, $data->trans_id,1,0, 'C');
                $this->Cell(30, 10, $data->access_num,1,0, 'C');
                $len=strlen($data->title);
                if ($len>50){
                    $result = substr($data->title, 0, 50);
                    $result = $result.'...';
                }else{
                    $result =$data->title;
                }

                $this->Cell(100, 10, $result,1,0, 'C');
                $this->Cell(60, 10,$data->b_fname. " ". $data->b_mname . " " .$data->b_lname,1,0,'C');
                $this->Cell(30, 10, $data->borrow_date,1,0, 'C');
                $this->Cell(30,10,  $data->return_date,1,0,'C');
                $this->Ln();
            }



        }
    }
    function viewTable2($db){
        $this->SetFont('Times','',12);
        if(isset($_POST['submit'])){
            $to=$_POST['to'];
            $from=$_POST['from'];
            $sql2 = "SELECT * FROM transaction natural join books natural join borrower WHERE borrow_date BETWEEN '$from' AND ' $to' order by tran_id ASC";
            $stmt = $db->query($sql2);
            while($data=$stmt->fetch(PDO::FETCH_OBJ)){
                $this->Cell(35, 10, $data->tran_id,1,0, 'C');
                $this->Cell(35, 10, $data->access_num,1,0, 'C');
                $len=strlen($data->title);
                if ($len>50){
                    $result = substr($data->title, 0, 50);
                    $result = $result.'...';
                }else{
                    $result =$data->title;
                }

                $this->Cell(110, 10, $result,1,0, 'C');
                $this->Cell(60, 10,$data->b_fname. " ". $data->b_mname . " " .$data->b_lname,1,0,'C');
                $this->Cell(40,10, $data->borrow_date,1,0, 'C');
                $this->Ln();
            }



        }
    }

}
$image="logo.png";
$deped="deped.png";
$pdf=new myPDF ();
$pdf->AliasNbPages();
$pdf ->AddPage ('L', 'A4',0);
$pdf-> Image( $image,20,12,32,32);
$pdf-> Image( $deped,230,10,50,30);
$pdf ->header2();
$pdf ->headerTable();
$pdf ->viewTable($db);
$pdf ->AddPage ('L', 'A4',0);
$pdf ->header3();
$pdf ->headerTable2();
$pdf->viewTable2($db);
$pdf->Output();