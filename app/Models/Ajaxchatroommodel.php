<?php 
	namespace App\Models;
	use Illuminate\Database\Eloquent\Model;

	class Ajaxchatroommodel extends Model
	{
		public $chatMaxAmount = 50;

		public $timestamps = false;
		protected $fillable = ['time','content','speaker','color'];

		function insertChat($content,$speaker,$color){ //插入聊天內容
			$time = time();
			$this->create(compact('time','content','speaker','color'));	
			return $time;
		}

		function stateChat($time,$maxAmount){ //讀取聊天資料
			$stateChat = $this->where('time','>',$time)->orderBy('id', 'desc')->get()->take($maxAmount);
			$stateChatArray = $stateChat->toArray();
			if ($stateChat->count()== $this->chatMaxAmount ){
				$this->where('id','<',$stateChatArray[$this->chatMaxAmount-1]['id'])->delete();

			}
			return $stateChatArray;
		}
	}

