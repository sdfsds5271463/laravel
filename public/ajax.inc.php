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

			default:
				# code...
				break;
		}

		unset($post['_token']);
		echo json_encode($post); //將參數交給各頁面js處理
		exit();
	}