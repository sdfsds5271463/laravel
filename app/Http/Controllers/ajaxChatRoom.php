<?php
	namespace App\Http\Controllers;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Http\Request;
	use App\Models\Onlineuser;	

	use App\Models\Timeflag;
	use App\Models\Ajaxchatroommodel;

	class ajaxChatRoom extends BaseController 
	{
		public function index(
			\App\Services\onlineUsersAmount $onlineUsersAmount,
			\App\Services\stateCode $stateCode,
			Request $request
		){
			$Timeflag = new Timeflag;
			//$Timeflag->updataChatLastTime();
			//$Timeflag->returnChatLastTime();
	 		
	 		$Ajaxchatroommodel = new Ajaxchatroommodel;
			//$Ajaxchatroommodel->insertChat(1,2,3);
	 		//$TT = $Ajaxchatroommodel->stateChat(0,100);
			$OnlineChatUsers = Onlineuser::where('chatSpeakerName','!=','')->get(); //顯示聊天室使用者
			//ajax傳輸
			require_once('public/ajax.inc.php');

			//print_r($TT);
	 		//視圖顯示
	 		return view('ajaxChatRoom');
		}
	}


