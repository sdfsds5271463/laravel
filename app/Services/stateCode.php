<?php 
	namespace App\Services;

	class stateCode{
		public $codeGetFile;

		function __construct(){
			//程式碼對應檔案庫
			$getDir = "default";
				$this->codeGetFile[$getDir]['內容模板'] = 			file_get_contents("resources/views/index.blade.php");
				$this->codeGetFile[$getDir]['AJAX接收請求端'] = 	file_get_contents("public/ajax.inc.php");
				$this->codeGetFile[$getDir]['控制器php'] = 			file_get_contents("app/Http/Controllers/index.php");
				$this->codeGetFile[$getDir]['控制器service'] = 		file_get_contents("app/Services/onlineUsersAmount.php");
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	file_get_contents("public/js/Services/onlineUsersAmount.js");
				$this->codeGetFile[$getDir]['資料庫model'] = 		file_get_contents("app/Models/Onlineuser.php");
				$this->codeGetFile[$getDir]['服務提供者'] =		 	file_get_contents("app/Services/LaraServiceProvider.php");
				$this->codeGetFile[$getDir]['路由設定'] = 			file_get_contents("app/Http/routes.php");
				$this->codeGetFile[$getDir]['框架模板'] = 			file_get_contents("resources/views/frame.blade.php");
				$this->codeGetFile[$getDir]['框架css'] = 			file_get_contents("public/css/frame.css");
				$this->codeGetFile[$getDir]['框架javaScript'] = 	file_get_contents("public/js/frame.js");
			$getDir = "ajaxChatRoom";
				$this->codeGetFile[$getDir]['內容模板'] = 			file_get_contents("resources/views/ajaxChatRoom.blade.php");
				$this->codeGetFile[$getDir]['控制器php'] = 			file_get_contents("app/Http/Controllers/ajaxChatRoom.php");
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	file_get_contents("public/js/Services/ajaxChatRoom.js");
				$this->codeGetFile[$getDir]['資料庫model'] = 		file_get_contents("app/Models/Ajaxchatroommodel.php");

		}
		function getCodeByTitle($codeTitle){ 
			$indexDir = str_replace('index.php','',$_SERVER['PHP_SELF']);
			$getDir = str_replace($indexDir,'',$_SERVER['REQUEST_URI']); //取得get目錄

			if (empty($getDir)){$getDir = "default";} //根目錄
			if ( ! isset($this->codeGetFile[$getDir][$codeTitle])){
				$getDir = "default"; //沒設定的呼叫首頁程式碼
			}

			$Code = $this->codeGetFile[$getDir][$codeTitle];
			return $Code;
		}
	}
