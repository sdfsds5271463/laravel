	var accDrawWidth;

	var preBlockTime;

	var saveX=[];
	var saveY=[];
	var saveZ=[];
	var saveRss=[];
	var saveMaxAmount = 10;

	$(function(){
		var canvas = document.getElementById("accDraw");
		var canvasWord = document.getElementById("accDrawWord");
		var ctx = canvas.getContext("2d");
		var ctxWord = canvasWord.getContext("2d");

		var putFont;
		var putTimes;


		$(window).resize(function(){
			if(accDrawWidth != $(".col-sm-9").eq(0).width()){
				accDrawWidth = $(".col-sm-9").eq(0).width();
				canvas.width = canvasWord.width = accDrawWidth;
				canvas.height = canvasWord.height = Math.min(accDrawWidth,300);

				canvas.style.backgroundPositionY = ((accDrawWidth%50)/2+25) + 'px';

				//文字
				ctxWord.clearRect(0,0,999,999);
				ctxWord.textAlign="center"; 
				ctxWord.fillStyle="#666666";
				ctxWord.font="100 20px Arial";
				ctxWord.rotate((Math.PI/2)*3); //操作繪製的角度
				ctxWord.fillText("Acceleration(m/s^2)",-canvas.height/2,20);
				ctxWord.rotate((Math.PI/2)*-3);
				putFont = false;
				putTimes = 0;
			}
		});

		$(window).resize();

		var lastDraw = [];
		var medRatePoint = 5;
		for (var i=0;i<medRatePoint;i++){
			lastDraw.push(accDrawWidth/2);
		}

		//var lastDraw = accDrawWidth/2;

		// 若支援方向事件, 即註冊事件處理函式
		if(window.DeviceMotionEvent){
			window.addEventListener('devicemotion', function(e){

				putTimes++;
				if (!putFont){
					putFont = true;
					setTimeout(function(){
						preBlockTime = (50/putTimes);
						preBlockTime = preBlockTime.toFixed(2);
						ctxWord.fillText("time("+preBlockTime+"s)",canvas.width/2,canvas.height);
					},1000);
				}

			//線條
				ctx.beginPath();
				ctx.lineWidth=1;
				ctx.strokeStyle="black";

				if(e.accelerationIncludingGravity.x == null) {
					$('#msg').text('※目前裝置不支援三軸加速度感測器※');
				}
				else {
					// 將傳入的感測值存到變數中
					x = e.accelerationIncludingGravity.x;
					y = e.accelerationIncludingGravity.y;
					z = e.accelerationIncludingGravity.z;
					rss = (Math.sqrt(x*x+y*y+z*z));
					saveX.push(x);
					saveY.push(y);
					saveZ.push(z);
					saveRss.push(rss);
					if(saveRss.length>saveMaxAmount){
						saveX.shift();
						saveY.shift();
						saveZ.shift();
						saveRss.shift();
					}
					$('#x').text(x.toFixed(2));
					$('#y').text(y.toFixed(2));
					$('#z').text(z.toFixed(2));
					$('#rss').text(rss.toFixed(2));

					rss-=9.8;

					var imgData=ctx.getImageData(0,0,999,999);
					ctx.putImageData(imgData,-1,0);

					ctx.moveTo(accDrawWidth,avgArray(lastDraw));
					lastDraw.pop();
					lastDraw.push(rss*50 + accDrawWidth/2);
					ctx.lineTo(accDrawWidth,avgArray(lastDraw)); //直線繪製
					ctx.stroke();

				} // end of else
			});
		}
		else  {  // 若不支援註冊事件, 則顯示訊息
			$('#msg').text('※目前裝置不支援三軸加速度感測器※');
		}




		$("#accToXml").click(function(){
		    var _token = $("#_token").val();
		    var action = 'accToJsonDownload';
       	 	var onlineUserId = $("#onlineUserId").val(); 

       	 	var preDataMillisecond = preBlockTime/50;
       	 	var accX = saveX;
       	 	var accY = saveY;
       	 	var accZ = saveZ;
       	 	var rss = saveRss;
		    var formData = {"preDataMillisecond":preDataMillisecond,"_token":_token,"action":action,
		    					"accX":accX,"accY":accY,"accZ":accZ,"rss":rss,"onlineUserId":onlineUserId}; //JSON傳輸
	        $.ajax(
	        {
	            type: 'post',
	            url:'',
	            data: formData,
	            success:function(data)
	            {
	            	data = JSON.parse(data);
	                window.open(data.jsonUrl); 
	            },
	            error:function()
	            {
	                console.log("產生accJson失敗");
	            }
	        });
		});

		$("#reAccRecord").click(function(){
			ctx.clearRect(0,0,999,999);
			saveX=[];
			saveY=[];
			saveZ=[];
			saveRss=[];
			console.log(123);
		});

	});

	function avgArray(arr) {
	    var sum = 0;
	    for (var i = 0, j = arr.length; i < j; i++) {
	        sum += arr[i];
	    }
	    return sum / arr.length;
	}
