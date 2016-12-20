<?php

			//請求簽名
			$params = array();
			$params['version'] = 'V2.0';
			$params['nonce_str'] = md5(rand());
			$params['mer_no'] = $payment['yompay_merNo'];
			$params['order_no'] = $order['order_sn'];
			$params['trade_date'] = substr($order['order_sn'], 0,8);

			ksort($params);

			$fields = array();
			foreach($params as $key => $val){
				
				$fields[] = "$key=$val";
			}
			$md5str = implode('&',$fields).'&KEY='.$payment['yompay_md5key'];
			$params['sign'] = md5($md5str);

			//送出請求
			$postdata = http_build_query($params);
			logReturn($postdata);
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,"https://api.yompay.com/query/");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_PROXY, $payment['common_proxy']);
			$output = curl_exec($ch);
			$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
			$curl_error = curl_error($ch);

				//$obj = json_decode($output,true);
				$json = json_decode($output);
				//json解析
				$status = $json->status; //請求狀態
				$orderStatus = $json->content->orderStatus; //訂單狀態
				$orderNo = $json->content->orderNo; //訂單編號
				$orderAmount = $json->content->orderAmount; //訂單金額
				$orderTime = $json->content->orderTime; //訂單時間
				$bankCode = $json->content->bankCode; //銀行代碼


				//xml解析
				$xml = simplexml_load_string($output);
				$arr = array();
				foreach($xml->children() as $child)
				{
				  	if($child->getName() == 'pays'){
						foreach($child->children()->children() as $payChild)
						{
							$arr[$payChild->getName()] = $payChild;
						}
				  	}
				  	else{
				  		$arr[$child->getName()] = $child;
				  	}
				}


				//查询字符串 解析
				parse_str($output,$arr) ;


				http_build_query($str);
				base64_encode(md5($sign_string,true));

				$row['BetEndDate'] = date("Y-m-d H:i:s",strtotime($row['BetEndDate'].' GMT+8'));	




				// 建立CURL連線
				$ch = curl_init();

				// 設定擷取的URL網址
				curl_setopt($ch, CURLOPT_URL, "/testpost.php");
				curl_setopt($ch, CURLOPT_HEADER, false);
				//將curl_exec()獲取的訊息以文件流的形式返回，而不是直接輸出。
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

				//設定要傳的 變數A=值A & 變數B=值B (中間要用&符號串接)
				$PostData = "a=abc&b=def";

				//設定CURLOPT_POST 為 1或true，表示要用POST方式傳遞
				curl_setopt($ch, CURLOPT_POST, 1); 
				//CURLOPT_POSTFIELDS 後面則是要傳接的POST資料。
				curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);

				// 執行
				$temp=curl_exec($ch);
				echo $temp; //輸出回傳的值

				// 關閉CURL連線
				curl_close($ch)
				
?>