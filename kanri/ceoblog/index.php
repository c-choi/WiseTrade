<?php
	session_cache_limiter('private, must-revalidate');
	header("Expires: Thu, 01 Dec 1994 16:00:00 GMT");
	header("Last-Modified: ". gmdate("D, d M Y H:i:s"). " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	//ファイルディレクトリ定義
	require_once ("../../common/defult.php");
    require_once ("../../common/htmltemplate.inc.php");

	$data = read_csv();
	$data = add_button($data);
	$data = delete_button($data);
	$value = edit_button($data);
	gc_image($data);

	//csv読みこみ
	function read_csv(){
		if(!($fp = fopen(CEO_CSV, 'r'))){
			die('csvファイルを読み込めません');
		}

		$data = array();
		$i = 0;
		while (!feof($fp)) {
			$rec = fgets($fp);
			$rec = rtrim($rec, "\r\n");

			if (mb_strlen($rec) > 0){
				$data[$i] = mbsplit("\t", $rec);

				//画像指定がない場合はNO IMAGE表示する
				if ($data[$i][3] == '') $data[$i][3] = NO_IMAGE_CEO;	

				$i++;
			}
		}

		fclose($fp);
		return $data;
	}

	//追加ボタン動作
	function add_button($data){
		if(!isset($_POST['id'])) return $data;

		//入力がない場合は動作しない
		if(!is_uploaded_file($_FILES['image_file']['tmp_name'])
			and (!isset($_POST['day']) or $_POST['day'] == '')
			and (!isset($_POST['title']) or $_POST['title'] == '')
			and (!isset($_POST['content']) or $_POST['content'] == '')){

			return $data;
		}
	
		//アップロード処理
		if (is_uploaded_file($_FILES['image_file']['tmp_name'])){
			if(preg_match("/\.jpg$|\.JPG$|\.jpeg$|\.JPEG$/",$_FILES['image_file']['name'])){
				$format = "jpeg";
			}else if(preg_match("/\.gif$|\.GIF$/",$_FILES['image_file']['name'])){
				$format = "gif";
			}else if(preg_match("/\.png$|\.PGN$/",$_FILES['image_file']['name'])){
				$format = "png";
			}else{
				return $data;
			}

			if($format == "jpeg"){
  			$image = imageCreateFromJpeg($_FILES['image_file']['tmp_name']);
			}elseif($format == "gif"){
  			$image = imageCreateFromGif($_FILES['image_file']['tmp_name']);
			}elseif($format == "png"){
  			$image = imageCreateFromPng($_FILES['image_file']['tmp_name']);
			}

			$oldWidth = imageSX($image);        
			$oldHeight = imageSY($image);

			if($oldWidth * 3 > $oldHeight * 4){
			  $newWidth = 640;
			  $newHeight = 640 * $oldHeight / $oldWidth;
			}else{
			  $newWidth = 480 * $oldWidth / $oldHeight;
			  $newHeight = 480;
			}

			$imageNew = ImageCreateTrueColor($newWidth, $newHeight);
			imageCopyResampled($imageNew, $image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

			//unlink(_IMAGE_DIR . $_FILES['image_file']['name']);

			if($format == "jpeg"){
				imagejpeg($imageNew, UPLOAD_CEO_IMAGE . $_FILES['image_file']['name']);
			}elseif($format == "gif"){
				imagegif($imageNew, UPLOAD_CEO_IMAGE . $_FILES['image_file']['name']);
			}elseif($format == "png"){
				imagepng($imageNew, UPLOAD_CEO_IMAGE . $_FILES['image_file']['name']);
			}

			chmod(UPLOAD_CEO_IMAGE . $_FILES['image_file']['name'], 0666);
			$_POST['image_name'] = $_FILES['image_file']['name'];
		}
		

		if(!($fp = fopen(CEO_CSV, 'w'))){
			die('csvファイルを読み込めません');
		}

		$_POST['content'] = mb_eregi_replace ("\r", '', $_POST['content']);
		$_POST['content'] = mb_eregi_replace ("\n", '<br>', $_POST['content']);

		if($_POST['id'] === ''){
			fputs($fp, $_POST['day'] . "\t" . $_POST['title'] . "\t" . $_POST['content'] . "\t" . $_POST['image_name'] . "\n");
		}

		$i = 0;
		foreach($data as $array){
			if($_POST['id'] !== '' and $_POST['id'] == $i){
				fputs($fp, $_POST['day'] . "\t" . $_POST['title'] . "\t" . $_POST['content'] . "\t" . $_POST['image_name'] . "\n");
			}else{
				fputs($fp, $array[0] . "\t" . $array[1] . "\t" . $array[2] . "\t" . $array[3] . "\n");
			}

			$i++;
		}

		fclose($fp);
		return read_csv();
	}

	//編集ボタン動作
	function edit_button($data){
		if(isset($_GET['id'])){
			$_GET['id']          = (int)$_GET['id'];
			$value['id']         = $_GET['id'];
			$value['day']       = $data[$_GET['id']][0];
			$value['title']     = $data[$_GET['id']][1];
			$value['content']    = mb_eregi_replace ('<br>', "\n", $data[$_GET['id']][2]);
			$value['image_name'] = $data[$_GET['id']][3];
		}else{
			$value['id']         = '';
			$value['day']       = '';
			$value['title']     = '';
			$value['content']    = '';
			$value['image_name'] = '';
		}

		return $value;
	}

	//削除ボタン動作
	function delete_button($data){
		if(!isset($_GET['del'])) return $data;

		$_GET['del'] = (int)$_GET['del'];

		if(!($fp = fopen(CEO_CSV, 'w'))){
			die('csvファイルを読み込めません');
		}

		$i = 0;
		foreach($data as $array){
			if($i == $_GET['del']){
				//削除対象のイメージを削除
				//$rcd = unlink(_IMAGE_DIR . $array[3]);
			}else{
				fputs($fp, $array[0] . "\t" . $array[1] . "\t" . $array[2] . "\t" . $array[3] . "\n");
			}

			$i++;
		}

		fclose($fp);
		return read_csv();
	}

	//不要イメージのガベージコレクション1
	function gc_image($data){
		$search = array();
		foreach($data as $array){
			$search[] = $array[3];
		}

		$drc = dir(UPLOAD_CEO_IMAGE);

		while($fl = $drc->read()){
			$lfl = UPLOAD_CEO_IMAGE . $fl;
			$din = pathinfo($lfl);

			if(!is_dir($lfl) && ($fl!=".." && $fl!=".") && $fl!=NO_IMAGE_CEO){
				if(array_search($fl, $search) === false){
					unlink($lfl);
				}
			}
		}

		$drc->close();
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="ja-JP">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>社長ブログ管理画面</title>
<meta name="keywords" content="社長員ブログ管理画面">
<meta name="Description" content="社長ブログ管理画面">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="robots" content="INDEX,FOLLOW">
<link href="../../css/f_base.css" rel="stylesheet" type="text/css" media="all">
<link href="../../css/kanri.css" rel="stylesheet" type="text/css" media="all">
<link rev="made" href="mailto:info@thinkport.net">
<link rel="next" href="../../index.html">
</head>
<body>
<div id="kanriall">
<div id="kanrihead">
<p class="toanchor"><a href="#CONTENTS" id="TOP" name="TOP"><img src="../img/clear.gif" alt="このページのトップです。" width="1" height="1"></a></p>
    <h1>管理画面</h1>

    <h2>社長ブログ管理画面</h2>

</div><!-- end of kanrihead -->
<div id="kanribody">
<div id="kanriarea">

<form action="index.php" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo $value['id']; ?>">
<table class="tbpt13">
<tr>
<th>日付</th>
<td><input class="longed" name="day" type="text" maxlength="50" value="<?php echo $value['day']; ?>"></td>
</tr>
<tr>
<th>タイトル</th>
<td><input class="longed" name="title" type="text" maxlength="50" value="<?php echo $value['title']; ?>"></td>
</tr>
<tr>
<th>内容</th>
<td><textarea name="content" rows="8" class="longed"><?php echo $value['content']; ?></textarea></td>
</tr>
<tr>
<th>画像</th>
<td><input class="longed" name="image_file" type="file"><input name="image_name" type="hidden" value="<?php echo $value['image_name']; ?>"><br>※縦長の写真は使用しないでください。</td>
</tr>
</table>
<p class="btncent"><input name="submit" type="submit" value="追加する"><input name="リセット" type="button" value="書き直す" onClick="window.location.href='index.php'"></p>
</form>
</div><!-- end of kanriarea -->

<div id="blog">

<?php

   $i = 0;
   
   foreach($data as $array){
   
   $body = 
    '<div class="blog01">
    <h3>' . "$array[0]" . '</h3>
    <h4>' . "$array[1]" . '</h4>
    <h5 class="imgright"><img src="' . UPLOAD_CEO_IMAGE . "$array[3]" . '" alt="" width="240" height="180"></h5>
    <p>' . "$array[2]" . '</p>
    <p><input type="button" value="編集" onClick="window.location.href=\'index.php?id=' . $i . '\'">&nbsp;&nbsp;<input type="button" value="削除" onClick="window.location.href=\'index.php?del=' . $i . '\'"></p></div><!-- end of blog01 -->';
	
	print $body;
	
	$i++;
	}

?>



</div><!-- end of blog -->
</div><!-- end of kanribody -->
<div id="kanrifoot">
<p class="totop"><a href="#TOP">このページのトップへ</a></p>
</div><!-- end of kanrifoot -->
</div><!-- end of all -->
</body>
</html>