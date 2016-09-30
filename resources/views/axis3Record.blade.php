@extends('frame')
@section('main')
<script>
	var timer;    // 計時器物件
	var accMax=0; // 記錄最大值
	$(function(){
		// 若支援方向事件, 即註冊事件處理函式
		if(window.DeviceMotionEvent){
			window.addEventListener('devicemotion', function(e){
				if(e.accelerationIncludingGravity.x == null) {
					$('#msg').text('不支援 accelerationIncludingGravity');
				}
				else {
					// 將傳入的感測值存到變數中
					x = e.accelerationIncludingGravity.x;
					y = e.accelerationIncludingGravity.y;
					z = e.accelerationIncludingGravity.z;

					// ----------顯示感測值----------
					// 用toFixed(2)表示只顯示到小數點後第 2 位
					$('#x').text(x.toFixed(2));
					$('#y').text(y.toFixed(2));
					$('#z').text(z.toFixed(2));

					// ----------計算總加速度----------
					// x,y,z 平方相加後開根號
					acc = Math.sqrt(x*x+y*y+z*z);
					$('#acc').text(acc.toFixed(2));

					// -------判斷是安打或全壘打-------
					// 若總加速度值大於 '最大值'
					if(acc>accMax) {
						accMax = acc;  // 記錄最大值
						if(acc>20)  {
							if(acc>24){
								$('#msg').text('全壘打! ' + acc.toFixed(2) );
							}
							else {
								$('#msg').text('安打! ' + acc.toFixed(2));
							}

							// 若已啟動計時器, 則清除之
							if(timer) clearTimeout(timer);

							// 設定 3 秒後重新顯示 '請揮棒!'
							timer = setTimeout(function(){
								$('#msg').text('請揮棒!');
								accMax=0;  // 重設最大值
							}, 3000);
						}  // end of if(acc>20)
					}
				} // end of else
			});
		}
		else  {  // 若不支援註冊事件, 則顯示訊息
			$('#msg').text('裝置不支援 DeviceMotionEvent');
		}
	});
	</script>
	<style> #msg { color: green; }  </style>

	<h1>標題在這</h1>
	<h2>X:<span id="x"></span></h2>
	<h2>Y:<span id="y"></span></h2>
	<h2>Z:<span id="z"></span></h2>
	<h2>總加速度:<span id="acc"></span></h2>
	<h2><span id="msg">請揮棒!</span></h2>

@stop