<?php

	define ("HTML_BLANK_CHARACTER", "&nbsp;");

/*====================================================================
 	関数名： put
 	概　要： 特殊文字をHTMLエンティティに変換し戻り値として返す
 	引　数： 変換対象文字列
	戻り値： 変換後文字列
*/
function put ($values) {
	$values = htmlspecialchars ($values);
	return $values;
}


/*====================================================================
 	関数名： null2br
 	概　要： 改行コードを<br>タグに変換する
 	引　数： 変換対象文字列
	戻り値： 変換後文字列
*/
function null2br($values){
	$values = str_replace ("<br />", "<br>", nl2br($values));
	return $values;
}


/*====================================================================
 	関数名： val
 	概　要： 
 	引　数： 
	戻り値： 
*/
function val($values){
	$values = null2br ($values);
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	関数名： rval
 	概　要： 
 	引　数： 
	戻り値： 
*/
function rval($values){
	$values = null2br (htmlspecialchars ($values));
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	関数名： hval
 	概　要： 
 	引　数： 
	戻り値： 
*/
function hval($values){
	$values = htmlspecialchars ($values);
	return $values;
}


/*====================================================================
 	関数名： pval
 	概　要： 
 	引　数： 
	戻り値： 
*/
function pval($values){
	return $values;
}


/*====================================================================
 	関数名： mval
 	概　要： 
 	引　数： 
	戻り値： 
*/
function mval($values){
	$values = null2br (mb_convert_kana($values, "kas"));
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	関数名： mrval
 	概　要： 
 	引　数： 
	戻り値： 
*/
function mrval($values){
	$values = null2br (htmlspecialchars (mb_convert_kana($values, "kas")));
	return ($values != "" ? $values : HTML_BLANK_CHARACTER);
}


/*====================================================================
 	関数名： mhval
 	概　要： 
 	引　数： 
	戻り値： 
*/
function mhval($values){
	$values = htmlspecialchars (mb_convert_kana($values, "kas"));
	return $values;
}

?>