<?php

require_once ("../../common/defult.php");
require_once ("../../common/htmltemplate.inc.php");
require_once ("../../common/get_form.inc.php");
require_once ("../../common/put_form.inc.php");

session_start();


// テンプレート値をセット
$templateValues = "";
// テンプレートセット
$templateFile = TEMPLATE_LORRYS_HTML_A;

/*====================================================================
	画面出力（HTML出力）
*/
htmltemplate::t_include($templateFile, $templateValues);


?>