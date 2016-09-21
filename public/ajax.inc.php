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
				if ($Timeflag->returnChatLastTime() > $post['chatStateTime']){
					$post['chatData'] = $Ajaxchatroommodel->stateChat($post['chatStateTime'],$Ajaxchatroommodel->chatMaxAmount); //顯示聊天新資料
				}
				break;
			case 'inputAjaxChatRoom': //插入聊天室
				$Ajaxchatroommodel->insertChat($post['chatContent'],$post['speaker'],$post['chatColor']);
				$Timeflag->updataChatLastTime();
				setcookie('cookie_speaker',$post['speaker'] ,time()+60*60*24);
				setcookie('cookie_chatColor',$post['chatColor'] ,time()+60*60*24);
				break;

			default:
				# code...
				break;
		}

		echo json_encode($post); //將參數交給各頁面js處理
		exit();
	}