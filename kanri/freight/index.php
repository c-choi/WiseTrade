<?php

require_once ("../../common/defult.php");
require_once ("../../common/htmltemplate.inc.php");
require_once ("../../common/get_form.inc.php");
require_once ("../../common/put_form.inc.php");

session_start();


// �e���v���[�g�l���Z�b�g
$templateValues = "";
// �e���v���[�g�Z�b�g
$templateFile = TEMPLATE_LORRYS_HTML_A;

/*====================================================================
	��ʏo�́iHTML�o�́j
*/
htmltemplate::t_include($templateFile, $templateValues);


?>