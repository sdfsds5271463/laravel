<?php 
	namespace App\Services;

	class manageVarFile{

		private $filePath = "public/files/";

		function __construct(){
		}

		//將變數編成json存入
		function putVar($fileName,$var){
			$var = json_encode($var);
			file_put_contents($this->filePath.$fileName,$var);
		}
		//取出json
		function getVar($fileName){
			$dirList = scandir($this->filePath,0);
			if (! in_array($fileName,$dirList)){
				//file_put_contents($this->filePath.$fileName,"");
				return;
			}
			$var = file_get_contents($this->filePath.$fileName);
			$var = json_decode($var);
			return $var;
		}

	}
