<?php
	session_cache_limiter('private, must-revalidate');
	header("Expires: Thu, 01 Dec 1994 16:00:00 GMT");
	header("Last-Modified: ". gmdate("D, d M Y H:i:s"). " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	//�t�@�C���f�B���N�g����`

    require_once ("../../common/defult.php");
    require_once ("../../common/htmltemplate.inc.php");
		
	$data = read_csv();
	$data = add_button($data);
	$data = delete_button($data);
	$value = edit_button($data);
	gc_image($data);

	//csv�ǂ݂���
	function read_csv(){
		if(!($fp = fopen(USEDCAR_CSV, 'r'))){
			die('csv�t�@�C����ǂݍ��߂܂���');
		}

		$data = array();
		$i = 0;
		while (!feof($fp)) {
			$rec = fgets($fp);
			$rec = rtrim($rec, "\r\n");

			if (mb_strlen($rec) > 0){
				$data[$i] = mbsplit("\t", $rec);

				//�摜�w�肪�Ȃ��ꍇ��NO IMAGE�\������
				if ($data[$i][8] == '') $data[$i][8] = NO_IMAGE_USEDCAR;	//2007/10/10�ǉ�

				$i++;
			}
		}

		fclose($fp);
		return $data;
	}

	//�ǉ��{�^������
	function add_button($data){
		if(!isset($_POST['id'])) return $data;

		//���͂��Ȃ��ꍇ�͓��삵�Ȃ�
		if(!is_uploaded_file($_FILES['image_file']['tmp_name'])
			and (!isset($_POST['title01']) or $_POST['title01'] == '')
			and (!isset($_POST['title02']) or $_POST['title02'] == '')
			and (!isset($_POST['title03']) or $_POST['title03'] == '')
			and (!isset($_POST['title04']) or $_POST['title04'] == '')
			and (!isset($_POST['title05']) or $_POST['title05'] == '')
			and (!isset($_POST['title06']) or $_POST['title06'] == '')
			and (!isset($_POST['title07']) or $_POST['title07'] == '')
			and (!isset($_POST['title08']) or $_POST['title08'] == '')){

			return $data;
		}
	
		//�A�b�v���[�h����
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
				imagejpeg($imageNew, UPLOAD_USEDCAR_IMAGE . $_FILES['image_file']['name']);
			}elseif($format == "gif"){
				imagegif($imageNew, UPLOAD_USEDCAR_IMAGE . $_FILES['image_file']['name']);
			}elseif($format == "png"){
				imagepng($imageNew, UPLOAD_USEDCAR_IMAGE . $_FILES['image_file']['name']);
			}

			chmod(UPLOAD_USEDCAR_IMAGE . $_FILES['image_file']['name'], 0666);
			$_POST['image_name'] = $_FILES['image_file']['name'];
		}
		

		if(!($fp = fopen(USEDCAR_CSV, 'w'))){
			die('csv�t�@�C����ǂݍ��߂܂���');
		}

		$_POST['title08'] = mb_eregi_replace ("\r", '', $_POST['title08']);
		$_POST['title08'] = mb_eregi_replace ("\n", '<br>', $_POST['title08']);

		if($_POST['id'] === ''){
			fputs($fp, $_POST['title01'] . "\t" . $_POST['title02'] . "\t" . $_POST['title03'] . "\t" . $_POST['title04'] . "\t" . $_POST['title05'] . "\t" . $_POST['title06'] . "\t" . $_POST['title07'] . "\t" . $_POST['title08'] . "\t" . $_POST['image_name'] . "\n");
		}

		$i = 0;
		foreach($data as $array){
			if($_POST['id'] !== '' and $_POST['id'] == $i){
				fputs($fp, $_POST['title01'] . "\t" . $_POST['title02'] . "\t" . $_POST['title03'] . "\t" . $_POST['title04'] . "\t" . $_POST['title05'] . "\t" . $_POST['title06'] . "\t" . $_POST['title07'] . "\t" . $_POST['title08'] . "\t" . $_POST['image_name'] . "\n");
			}else{
				fputs($fp, $array[0] . "\t" . $array[1] . "\t" . $array[2] . "\t" . $array[3] . "\t" . $array[4] . "\t" . $array[5] . "\t" . $array[6] . "\t" . $array[7] . "\t" . $array[8] . "\n");
			}

			$i++;
		}

		fclose($fp);
		return read_csv();
	}

	//�ҏW�{�^������
	function edit_button($data){
		if(isset($_GET['id'])){
			$_GET['id'] = (int)$_GET['id'];
			$value['id'] = $_GET['id'];
			$value['title01'] = $data[$_GET['id']][0];
			$value['title02']  = $data[$_GET['id']][1];
			$value['title03']  = $data[$_GET['id']][2];
			$value['title04']  = $data[$_GET['id']][3];
			$value['title05']  = $data[$_GET['id']][4];
			$value['title06']  = $data[$_GET['id']][5];
			$value['title07']  = $data[$_GET['id']][6];
			$value['title08']  = mb_eregi_replace ('<br>', "\n", $data[$_GET['id']][7]);
			$value['image_name'] = $data[$_GET['id']][8];
		}else{
			$value['id']         = '';
			$value['title01']        = '';
			$value['title02']     = '';
			$value['title03']    = '';
			$value['title04'] = '';
			$value['title05'] = '';
			$value['title06'] = '';
			$value['title07'] = '';
			$value['title08'] = '';
			$value['image_name'] =  '';
		}

		return $value;
	}

	//�폜�{�^������
	function delete_button($data){
		if(!isset($_GET['del'])) return $data;

		$_GET['del'] = (int)$_GET['del'];

		if(!($fp = fopen(USEDCAR_CSV, 'w'))){
			die('csv�t�@�C����ǂݍ��߂܂���');
		}

		$i = 0;
		foreach($data as $array){
			if($i == $_GET['del']){
				//�폜�Ώۂ̃C���[�W���폜
				//$rcd = unlink(_IMAGE_DIR . $array[3]);
			}else{
				fputs($fp, $array[0] . "\t" . $array[1] . "\t" . $array[2] . "\t" . $array[3] . "\t" . $array[4] . "\t" . $array[5] . "\t" . $array[6] . "\t" . $array[7] . "\t" . $array[8] . "\n");
			}

			$i++;
		}

		fclose($fp);
		return read_csv();
	}

	//�s�v�C���[�W�̃K�x�[�W�R���N�V����1
	function gc_image($data){
		$search = array();
		foreach($data as $array){
			$search[] = $array[8];
		}

		$drc = dir(UPLOAD_USEDCAR_IMAGE);

		while($fl = $drc->read()){
			$lfl = UPLOAD_USEDCAR_IMAGE . $fl;
			$din = pathinfo($lfl);

			if(!is_dir($lfl) && ($fl!=".." && $fl!=".") && $fl!=NO_IMAGE_USEDCAR){
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
<title>���ÎԔ̔��Ǘ����</title>
<meta name="keywords" content="���ÎԔ̔��Ǘ����">
<meta name="Description" content="���ÎԔ̔��Ǘ����">
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
<p class="toanchor"><a href="#CONTENTS" id="TOP" name="TOP"><img src="../img/clear.gif" alt="���̃y�[�W�̃g�b�v�ł��B" width="1" height="1"></a></p>
    <h1>�Ǘ����</h1>

    <h2>���ÎԔ̔��Ǘ����</h2>

</div><!-- end of kanrihead -->
<div id="kanribody">
<div id="kanriarea">

<form action="index.php" method="post" enctype="multipart/form-data">
<input name="id" type="hidden" value="<?php echo $value['id']; ?>">
<table class="tbpt13">
<tr>
<th>�Ԏ�</th>
<td><input class="nolonged" name="title01" type="text" maxlength="50" value="<?php echo $value['title01']; ?>"></td>
</tr>
<tr>
<th>���i</th>
<td><input class="nolonged" name="title02" type="text" maxlength="50" value="<?php echo $value['title02']; ?>">&nbsp;�~</td>
</tr>
<tr>
<th>�N��</th>
<td>����&nbsp;<input class="nolonged" name="title03" type="text" maxlength="50" value="<?php echo $value['title03']; ?>">&nbsp;�N</td>
</tr>
<tr>
<th>���s����</th>
<td><input class="nolonged" name="title04" type="text" maxlength="50" value="<?php echo $value['title04']; ?>">&nbsp;km</td>
</tr>
<tr>
<th>����Ԍ�</th>
<td>��&nbsp;<input class="nolonged" name="title05" type="text" maxlength="50" value="<?php echo $value['title05']; ?>">&nbsp;���L����&nbsp;�F&nbsp;�uH22.3�v&nbsp;�u�Ȃ��v�Ȃ�</td>
</tr>
<tr>
<th>�r�C��</th>
<td><input class="nolonged" name="title06" type="text" maxlength="50" value="<?php echo $value['title06']; ?>">&nbsp;L</td>
</tr>
<tr>
<th>����</th>
<td><input class="longed" name="title07" type="text" maxlength="50" value="<?php echo $value['title07']; ?>"></td>
</tr>
<tr>
<th>���l</th>
<td><textarea name="title08" rows="8" class="longed"><?php echo $value['title08']; ?></textarea></td>
</tr>
<tr>
<th>�摜</th>
<td><input class="longed" name="image_file" type="file"><input name="image_name" type="hidden" value="<?php echo $value['image_name']; ?>"><br>���c���̎ʐ^�͎g�p���Ȃ��ł��������B</td>
</tr>
</table>
<p class="btncent"><input name="submit" type="submit" value="�ǉ�����">&nbsp;&nbsp;<input name="���Z�b�g" type="button" value="��������" onClick="window.location.href='index.php'"></p>
</form>
</div><!-- end of kanriarea -->
<div id="usedcar01">

<?php
	$i = 0;
	foreach($data as $array){
	
	$body = 
	
    '<h3>' . "$array[0]" . '</h3><table class="tbpt07">
	 <tr><td class="usedphoto" rowspan="8">
	 <img src="' . UPLOAD_USEDCAR_IMAGE . "$array[8]" . '" alt="" width="360" height="270">
	 </td><th>�Ԏ�</th><td>' . "$array[0]" . '</td></tr><tr><th>���i</th>
	 <td>' . "$array[1]" . '&nbsp;�~</td></tr><tr><th>�N��</th><td>����&nbsp;' . "$array[2]" . '&nbsp;�N</td>
	 </tr><tr><th>���s����</th><td>' . "$array[3]" . '&nbsp;Km</td></tr><tr><th>����Ԍ�</th>
	 <td>��&nbsp;' . "$array[4]" . '</td></tr><tr><th>�r�C��</th><td>' . "$array[5]" . '&nbsp;L</td></tr>
	 <tr><th>����</th><td>' . "$array[6]" . '</td></tr><tr><th>���l</th><td>' . "$array[7]" . '</td></tr>
	 </table><p><input type="button" value="�ҏW" onClick="window.location.href=\'index.php?id=' . $i . '\'">&nbsp;&nbsp;
	 <input type="button" value="�폜" onClick="window.location.href=\'index.php?del=' . $i . '\'"></p>';

	print $body;

		$i++;
	}
	
	
?>


</div><!-- end of usedcar01 -->
</div><!-- end of kanribody -->
<div id="kanrifoot">
<p class="totop"><a href="#TOP">���̃y�[�W�̃g�b�v��</a></p>
</div><!-- end of kanrifoot -->
</div><!-- end of all -->
</body>
</html>






























































































































































