<?php

	session_cache_limiter('private, must-revalidate');
	header("Expires: Thu, 01 Dec 1994 16:00:00 GMT");
	header("Last-Modified: ". gmdate("D, d M Y H:i:s"). " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

require_once ("../common/defult.php");
require_once ("../common/htmltemplate.inc.php");

	$data = read_csv();

	//csvファイル読み込み
	function read_csv(){
		if(!($fp = fopen(STAFF_CSV_PRE, 'r'))){
			die('csvを読み込めません');
		}

		$data = array();
		$i = 0;
		while (!feof($fp)) {
			$rec = fgets($fp);
			$rec = rtrim($rec, "\r\n");

			if (mb_strlen($rec) > 0){
				//$data[$i] = mbsplit("\t", $rec);
				$data[$i] = explode("\t", $rec);
				
				if ($data[$i][3] == '') $data[$i][3] = NO_IMAGE_STAFF;

				$i++;
			}
			
		}

		fclose($fp);
		return $data;
	}
	

	foreach($data as $array){	
	
    $arg['data'][]=$array;
		
	}
		
	
HtmlTemplate::t_include("index.tpl",$arg);    //テンプレートの表示
	

?>
