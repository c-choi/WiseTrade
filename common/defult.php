<?php
/*
NCAgFCY

àe1FÀÑXVvO
@\FæAeLXgÌAbv[h
ì¬úF2008.12.13

àe2FÔçqîñXVvO
@\FCSVt@CÌAbv[h
ì¬úF2008.12.13

NCAgFCY
àe1F×¨îñXVvO
@\FCSVt@CÌAbv[h
ì¬úF2008.12.13

NCAgFCY
àe1FÃÔîñXVvO
@\FCSVt@CÌAbv[h
ì¬úF2008.12.13

*/


/*
úÝè
*/

define ("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
define ("ADMINISTRATION_PATH", "");
define ("ADMINISTRATION_DIR", DOCUMENT_ROOT.ADMINISTRATION_PATH);
define ("COMMON_FILES_DIR", DOCUMENT_ROOT."/common");
define ("FREIGHT_FILES_DIR", DOCUMENT_ROOT."/freight");
define ("ADMINISTRATION_TEMPLATE_DIR", ADMINISTRATION_DIR."/kanri");

//æÌAbv[hætH_
    //ÀÑÐî
    define ("UPLOAD_LORRYS_IMAGE", "../../images/lorrys/");//Ç
	define ("UPLOAD_LORRYS_IMAGE_PRE", "../images/lorrys/");//vr[
	
	//ÃÔÌ
    define ("UPLOAD_USEDCAR_IMAGE", "../../images/usedcar/");
	
	//Ð·uO
    define ("UPLOAD_CEO_IMAGE", "../../images/ceoblog/");
	define ("UPLOAD_CEO_IMAGE_PRE", "../images/ceoblog/");//vr[
	
	//ÐõuO
    define ("UPLOAD_STAFF_IMAGE", "../../images/staffblog/");//Ç
	define ("UPLOAD_STAFF_IMAGE_PRE", "../images/staffblog/");//vr[

/*
CSVf[^
*/
    //ÀÑÐî
    define ("LORRYS_CSV", "../../csv/lorrys/data.csv");//Ç
	define ("LORRYS_CSV_PRE", "../csv/lorrys/data.csv");//vr[
	
	//ÃÔÌ
    define ("USEDCAR_CSV", "../../csv/usedcar/data.csv");//Ç
	define ("USEDCAR_CSV_PRE", "../csv/usedcar/data.csv");//vr[
	
	//Ð·uO
    define ("CEO_CSV", "../../csv/ceoblog/data.csv");
	define ("CEO_CSV_PRE", "../csv/ceoblog/data.csv");//vr[
	
	//ÐõuO
	define ("STAFF_CSV", "../../csv/staffblog/data.csv");//Ç
	define ("STAFF_CSV_PRE", "../csv/staffblog/data.csv");//vr[
	
	//^ÀÔçqîñ
    define ("UPLOAD_TRANSPORTE_READCSV_DIR", "../csv/transporte/");//fBNg¼
	define ("UPLOAD_TRANSPORTE_CSV", "data.csv");//CSVt@C¼
	
	//^ÀÔçqîñ
	define ("UPLOAD_LUGGAGE_READCSV_DIR", "../csv/luggage/");
    define ("UPLOAD_LUGGAGE_CSV", "data.csv");//CSVt@C¼
	
	
/*
//CSVf[^ÌAbv[hætH_
*/

    //^ÀÔçqîñ
    define ("UPLOAD_TRANSPORTE_CSV_DIR", "../../csv/transporte/");//fBNg¼
	if(!defined ("UPLOAD_TRANSPORTE_CSV")){ define ("UPLOAD_TRANSPORTE_CSV", "data.csv");}//CSV<83>t<83>@<83>C<83><8b><96>?
	//define ("UPLOAD_TRANSPORTE_CSV", "data.csv");//CSVt@C¼
 
    //×¨îñ
    define ("UPLOAD_LUGGAGE_CSV_DIR", "../../csv/luggage/");//fBNg¼
	if(!defined ("UPLOAD_LUGGAGE_CSV")){ define ("UPLOAD_LUGGAGE_CSV", "data.csv");}//CSV<83>t<83>@<83>C<83><8b><96>?
	//define ("UPLOAD_LUGGAGE_CSV", "data.csv");//CSVt@C¼
 

//æÊoÍGR[h
    //define ("NO_IMAGE", "");

/*
ÇæÊev[gZbg
*/

//ÀÑÐî
    //ÇæÊ
	define ("TEMPLATE_LORRYS_HTML", "lorrys/index.tpl");
	
	
//ÃÔÌ
    //ÇæÊ
	
	
//Ð·uO
    //ÇæÊ
	
	
//X^btuO
    //ÇæÊ
	
	
//tCgi×¨EÔçqj
    //úyÑ®¹ãÌßè
	define ("TEMPLATE_LORRYS_HTML_A", "index.tpl");
	
	//×¨îñAbvã
	define ("TEMPLATE_LORRYS_HTML_B", "index02.tpl");
	
	//ÔçqîñAbvã
	define ("TEMPLATE_LORRYS_HTML_C", "index03.tpl");
	

/*	
vr[æÊev[gZbg
*/
//tCgi×¨EÔçqj
    //Ôçqîñ
	define ("TEMPLATE_TRANSPORTE_HTML", "transporte.tpl");
	
/*	
m[C[W
*/
    //ÀÑÐî
	define ("NO_IMAGE_LORRYS", "noimage.jpg");//vr[
	
	//Ð·uO
    define ("NO_IMAGE_CEO", "noimage.gif");//vr[
	
	//ÐõuO
    define ("NO_IMAGE_STAFF", "noimage.gif");//vr[
	
	//ÃÔÌ
	define ("NO_IMAGE_USEDCAR", "used_noimage.jpg");//vr[
	
	
/*	
Abv[hÝè
*/


?>
