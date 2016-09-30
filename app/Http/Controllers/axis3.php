<?php
	namespace App\Http\Controllers;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Http\Request;

	use App\Models\Onlineuser;	

	class axis3 extends BaseController 
	{
		public function video(
			\App\Services\onlineUsersAmount $onlineUsersAmount,
			\App\Services\stateCode $stateCode,
			Request $request
		){
			require_once('public/ajax.inc.php');
	 		//視圖顯示
	 		return view('axis3Video');
		}


		public function record(
			\App\Services\onlineUsersAmount $onlineUsersAmount,
			\App\Services\stateCode $stateCode,
			\App\Services\manageVarFile $mngFile,
			Request $request
		){
			require_once('public/ajax.inc.php');
	 		//視圖顯示
	 		return view('axis3Record');
		}

	}


