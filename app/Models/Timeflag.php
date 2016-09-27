<?php 
	namespace App\Models;
	use Illuminate\Database\Eloquent\Model;

	class Timeflag extends Model
	{
		/*此模組已經停止使用，多次僅讀取的訊息檔案已修改為檔案存取，減少AJAX的POST雙向請求*/
		public $timestamps = false;
		protected $fillable = ['chatLastTime'];

		function updataChatLastTime(){ //聊天室時間旗標更新
			$this->find(1)->update(['chatLastTime' => time()]); 
			return time();
		}
		function returnChatLastTime(){ //聊天室時間旗標獲取
			$Timeflag = $this->find(1)->toArray(); 
			return $Timeflag['chatLastTime'];
		}
	}

