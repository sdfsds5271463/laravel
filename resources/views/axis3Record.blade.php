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

					// x,y,z 平方相加後開根號
					acc = Math.sqrt(x*x+y*y+z*z);
					$('#acc').text(acc.toFixed(2));

					
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