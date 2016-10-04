<?php
	namespace App\Http\Controllers;
	use Illuminate\Routing\Controller as BaseController;
	use Illuminate\Http\Request;

	use App\Models\Onlineuser;	

	class weather extends BaseController 
	{
		public function index(
			\App\Services\onlineUsersAmount $onlineUsersAmount,
			\App\Services\stateCode $stateCode,
			Request $request
		){
			require_once('public/ajax.inc.php');
	 		//視圖顯示
	 		return view('weather');
		}

	}


