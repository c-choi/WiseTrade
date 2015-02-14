<?php


/*====================================================================
	�N���X���FFormValues
	�T�@�@�v�F�t�H�[���f�[�^�����N���X
*/
class FormValues {

	var $m_encodeHeader;
	var $requestMethod;
	var $m_hiddenTagCache;
	var $m_urlStringCache;
	var $m_stripSlashes;
	var $eraseHiddenTages;
	
	function _Initialize () {
		// ������̃N�H�[�g�����ݒ�t���O (true:�s��|false:�s��Ȃ��j
		$this->m_stripSlashes = true;
		$this->m_encodeHeader = ".b64:";
		$this->requestMethod = $_SERVER["REQUEST_METHOD"];

		// �t�H�[���f�[�^�̏������@
		define ("PROC_SET_PROPERTIES", 0);
		define ("PROC_HTML_HIDDENTAGS", 1);
		define ("PROC_URLFORMAT_STRING", 2);
	}


	/*====================================================================
		���R���X�g���N�^
		�֐����F FormValues
		�T�@�v�F ���M���ꂽ�S�Ẵt�H�[���f�[�^�������o�Ƃ��ēo�^
		���@���F �Ȃ�
	*/
	function FormValues () {
		// hidden�^�O��o�͑Ώۃf�[�^�i�[�p�ϐ��̏�����
		$this->eraseHiddenTages = array();
		// �t�H�[���f�[�^���I�u�W�F�N�g�̃����o�Ƃ��ăZ�b�g
		$this->_SetFormValues(PROC_SET_PROPERTIES);
	}


	/*====================================================================
	 	�֐����F SetEraseHiddenValue
	 	�T�@�v�F �w�肵���v�f��hidden�^�O�Ƃ��Ĕ�o�͑ΏۂƂ���
	 	���@���F ��o�͑Ώۃt�H�[����
		�߂�l�F �Ȃ�
	*/
	function SetEraseHiddenValue ($formName) {
		$this->eraseHiddenTages[] = $formName;
	}


	/*====================================================================
	 	�֐����F OutputHiddenTags
	 	�T�@�v�F �S�Ẵt�H�[���f�[�^��HTML��hidden�^�O�Ƃ��ďo��
	 	���@���F �Ȃ�
		�߂�l�F �Ȃ�
	*/
	function OutputHiddenTags () {
		// �L���b�V���p�̃^�O�f�[�^���N���A
		$this->m_hiddenTagCache = "";
		// �t�H�[���f�[�^��hidden�^�O�Ŏ擾
		$this->_SetFormValues(PROC_HTML_HIDDENTAGS);
		// �^�O�f�[�^�̏o��
		print ($this->m_hiddenTagCache);
		// �L���b�V���̃N���A
		unset ($this->m_hiddenTagCache);
	}

	/*====================================================================
	 	�֐����F GetHiddenTags
	 	�T�@�v�F �S�Ẵt�H�[���f�[�^��HTML��hidden�^�O�Ƃ��Ď擾
	 	���@���F �Ȃ�
		�߂�l�F �Ȃ�
	*/
	function GetHiddenTags () {
		// �L���b�V���p�̃^�O�f�[�^���N���A
		$this->m_hiddenTagCache = "";
		// �t�H�[���f�[�^��hidden�^�O�Ŏ擾
		$this->_SetFormValues(PROC_HTML_HIDDENTAGS);
		// �^�O�f�[�^�̎擾
		$values = $this->m_hiddenTagCache;
		// �L���b�V���̃N���A
		unset ($this->m_hiddenTagCache);

		return $values;
	}

	/*====================================================================
	 	�֐����F GetArrayValues
	 	�T�@�v�F �S�Ẵt�H�[���f�[�^��A�z�z��Ƃ��Ď擾
	 	���@���F �Ȃ�
		�߂�l�F �Ȃ�
	*/
	function GetArrayValues () {
		// �����o�ϐ����擾���A�A�z�z��Ƃ��č\�z
		foreach ($this as $key => $value) {
			$arrayValues[$key] = $value;
		}

		return $arrayValues;
	}

