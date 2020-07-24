<?php

error_reporting(0);
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
//  */
// include_once('.'<?= base_url('assets/report/'); ?>.'phpjasperxml_0.9d/class/tcpdf/tcpdf.php');
// include_once("."<?= base_url('assets/report/'); ?>."phpjasperxml_0.9d/class/PHPJasperXML.inc.php");



$server="localhost";
$user="root";
$pass="";
$db="tebilung_data_mahulu"



$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("parameter1"=>1);
$PHPJasperXML->load_xml_file("menu.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
