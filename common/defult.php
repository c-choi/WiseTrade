<?php
/*
�N���C�A���g�F���C�Y

���e1�F���эX�V�v���O����
�@�\�F�摜�A�e�L�X�g�̃A�b�v���[�h
�쐬���F2008.12.13

���e2�F���q���X�V�v���O����
�@�\�FCSV�t�@�C���̃A�b�v���[�h
�쐬���F2008.12.13

�N���C�A���g�F���C�Y
���e1�F�ו����X�V�v���O����
�@�\�FCSV�t�@�C���̃A�b�v���[�h
�쐬���F2008.12.13

�N���C�A���g�F���C�Y
���e1�F���Îԏ��X�V�v���O����
�@�\�FCSV�t�@�C���̃A�b�v���[�h
�쐬���F2008.12.13

*/


/*
�����ݒ�
*/

define ("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
define ("ADMINISTRATION_PATH", "");
define ("ADMINISTRATION_DIR", DOCUMENT_ROOT.ADMINISTRATION_PATH);
define ("COMMON_FILES_DIR", DOCUMENT_ROOT."/common");
define ("FREIGHT_FILES_DIR", DOCUMENT_ROOT."/freight");
define ("ADMINISTRATION_TEMPLATE_DIR", ADMINISTRATION_DIR."/kanri");

//�摜�̃A�b�v���[�h��t�H���_
    //���яЉ�
    define ("UPLOAD_LORRYS_IMAGE", "../../images/lorrys/");//�Ǘ�
	define ("UPLOAD_LORRYS_IMAGE_PRE", "../images/lorrys/");//�v���r���[
	
	//���ÎԔ̔�
    define ("UPLOAD_USEDCAR_IMAGE", "../../images/usedcar/");
	
	//�В��u���O
    define ("UPLOAD_CEO_IMAGE", "../../images/ceoblog/");
	define ("UPLOAD_CEO_IMAGE_PRE", "../images/ceoblog/");//�v���r���[
	
	//�Ј��u���O
    define ("UPLOAD_STAFF_IMAGE", "../../images/staffblog/");//�Ǘ�
	define ("UPLOAD_STAFF_IMAGE_PRE", "../images/staffblog/");//�v���r���[

/*������������������������������������������
CSV�f�[�^
*/
    //���яЉ�
    define ("LORRYS_CSV", "../../csv/lorrys/data.csv");//�Ǘ�
	define ("LORRYS_CSV_PRE", "../csv/lorrys/data.csv");//�v���r���[
	
	//���ÎԔ̔�
    define ("USEDCAR_CSV", "../../csv/usedcar/data.csv");//�Ǘ�
	define ("USEDCAR_CSV_PRE", "../csv/usedcar/data.csv");//�v���r���[
	
	//�В��u���O
    define ("CEO_CSV", "../../csv/ceoblog/data.csv");
	define ("CEO_CSV_PRE", "../csv/ceoblog/data.csv");//�v���r���[
	
	//�Ј��u���O
	define ("STAFF_CSV", "../../csv/staffblog/data.csv");//�Ǘ�
	define ("STAFF_CSV_PRE", "../csv/staffblog/data.csv");//�v���r���[
	
	//�^�����q���
    define ("UPLOAD_TRANSPORTE_READCSV_DIR", "../csv/transporte/");//�f�B���N�g����
	define ("UPLOAD_TRANSPORTE_CSV", "data.csv");//CSV�t�@�C����
	
	//�^�����q���
	define ("UPLOAD_LUGGAGE_READCSV_DIR", "../csv/luggage/");
    define ("UPLOAD_LUGGAGE_CSV", "data.csv");//CSV�t�@�C����
	
	
/*������������������������������������������
//CSV�f�[�^�̃A�b�v���[�h��t�H���_
*/

    //�^�����q���
    define ("UPLOAD_TRANSPORTE_CSV_DIR", "../../csv/transporte/");//�f�B���N�g����
	if(!defined ("UPLOAD_TRANSPORTE_CSV")){ define ("UPLOAD_TRANSPORTE_CSV", "data.csv");}//CSV<83>t<83>@<83>C<83><8b><96>?
	//define ("UPLOAD_TRANSPORTE_CSV", "data.csv");//CSV�t�@�C����
 
    //�ו����
    define ("UPLOAD_LUGGAGE_CSV_DIR", "../../csv/luggage/");//�f�B���N�g����
	if(!defined ("UPLOAD_LUGGAGE_CSV")){ define ("UPLOAD_LUGGAGE_CSV", "data.csv");}//CSV<83>t<83>@<83>C<83><8b><96>?
	//define ("UPLOAD_LUGGAGE_CSV", "data.csv");//CSV�t�@�C����
 

//��ʏo�̓G���R�[�h
    //define ("NO_IMAGE", "");

/*������������������������������������������
�Ǘ���ʃe���v���[�g�Z�b�g
*/

//���яЉ�
    //�Ǘ����
	define ("TEMPLATE_LORRYS_HTML", "lorrys/index.tpl");
	
	
//���ÎԔ̔�
    //�Ǘ����
	
	
//�В��u���O
    //�Ǘ����
	
	
//�X�^�b�t�u���O
    //�Ǘ����
	
	
//�t���C�g�i�ו��E���q�j
    //�����y�ъ�����̖߂�
	define ("TEMPLATE_LORRYS_HTML_A", "index.tpl");
	
	//�ו����A�b�v��
	define ("TEMPLATE_LORRYS_HTML_B", "index02.tpl");
	
	//���q���A�b�v��
	define ("TEMPLATE_LORRYS_HTML_C", "index03.tpl");
	

/*������������������������������������������	
�v���r���[��ʃe���v���[�g�Z�b�g
*/
//�t���C�g�i�ו��E���q�j
    //���q���
	define ("TEMPLATE_TRANSPORTE_HTML", "transporte.tpl");
	
/*������������������������������������������	
�m�[�C���[�W
*/
    //���яЉ�
	define ("NO_IMAGE_LORRYS", "noimage.jpg");//�v���r���[
	
	//�В��u���O
    define ("NO_IMAGE_CEO", "noimage.gif");//�v���r���[
	
	//�Ј��u���O
    define ("NO_IMAGE_STAFF", "noimage.gif");//�v���r���[
	
	//���ÎԔ̔�
	define ("NO_IMAGE_USEDCAR", "used_noimage.jpg");//�v���r���[
	
	
/*������������������������������������������	
�A�b�v���[�h�ݒ�
*/


?>