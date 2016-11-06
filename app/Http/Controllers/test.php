<?php
	namespace App\Http\Controllers;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Http\Request;
	use App\Models\Onlineuser;	

	use App\Models\Ajaxchatroommodel;


use App\Http\Controllers\test\putVarFile;	
	class test extends BaseController 
	{
		public function index(
			\App\Services\onlineUsersAmount $onlineUsersAmount,
			\App\Services\stateCode $stateCode,
			\App\Services\manageVarFile $mngFile,
			Request $request
		){
			echo "test";

			//$RR = ["A"=>1,"B"=>2,"C"=>3];
			//$mngFile->putVar("TT",$RR);

			print_r($mngFile->getVar("eee"));
			//$filePath = "public/files/";

        	//serialize($A); //儲存格式轉換
        	//unserialize($A); //儲存格式還原，如實儲存php變數的方法
			//$fileName = "usersAndTime";
			//file_get_contents("test.txt"); //回傳檔案內容 (可以抓網址的資料)

			//putVarFile("ttt",$filePath);
			//putVarFile("ttt",$filePath);
			
			//$filePath = "public/files/";


				$flag = $mngFile->getVar("chatTimeFlag");
				$chatTimeFlag = $flag; //新版 使用檔案做為時間旗標
				print_r($flag->flag);
        	
		}
	}


