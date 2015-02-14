<?php


/*====================================================================
	クラス名：FormValues
	概　　要：フォームデータ処理クラス
*/
class FormValues {

	var $m_encodeHeader;
	var $requestMethod;
	var $m_hiddenTagCache;
	var $m_urlStringCache;
	var $m_stripSlashes;
	var $eraseHiddenTages;
	
	function _Initialize () {
		// 文字列のクォート除去設定フラグ (true:行う|false:行わない）
		$this->m_stripSlashes = true;
		$this->m_encodeHeader = ".b64:";
		$this->requestMethod = $_SERVER["REQUEST_METHOD"];

		// フォームデータの処理方法
		define ("PROC_SET_PROPERTIES", 0);
		define ("PROC_HTML_HIDDENTAGS", 1);
		define ("PROC_URLFORMAT_STRING", 2);
	}


	/*====================================================================
		※コンストラクタ
		関数名： FormValues
		概　要： 送信された全てのフォームデータをメンバとして登録
		引　数： なし
	*/
	function FormValues () {
		// hiddenタグ非出力対象データ格納用変数の初期化
		$this->eraseHiddenTages = array();
		// フォームデータをオブジェクトのメンバとしてセット
		$this->_SetFormValues(PROC_SET_PROPERTIES);
	}


	/*====================================================================
	 	関数名： SetEraseHiddenValue
	 	概　要： 指定した要素をhiddenタグとして非出力対象とする
	 	引　数： 非出力対象フォーム名
		戻り値： なし
	*/
	function SetEraseHiddenValue ($formName) {
		$this->eraseHiddenTages[] = $formName;
	}


	/*====================================================================
	 	関数名： OutputHiddenTags
	 	概　要： 全てのフォームデータをHTMLのhiddenタグとして出力
	 	引　数： なし
		戻り値： なし
	*/
	function OutputHiddenTags () {
		// キャッシュ用のタグデータをクリア
		$this->m_hiddenTagCache = "";
		// フォームデータをhiddenタグで取得
		$this->_SetFormValues(PROC_HTML_HIDDENTAGS);
		// タグデータの出力
		print ($this->m_hiddenTagCache);
		// キャッシュのクリア
		unset ($this->m_hiddenTagCache);
	}

	/*====================================================================
	 	関数名： GetHiddenTags
	 	概　要： 全てのフォームデータをHTMLのhiddenタグとして取得
	 	引　数： なし
		戻り値： なし
	*/
	function GetHiddenTags () {
		// キャッシュ用のタグデータをクリア
		$this->m_hiddenTagCache = "";
		// フォームデータをhiddenタグで取得
		$this->_SetFormValues(PROC_HTML_HIDDENTAGS);
		// タグデータの取得
		$values = $this->m_hiddenTagCache;
		// キャッシュのクリア
		unset ($this->m_hiddenTagCache);

		return $values;
	}

	/*====================================================================
	 	関数名： GetArrayValues
	 	概　要： 全てのフォームデータを連想配列として取得
	 	引　数： なし
		戻り値： なし
	*/
	function GetArrayValues () {
		// メンバ変数を取得し、連想配列として構築
		foreach ($this as $key => $value) {
			$arrayValues[$key] = $value;
		}

		return $arrayValues;
	}

	/*====================================================================
	 	関数名： OutputUrlFormat
	 	概　要： 全てのフォームデータをURL形式の文字列として出力
	 	引　数： なし
		戻り値： なし
	*/
	function OutputUrlFormat () {
		// キャッシュ用のURLデータをクリア
		$this->m_urlStringCache = "";
		// フォームデータをURL形式で取得
		$this->_SetFormValues(PROC_URLFORMAT_STRING);
		// URLデータの出力（1文字目を除去）
		print (substr($this->m_urlStringCache, 1));
		// キャッシュのクリア
		unset ($this->m_urlStringCache);
	}

	/*====================================================================
	 	関数名： GetUrlFormat
	 	概　要： 全てのフォームデータをURL形式の文字列として出力
	 	引　数： なし
		戻り値： なし
	*/
	function GetUrlFormat () {
		// キャッシュ用のURLデータをクリア
		$this->m_urlStringCache = "";
		// フォームデータをURL形式で取得
		$this->_SetFormValues(PROC_URLFORMAT_STRING);
		// URLデータの出力（1文字目を除去）
		$values = substr($this->m_urlStringCache, 1);
		// キャッシュのクリア
		unset ($this->m_urlStringCache);
		
		return $values;
	}

