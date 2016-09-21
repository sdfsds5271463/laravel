<?php 
	namespace App\Models;
	use Illuminate\Database\Eloquent\Model;

	class Timeflag extends Model
	{
		public $timestamps = false;
		protected $fillable = ['chatLastTime'];

		function updataChatLastTime(){ //聊天室時間旗標
			$this->find(1)->update(['chatLastTime' => time()]); 
			return time();
		}
		function returnChatLastTime(){ //聊天室時間旗標
			$Timeflag = $this->find(1)->toArray(); 
			return $Timeflag['chatLastTime'];
		}
	}

