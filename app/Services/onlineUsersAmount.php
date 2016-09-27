<?php 
	namespace App\Services;
	use App\Models\Onlineuser;	

	class onlineUsersAmount{
		public $request;

		function __construct(){
		}
		//自動註冊回報刪除線上使用者
		function UserManageDependRequest($request){ 
			$this->request = $request;
			$onlineUserId = $request->input('onlineUserId');
			$chatSpeakerName = $request->input('chatSpeakerName'); //順便註冊聊天室名

			if ($onlineUserId <= 0){ //第一次登入，無id記錄
		 		$Onlineuser = new Onlineuser;
				$Onlineuser->reportTime = time();
				$Onlineuser->chatSpeakerName = $chatSpeakerName; 
				$Onlineuser->save();
				$Onlineuser = $Onlineuser->toArray();
				$onlineUserId = $Onlineuser['id'];//線上人數註冊，取得新id
				setcookie('onlineUserId', $onlineUserId); 
			}
			else{
				$updata = Onlineuser::where('id','=',$onlineUserId )->
								update(['reportTime' => time(),'chatSpeakerName' =>$chatSpeakerName]); //已登入者回報時間
				if (! $updata){$onlineUserId = 0; } //閒置後ID遭刪除重新取得ID
			}
			//刪除秒不回報時間者
			Onlineuser::where('reportTime','<=',time()-21 )->delete();

			//更新在線人數與瀏覽次數
			$returnOnlineUser = ['OnlineAmount'=>Onlineuser::all()->count(), 'onlineUserId'=>(int)$onlineUserId ];
			return $returnOnlineUser;
		}
	}
