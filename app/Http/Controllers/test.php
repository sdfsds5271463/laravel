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
		}

		public function getIndex(){
			echo "getIndex";        	
		}
	}


