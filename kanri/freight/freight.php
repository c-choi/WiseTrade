<?php
require_once ("../../common/defult.php");
require_once ("../../common/htmltemplate.inc.php");
require_once ("../../common/get_form.inc.php");
require_once ("../../common/put_form.inc.php");

// �Z�b�V�����̊J�n
session_start();

$templateValues = array();       /* �e���v���[�g�p�z�� */

    if ($_POST[file] == "") {
	
	$templateFile = TEMPLATE_LORRYS_HTML_A;
	
	} 

    if (isset($_POST[Input01])) {
		
	if (is_uploaded_file($_FILES["upfile01"]["tmp_name"])) {
    
	if (move_uploaded_file($_FILES["upfile01"]["tmp_name"], UPLOAD_LUGGAGE_CSV_DIR . UPLOAD_LUGGAGE_CSV)) {
   
    chmod(UPLOAD_LUGGAGE_CSV_DIR . UPLOAD_LUGGAGE_CSV, 0644);
	
	$templateFile = TEMPLATE_LORRYS_HTML_B;
    
	        }
        }
    } else if (isset($_POST[Input02])) {
		
	if (is_uploaded_file($_FILES["upfile02"]["tmp_name"])) {
    
	if (move_uploaded_file($_FILES["upfile02"]["tmp_name"], UPLOAD_TRANSPORTE_CSV_DIR . UPLOAD_TRANSPORTE_CSV)) {
   
    chmod(UPLOAD_TRANSPORTE_CSV_DIR . UPLOAD_TRANSPORTE_CSV, 0644);
	
	$templateFile = TEMPLATE_LORRYS_HTML_C;
    
	    }
    }
    } 
	



/*====================================================================
	��ʏo�́iHTML�o�́j
*/
htmltemplate::t_include($templateFile, $templateValues);
?>