	/*====================================================================
	 	関数名： _SetFormValues
	 	概　要： 受信した全てのフォームデータを引数として指定された方法で処理する
	 	引　数：
		 	arg1：  int/value
				0: オブジェクトのメンバとして登録
				1: HTMLのhiddenタグとして出力
				2: URL形式の文字列として出力
		戻り値： なし
	*/
	function _SetFormValues ($processingMethod) {
		// 初期化処理
		$this->_Initialize();
		// 送信された全フォームデータを取得
		$formData = ($this->requestMethod == "POST" ? $_POST : $_GET);

		reset ($formData);
		for ($i = 0; $i < count($formData); $i ++){
			// 処理対象のフォーム名を取得
			$formName = key($formData);
			// フォームデータは配列か
			if (is_array($formData[$formName])) {
				reset ($formData[$formName]);
				// 配列の要素分繰り返す
				do {
					// フォームの要素名を取得
					$formKeyName = key($formData[$formName]);
					// フォームの値を取得
					$formValue = $this->_ConvertCorrectValue ($formData[$formName][$formKeyName]);
					// フォームを処理
					$this->_SetTargetFormValue ($formName, $formKeyName, $formValue, $processingMethod);
					
				} while (next ($formData[$formName]));
			}
			else {
				// フォームの値を取得
				$formValue = $this->_ConvertCorrectValue ($formData[$formName]);
				// フォームを処理
				$this->_SetTargetFormValue ($formName, "", $formValue, $processingMethod);
			}
			// 次のフォームの値へ移動
			next($formData);
		}
	}


	/*====================================================================
	 	関数名： _SetFormValues
	 	概　要： フォームデータを引数として指定された方法で処理する
	 	引　数：
		 	arg1：  string/value
				フォーム名
		 	arg2：  string/value
				フォームが配列である場合の要素名または添字
				フォームが配列でない場合は空文字を指定
		 	arg3：  string/value
				フォームの値
		 	arg4：  int/value
				0: オブジェクトのメンバとして登録
				1: HTMLのhiddenタグとして出力
				2: URL形式の文字列として出力
		戻り値： なし
	*/
	function _SetTargetFormValue ($formName, $formKeyName, $formValue, $processingMethod) {
		// 処理方法の振り分け
		switch ($processingMethod) {
			default:
			// 値をオブジェクトのメンバとしてセットする
			case PROC_SET_PROPERTIES:
				if ($formKeyName === "") {
					$this->{$formName} = $formValue;
				}
				else {
					$this->{$formName}[$formKeyName] = $formValue;
				}
				break;
				
			// 値をHTMLタグとしてセットする
			case PROC_HTML_HIDDENTAGS:
				if (!in_array($formName, $this->eraseHiddenTages)) {
					$this->m_hiddenTagCache .= "<input type=\"hidden\" name=\"".$formName.($formKeyName === "" ? "" : ("[".$formKeyName."]"))."\" value=\"".$this->m_encodeHeader.base64_encode($formValue)."\">\n";
				}
				break;
				
			// 値をURLとしてセットする
			case PROC_URLFORMAT_STRING:
				if (!in_array($formName, $this->eraseHiddenTages)) {
					$this->m_urlStringCache .= "&".$formName.($formKeyName === "" ? "" : ("[".$formKeyName."]"))."=".urlencode($formValue);
				}
				break;
		}
	}


	/*====================================================================
	 	関数名： _ConvertCorrectValue
	 	概　要： データがBASE64でエンコードされている場合にデコード処理を行う
	 	引　数：
		 	arg1：  string/value
				処理対象文字列
		戻り値： string/変換後文字列
	*/
	function _ConvertCorrectValue ($convertValue) {
		$headerLength = strlen($this->m_encodeHeader);

		// BASE64エンコードデータであれば（先頭にヘッダ情報）デコード処理を行う
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
		
		// 文字フォーマットの調整
		$convertValue = $this->_ConvertEscapeString($convertValue, $useEscape);
		
		return $convertValue;
	}


	/*====================================================================
	 	関数名： _ConvertEscapeString
	 	概　要： 処理対象文字列の改行コード統一などフォーマットを調整する
	 	引　数：
		 	arg1：  string/value
				処理対象文字列
		戻り値： string/変換後文字列
	*/
	function _ConvertEscapeString ($convertString, $useEscape) {
		$convertString = str_replace ("\r\n", "\n", $convertString);
		$convertString = str_replace ("\r", "\n", $convertString);
		
		if ($useEscape) {
			// 文字列のクォート除去を行う
			$convertString = stripslashes ($convertString);
		}
		
		return $convertString;
	}


	/*====================================================================
		関数名： Destroy
		概　要： オブジェクト開放関数
		引　数： なし
		戻り値： なし
	*/
	function Destroy() {
		unset($this);
	}
}
?>