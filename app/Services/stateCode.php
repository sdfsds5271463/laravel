<?php 
	namespace App\Services;

	class stateCode{
		public $codeGetFile;

		function __construct(){
			//程式碼對應檔案庫
			$getDir = "default";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/index.blade.php";
				$this->codeGetFile[$getDir]['AJAX接收請求端'] = 	"public/ajax.inc.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/index.php";
				$this->codeGetFile[$getDir]['控制器service'] = 		"app/Services/onlineUsersAmount.php";
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	"public/js/Services/onlineUsersAmount.js";
				$this->codeGetFile[$getDir]['資料庫model'] = 		"app/Models/Onlineuser.php";
				$this->codeGetFile[$getDir]['服務提供者'] =		 	"app/Services/LaraServiceProvider.php";
				$this->codeGetFile[$getDir]['路由設定'] = 			"app/Http/routes.php";
				$this->codeGetFile[$getDir]['框架模板'] = 			"resources/views/frame.blade.php";
				$this->codeGetFile[$getDir]['框架css'] = 			"public/css/frame.css";
				$this->codeGetFile[$getDir]['框架javaScript'] = 	"public/js/frame.js";
				//------我是分格線------------我是分格線------------我是分格線------------我是分格線------------我是分格線------
				$this->codeGetFile[$getDir]['Html基本語法'] = 		"P20160926/Html.html";
				$this->codeGetFile[$getDir]['Css基本語法'] = 		"P20160926/Css.html";
				$this->codeGetFile[$getDir]['Rwd頁面基礎'] = 		"P20160926/Rwd.html";
				$this->codeGetFile[$getDir]['javascript基本語法'] = "P20160926/JavaScript.html";
				$this->codeGetFile[$getDir]['canvas基本操作'] = 	"P20160926/Canvas-animation.html";
				$this->codeGetFile[$getDir]['jQuery基本語法'] = 	"P20160926/jQuery.html";
				$this->codeGetFile[$getDir]['jQuery UI常用語法'] =	"P20160926/jQueryUI.html";
				$this->codeGetFile[$getDir]['php類別基礎'] = 		"P20160926/php0-oop.php";
				$this->codeGetFile[$getDir]['php基本語法'] = 		"P20160926/php1-normal.php";
				$this->codeGetFile[$getDir]['php檔案處理'] = 		"P20160926/php2-file.php";
				$this->codeGetFile[$getDir]['php dataURL'] = 		"P20160926/php3-dataURL.php";
				$this->codeGetFile[$getDir]['php資料庫相關'] = 		"P20160926/php-mysqli.php";
				$this->codeGetFile[$getDir]['php 其他雜記'] = 		"P20160926/php9-highNote.php";

			$getDir = "teach";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/teach.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/teach.php";

			$getDir = "ajaxChatRoom";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/ajaxChatRoom.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/ajaxChatRoom.php";
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	"public/js/Services/ajaxChatRoom.js";
				$this->codeGetFile[$getDir]['資料庫model'] = 		"app/Models/Ajaxchatroommodel.php";

			$getDir = "weather";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/weather.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/weather.php";
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	"public/js/Services/weather.js";

			$getDir = "box2d";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/box2d.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/box2d.php";
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	"public/js/Services/box2d.js";

			$getDir = "axis3Record";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/axis3Record.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/axis3.php";
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	"public/js/Services/axis3Record.js";

			$getDir = "axis3Video";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/axis3Video.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/axis3.php";
				$this->codeGetFile[$getDir]['控制器javaScript'] = 	"public/js/Services/axis3Video.js";

			$getDir = "axis3Data";
				$this->codeGetFile[$getDir]['內容模板'] = 			"resources/views/axis3Data.blade.php";
				$this->codeGetFile[$getDir]['控制器php'] = 			"app/Http/Controllers/axis3.php";



		}
		function getCodeByTitle($codeTitle){ 
			$indexDir = str_replace('index.php','',$_SERVER['PHP_SELF']);
			$getDir = str_replace($indexDir,'',$_SERVER['REQUEST_URI']); //取得get目錄

			if (empty($getDir)){$getDir = "default";} //根目錄
			$Code = "";
			if ( ! isset($this->codeGetFile[$getDir][$codeTitle])){
				$getDir = "default"; //沒設定的呼叫首頁程式碼
				$Code .= "※此頁面為框架資源，因為內容頁無特定資料※
";
			}
			$Code .= file_get_contents($this->codeGetFile[$getDir][$codeTitle]);
			return $Code;
		}
	}