	/*====================================================================
	 	�֐����F OutputUrlFormat
	 	�T�@�v�F �S�Ẵt�H�[���f�[�^��URL�`���̕�����Ƃ��ďo��
	 	���@���F �Ȃ�
		�߂�l�F �Ȃ�
	*/
	function OutputUrlFormat () {
		// �L���b�V���p��URL�f�[�^���N���A
		$this->m_urlStringCache = "";
		// �t�H�[���f�[�^��URL�`���Ŏ擾
		$this->_SetFormValues(PROC_URLFORMAT_STRING);
		// URL�f�[�^�̏o�́i1�����ڂ������j
		print (substr($this->m_urlStringCache, 1));
		// �L���b�V���̃N���A
		unset ($this->m_urlStringCache);
	}

	/*====================================================================
	 	�֐����F GetUrlFormat
	 	�T�@�v�F �S�Ẵt�H�[���f�[�^��URL�`���̕�����Ƃ��ďo��
	 	���@���F �Ȃ�
		�߂�l�F �Ȃ�
	*/
	function GetUrlFormat () {
		// �L���b�V���p��URL�f�[�^���N���A
		$this->m_urlStringCache = "";
		// �t�H�[���f�[�^��URL�`���Ŏ擾
		$this->_SetFormValues(PROC_URLFORMAT_STRING);
		// URL�f�[�^�̏o�́i1�����ڂ������j
		$values = substr($this->m_urlStringCache, 1);
		// �L���b�V���̃N���A
		unset ($this->m_urlStringCache);
		
		return $values;
	}

	/*====================================================================
	 	�֐����F _SetFormValues
	 	�T�@�v�F ��M�����S�Ẵt�H�[���f�[�^�������Ƃ��Ďw�肳�ꂽ���@�ŏ�������
	 	���@���F
		 	arg1�F  int/value
				0: �I�u�W�F�N�g�̃����o�Ƃ��ēo�^
				1: HTML��hidden�^�O�Ƃ��ďo��
				2: URL�`���̕�����Ƃ��ďo��
		�߂�l�F �Ȃ�
	*/
	function _SetFormValues ($processingMethod) {
		// ����������
		$this->_Initialize();
		// ���M���ꂽ�S�t�H�[���f�[�^���擾
		$formData = ($this->requestMethod == "POST" ? $_POST : $_GET);

		reset ($formData);
		for ($i = 0; $i < count($formData); $i ++){
			// �����Ώۂ̃t�H�[�������擾
			$formName = key($formData);
			// �t�H�[���f�[�^�͔z��
			if (is_array($formData[$formName])) {
				reset ($formData[$formName]);
				// �z��̗v�f���J��Ԃ�
				do {
					// �t�H�[���̗v�f�����擾
					$formKeyName = key($formData[$formName]);
					// �t�H�[���̒l���擾
					$formValue = $this->_ConvertCorrectValue ($formData[$formName][$formKeyName]);
					// �t�H�[��������
					$this->_SetTargetFormValue ($formName, $formKeyName, $formValue, $processingMethod);
					
				} while (next ($formData[$formName]));
			}
			else {
				// �t�H�[���̒l���擾
				$formValue = $this->_ConvertCorrectValue ($formData[$formName]);
				// �t�H�[��������
				$this->_SetTargetFormValue ($formName, "", $formValue, $processingMethod);
			}
			// ���̃t�H�[���̒l�ֈړ�
			next($formData);
		}
	}


