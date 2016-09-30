<?php
	//ajax傳輸
	$post = $request->all();
	if ( ! empty($post)){
		//透過服務加工post參數
		switch ($post['action']) {
			case 'onlineUserIdRegister': //在線人數統計
				//總人數
	 			$returnOnlineUser = $onlineUsersAmount->UserManageDependRequest($request);
	 			$post['onlineUserId'] = $returnOnlineUser['onlineUserId']; //線上使用者id=總瀏覽數
	 			$post['OnlineAmount'] = $returnOnlineUser['OnlineAmount']; //在線人數
	 			//聊天室人數
	 			if (isset($OnlineChatUsers)){
					$OnlineChatUserCount = $OnlineChatUsers->count();
					$OnlineChatUsers = $OnlineChatUsers->toArray();
					$post['OnlineChatUserCount'] = $OnlineChatUserCount; 
					$post['OnlineChatUsers'] = $OnlineChatUsers; //聊天室使用者與數目
				}
				break;
			case 'stateCode': //顯示原碼請求
				$Code = $stateCode->getCodeByTitle($post['codeTitle']);
 				$post['Code'] = $Code;
				break;
			case 'stateAjaxChatRoom': //顯示聊天室
				//$chatTimeFlag = $Timeflag->returnChatLastTime();
				$chatTimeFlag = $mngFile->getVar("chatTimeFlag"); //新版 使用檔案做為時間旗標
				if ($chatTimeFlag > $post['chatStateTime']){
					$chatdata = $Ajaxchatroommodel->stateChat($post['chatStateTime'],$Ajaxchatroommodel->chatMaxAmount); //顯示聊天新資料
					foreach ($chatdata as $key=>$val){
						$timeFlag = ($chatdata[$key]['time']);
						date_default_timezone_set('Asia/Taipei'); //時區設定
						$chatdata[$key]['timeHis'] = date('H:i:s',$timeFlag);
						$chatdata[$key]['timeYmd'] = date('Ymd',$timeFlag);	//處理時間格式
					}
					$post['chatData'] = $chatdata; //透過post傳輸
				}
				break;
			case 'inputAjaxChatRoom': //插入聊天室
				$Ajaxchatroommodel->insertChat($post['chatContent'],$post['speaker'],$post['chatColor']);
				//$Timeflag->updataChatLastTime();
				$mngFile->putVar("chatTimeFlag",time()); //新版 使用檔案做為時間旗標
				setcookie('cookie_speaker',$post['speaker'] ,time()+60*60*24);
				setcookie('cookie_chatColor',$post['chatColor'] ,time()+60*60*24);
				break;
			case 'accToJsonDownload': //產生加速度json檔
				//json檔案資訊
				$jsonData = $post;
				$filename = 'accJson'.$post['onlineUserId'].'.json';
				$dir = 'public/files/';
				unset($jsonData['_token']); //剃除不必要的資訊
				unset($jsonData['action']);
				unset($jsonData['onlineUserId']);
				$mngFile->putVar($filename,$jsonData); //產生檔案
				//刪除舊檔
				$scanDel = scandir($dir,0);
				foreach ($scanDel as $val){
					preg_match("/^accJson(.*)\.json/",$val ,$matches); //判斷舊檔
					if($matches){
						if ($matches[1] <= ($post['onlineUserId']-3)){ //最多保留3個檔案
							unlink($dir.$matches[0]);
						}
					}
				}
				//刪除不必要的回傳資訊
				unset($post['accX']);
				unset($post['accY']);
				unset($post['accZ']);
				unset($post['rss']);
				//提供下載路徑
				$post['jsonUrl'] = $dir.$filename;
				break;

			default:
				# code...
				break;
		}

		unset($post['_token']);
		unset($post['action']);
		echo json_encode($post); //將參數交給各頁面js處理
		exit();
	}