<?php

	define ("HTML_BLANK_CHARACTER", "&nbsp;");

/*====================================================================
 	�֐����F put
 	�T�@�v�F ���ꕶ����HTML�G���e�B�e�B�ɕϊ����߂�l�Ƃ��ĕԂ�
 	���@���F �ϊ��Ώە�����
	�߂�l�F �ϊ��㕶����
*/
function put ($values) {
	$values = htmlspecialchars ($values);
	return $values;
}


/*====================================================================
 	�֐����F null2br
 	�T�@�v�F ���s�R�[�h��<br>�^�O�ɕϊ�����
 	���@���F �ϊ��Ώە�����
	�߂�l�F �ϊ��㕶����
*/
function null2br($values){
	$values = str_replace ("<br />", "<br>", nl2br($values));
	return $values;
}


/*====================================================================
 	�֐����F val
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function val($values){
	$values = null2br ($values);
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	�֐����F rval
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function rval($values){
	$values = null2br (htmlspecialchars ($values));
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	�֐����F hval
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function hval($values){
	$values = htmlspecialchars ($values);
	return $values;
}


/*====================================================================
 	�֐����F pval
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function pval($values){
	return $values;
}


/*====================================================================
 	�֐����F mval
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function mval($values){
	$values = null2br (mb_convert_kana($values, "kas"));
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	�֐����F mrval
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function mrval($values){
	$values = null2br (htmlspecialchars (mb_convert_kana($values, "kas")));
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	�֐����F mhval
 	�T�@�v�F 
 	���@���F 
	�߂�l�F 
*/
function mhval($values){
	$values = htmlspecialchars (mb_convert_kana($values, "kas"));
	return $values;
}

?>