<?php

ini_set ("display_errors", "On");
ini_set ("error_reporting", "2039");

// 初期設定のための定数を定義
define ("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
define ("ADMINISTRATION_PATH", "");
define ("ADMINISTRATION_DIR", DOCUMENT_ROOT.ADMINISTRATION_PATH);
define ("COMMON_FILES_DIR", DOCUMENT_ROOT."/common");
define ("ADMINISTRATION_TEMPLATE_DIR", ADMINISTRATION_DIR."/html");

define ("DATAFILE_DIR", $_ENV['TEMP']);

define ("WEBSITE_URL", "http://211.1.150.41");
define ("SECURE_URL", "");

// 内部エンコーディングをセット
mb_internal_encoding ("SJIS");
mb_regex_encoding ("SJIS");


?>