	/*====================================================================
	 	�֐����F _SetFormValues
	 	�T�@�v�F �t�H�[���f�[�^�������Ƃ��Ďw�肳�ꂽ���@�ŏ�������
	 	���@���F
		 	arg1�F  string/value
				�t�H�[����
		 	arg2�F  string/value
				�t�H�[�����z��ł���ꍇ�̗v�f���܂��͓Y��
				�t�H�[�����z��łȂ��ꍇ�͋󕶎����w��
		 	arg3�F  string/value
				�t�H�[���̒l
		 	arg4�F  int/value
				0: �I�u�W�F�N�g�̃����o�Ƃ��ēo�^
				1: HTML��hidden�^�O�Ƃ��ďo��
				2: URL�`���̕�����Ƃ��ďo��
		�߂�l�F �Ȃ�
	*/
	function _SetTargetFormValue ($formName, $formKeyName, $formValue, $processingMethod) {
		// �������@�̐U�蕪��
		switch ($processingMethod) {
			default:
			// �l���I�u�W�F�N�g�̃����o�Ƃ��ăZ�b�g����
			case PROC_SET_PROPERTIES:
				if ($formKeyName === "") {
					$this->{$formName} = $formValue;
				}
				else {
					$this->{$formName}[$formKeyName] = $formValue;
				}
				break;
				
			// �l��HTML�^�O�Ƃ��ăZ�b�g����
			case PROC_HTML_HIDDENTAGS:
				if (!in_array($formName, $this->eraseHiddenTages)) {
					$this->m_hiddenTagCache .= "<input type=\"hidden\" name=\"".$formName.($formKeyName === "" ? "" : ("[".$formKeyName."]"))."\" value=\"".$this->m_encodeHeader.base64_encode($formValue)."\">\n";
				}
				break;
				
			// �l��URL�Ƃ��ăZ�b�g����
			case PROC_URLFORMAT_STRING:
				if (!in_array($formName, $this->eraseHiddenTages)) {
					$this->m_urlStringCache .= "&".$formName.($formKeyName === "" ? "" : ("[".$formKeyName."]"))."=".urlencode($formValue);
				}
				break;
		}
	}


	/*====================================================================
	 	�֐����F _ConvertCorrectValue
	 	�T�@�v�F �f�[�^��BASE64�ŃG���R�[�h����Ă���ꍇ�Ƀf�R�[�h�������s��
	 	���@���F
		 	arg1�F  string/value
				�����Ώە�����
		�߂�l�F string/�ϊ��㕶����
	*/
	function _ConvertCorrectValue ($convertValue) {
		$headerLength = strlen($this->m_encodeHeader);

		// BASE64�G���R�[�h�f�[�^�ł���΁i�擪�Ƀw�b�_���j�f�R�[�h�������s��
		if (substr ($convertValue, 0, $headerLength) == $this->m_encodeHeader) {
			$convertValue = base64_decode (substr ($convertValue, $headerLength));
			$useEscape = false;
		}
		else if ($this->m_stripSlashes) {
			$useEscape = true;
		}
		else {
			$useEscape = false;
		}
		
		// �����t�H�[�}�b�g�̒���
		$convertValue = $this->_ConvertEscapeString($convertValue, $useEscape);
		
		return $convertValue;
	}


	/*====================================================================
	 	�֐����F _ConvertEscapeString
	 	�T�@�v�F �����Ώە�����̉��s�R�[�h����Ȃǃt�H�[�}�b�g�𒲐�����
	 	���@���F
		 	arg1�F  string/value
				�����Ώە�����
		�߂�l�F string/�ϊ��㕶����
	*/
	function _ConvertEscapeString ($convertString, $useEscape) {
		$convertString = str_replace ("\r\n", "\n", $convertString);
		$convertString = str_replace ("\r", "\n", $convertString);
		
		if ($useEscape) {
			// ������̃N�H�[�g�������s��
			$convertString = stripslashes ($convertString);
		}
		
		return $convertString;
	}


	/*====================================================================
		�֐����F Destroy
		�T�@�v�F �I�u�W�F�N�g�J���֐�
		���@���F �Ȃ�
		�߂�l�F �Ȃ�
	*/
	function Destroy() {
		unset($this);
	}
}
?>