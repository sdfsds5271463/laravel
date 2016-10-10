//參數們
	//物件定義
	var whiteFog;	//主要底色物件
	var canvas; //DEMO CANVAS

	//寬度參數
	var puzBigW = -1;
	var puzBigH = -1;
	var puzSmW;
	var puzSmH;

	//設定參數
	var round = 15; //自動吸引填滿寬度
	var puzXSlice = 5; //切塊
	var puzYSlice = 5;
	var zIndex; //拿起至頂
	var bgUrl = "public/images/index_img.jpg"; //圖片選擇





	window.onload = function(){
		//物件定義
		whiteFog = document.getElementById('whiteFog');
		var puzzBg = document.getElementById('puzzBg');
		puzzBg.src = bgUrl;
		canvas = document.getElementById("slideCanvas");
			// 確認canvas元素是否存在
			if (!canvas || !canvas.getContext) {
				alert("偵測不到canvas物件");
				return false;
			}

		window.onresize = function(){

		//**此區為滑動背景效果
			//滑動背景
			var bg3Slide = 0.1; //最底層背景最低滑動率
			var slideAllH = $('#hat').height(); //整體滑動高
			var slideH = (slideAllH); //背景滑動高依據

			//初始化body的高度
			$('body').height("");
			var bodyActH = $('body').height();
			$('body').height(bodyActH);

			//圖片之Div物件
			var bg = document.getElementById('bg');
			bg.style.height = $(window).height() + "px";

			//圖片放大倍率計算
			var hX = $(window).height()/ ($('#bg3img').height()*(1-bg3Slide));
			var wX = $(window).width()/ $('#bg3img').width();
			var zoomX = Math.max(hX,wX);

			//各圖片物件放置
				//背景層
				var bg3img = document.getElementById('bg3img');
				fullBgSlide(bg3img,"left",1);
				var bg2img = document.getElementById('bg2img');
				fullBgSlide(bg2img,"left",1);
				//前端建築
				var bg1rimg = document.getElementById('bg1rimg');
				fullBgSlide(bg1rimg,"right",1);
				var bg1limg = document.getElementById('bg1limg');
				fullBgSlide(bg1limg,"left",1);
				var bg1gimg = document.getElementById('bg1gimg');
				fullBgSlide(bg1gimg,"bottom",1);
				//前端樹木
				var bg1slimg = document.getElementById('bg1slimg');
				fullBgSlide(bg1slimg,"left",-7);
				var bg1srimg = document.getElementById('bg1srimg');
				fullBgSlide(bg1srimg,"right",-1);
				//塵土飛揚
				var bg0img = document.getElementById('bg0img');
				fullBgSlide(bg0img,"left",-0.5);
				var bg02img = document.getElementById('bg02img');
				fullBgSlide(bg02img,"right",-4);

			//圖面物件放置函數
			function fullBgSlide(Obj,align,slideX){
				//圖片調整大小
				var setH = $(Obj).height()*zoomX;
				var setW = $(Obj).width()*zoomX;
				Obj.style.height = setH + "px";
				Obj.style.width = setW + "px";
				//圖片置中
				if($(Obj).width() > $(window).width()){
					var overflowX = $(window).width() - $(Obj).width();
					Obj.style.left = (overflowX/2) + "px";
				}
				//實際滑行高度
				var actBgSlide = $(Obj).height() - $(window).height();
				var slideOrg = actBgSlide;
				actBgSlide = (slideX*actBgSlide);
				//重設data參數
				for (key in Obj.dataset){
					$(Obj).removeAttr('data-'+key);
				}
				//位置調整
				if((align=="right")&&($(Obj).width()<$(window).width())){
					Obj.style.left = $(window).width()-$(Obj).width() + "px";
				}
				if (align == 'bottom'){
					$(Obj).attr("data-0","bottom:"+(actBgSlide)+"px;");
					$(Obj).attr("data-"+(slideH-$(window).height()),"bottom:"+(-slideOrg+actBgSlide)+"px;");
				}
				else{
					$(Obj).attr("data-0","top:"+(-slideOrg+actBgSlide)+"px;");
					$(Obj).attr("data-"+(slideH-$(window).height()),"top:"+(-actBgSlide)+"px;");
				}
			}

			//初始化捲軸
			skrollr.init();
			$('body').css("overflow","");

			//直接進入
			$("#directIn")[0].onclick = function(){
				directInTimer();
				function directInTimer(){ //設置自動滑行時間
					if(($('body')[0].scrollTop) < slideAllH){
						setTimeout(function(){
							$('body')[0].scrollTop += ((slideAllH-$('body')[0].scrollTop)/8)+5;
							directInTimer();
						},10);
					}
					else{
						$('body')[0].scrollTop = slideAllH;
					}
				}
			};
			

			//捲動事件
			window.onscroll = function(){
				//進入網站後自動隱藏滑動效果
				if (parseFloat($('body')[0].scrollTop) >= slideAllH){
					$('#hat').css("display","none");
					$('body').height("");
					$('body')[0].scrollTop = 0;
					//防彈跳用時間
					var inWebTimer = setInterval(function(){
						if (parseFloat($('body')[0].scrollTop) >= 800){
							$('body')[0].scrollTop = 0;
						}
					},10);
					setTimeout(function(){
						clearInterval(inWebTimer);
					},200); //200毫秒防時間
				}
				//進入網站後將資源功能停用
				/*if (parseFloat($('body')[0].scrollTop) >= $('#hat').height()){
					$('#hatContainer').css("display","none");
				}
				else{
					$('#hatContainer').css("display","");
				}*/
				//console.log($('body')[0].scrollTop);
			}

		//**此區為拼圖功能
			if($(whiteFog).width() != puzBigW){
				if($(whiteFog).width() >0){
					//重置設定
					whiteFog.innerHTML = "";
					puzBigW = $(whiteFog).width();
					puzBigH = $(whiteFog).height();
					puzSmW = puzBigW/puzXSlice;
					puzSmH = puzBigW/puzYSlice;

					//亂數陣列
					var rndArrX = randNumArray(puzXSlice);
					var rndArrY = randNumArray(puzYSlice);

					//拼圖產生
					var puzId = 0;
					for(var i=0;i<puzYSlice;i++){
						for(var n=0;n<puzXSlice;n++){

							//塊內圖片
							var smImg = $("<img>");
							smImg.attr('src',bgUrl);
							smImg.css("width",puzBigW+"px"); //寬度與位置
							smImg.css("height",puzBigH+"px");
							smImg.css("position","absolute");
							smImg.css("left",n*-puzSmW);
							smImg.css("top",i*-puzSmH);
							smImg.css("top",i*-puzSmH);
							smImg.css('cursor','pointer'); //手指游標

							//塊外Div
							var smallPuz = $("<div></div>");
							smallPuz.attr("id","sm"+puzId); //設定id
							smallPuz.css("width",puzSmW+"px"); //寬度與位置
							smallPuz.css("height",puzSmH+"px");
							smallPuz.css("position","absolute");
							smallPuz.css("overflow","hidden");
							smallPuz.css("top",rndArrY[i]*puzSmH + "px");
							smallPuz.css("left",rndArrX[n]*puzSmW + "px");
							smallPuz.css("zIndex",puzId); //垂直順序
							smallPuz.css("border","solid 1px");

							//生成
							smallPuz.addClass("puzz"); //Div加入拼圖
							smallPuz.append(smImg); //圖片加入Div
							$(whiteFog).append(smallPuz); //Div註冊

							//事件註冊
							$("#sm"+puzId).mousedown(function(e){ //拿起時垂直順序置頂
								e.target.parentElement.style.zIndex = zIndex++;
							});
							$("#sm"+puzId).mouseup(function(e){ //放下時自動吸引
								var pTop = parseFloat(e.target.parentElement.style.top);
								var pLef = parseFloat(e.target.parentElement.style.left);
								for(var r=0;r<puzYSlice;r++){
									for(var k=0;k<puzXSlice;k++){
										if (
										(pTop>(r*puzSmH-round))&&(pTop<(r*puzSmH+round))&&
										(pLef>(k*puzSmW-round))&&(pLef<(k*puzSmW+round))
										){
											e.target.parentElement.style.top = r*puzSmH + "px";
											e.target.parentElement.style.left = k*puzSmW + "px";
										}
									}
								}
							});
							puzId++;
						} //for n
					} //for i
					zIndex = puzId;

			        //將元素指派為可拖曳
			        $('.puzz').draggable({
			            //helper: 'clone',     
			            opacity: 0.5,
			            revert: 'invalid',
			            revertDuration: 200
			        });

			        //將元素指派為拖曳目標
			        $('body').droppable({
			            activeClass: 'active',  //拖行時新類別
			            drop: function(event, ui) {
			            }
			        });
				} //if $(whiteFog).width() >0
				else{
					setTimeout(window.onresize,500); //重新載入
				}
			}//if $(whiteFog).width() != puzBigW 


			//**canvas 適應大小
			canvas.width = Math.min((innerWidth-60),600);
			canvas.height = innerHeight/2;

		}
		window.onresize();


		//**此區為canvas DEMO效果
			//動畫設定區 (變數、定義、on事件、迴圈)
				// 變數
				var ctx;				// 2D context
				var particleList = [];	// 放入建立好的顆粒的陣列
				var mx = null;			// 滑鼠的X座標
				var my = null;			// 滑鼠的Y座標
				var canvas;				// 畫布

			//原型鏈物件
				//創造定義 (初始參數)
				var Particle = function () {
					this.x = mx;
					this.y = my; //位置
					this.r = 25; 
					this.vx = Math.random() * 12 - 6;
					this.vy = Math.random() * (-12) - 6; //位移
				};
				//屬性方法 (位移刪除、繪製)
				Particle.prototype = {
					update: function () {
						this.vy += 0.4;
						this.x += this.vx;
						this.y += this.vy; //位置位移
						this.x = Math.round(this.x);
						this.y = Math.round(this.y);
						this.r -= 0.1; 
						if(
						(this.y<this.r && this.vy<0)||
						(this.y>canvas.height-this.r && this.vy>0)
						){
							this.vy *= -1;
						}
						if(
						(this.x<this.r && this.vx<0)|| 
						(this.x>canvas.width-this.r && this.vx>0) 
						){
							this.vx *= -1;
						}
						if(this.r<2){
							this.isRemove = true;
						}
					},
					draw: function () {
						ctx.beginPath();
						ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2, false);
						ctx.fillStyle = "#FFFFFF";
						ctx.fill(); //畫出圖形
					}
				};

			//迴圈陣列繪製物件
				var stateParticle = function () {
					ctx.fillStyle = "#000000";
					ctx.fillRect(0, 0, innerWidth, innerHeight); //先畫背景蓋過全部

					for (key in particleList) {
						particleList[key].update();
						particleList[key].draw();
						if (particleList[key].isRemove) {
							delete particleList[key];
						} //更新 繪製 刪除
					}
				};

			//事件迴圈區
				//事件創造物件存入陣列
				function addPoint(event){
					mx = event.offsetX;
					my = event.offsetY;
					var p = new Particle();
					particleList.push(p);
				}
				//呼叫繪製迴圈
				var loop = function () {
					stateParticle();
					requestAnimationFrame(loop);
				};

			//物件事件
				var ctx = canvas.getContext("2d"); //重要：定義canvas的2d繪製物件
			    canvas.onclick = addPoint;
				loop();



		//滑動動畫讀取完成
		$("#loadingBg").text("讀取完成");
		$("#loadingBg").fadeOut(500);
		setTimeout(function(){
			$("#loadingBg")[0].style.display = "none";
		},500);


		//重新產生矩陣
		$("#puzSetButton")[0].onclick = function(){
			//取得矩陣參數
			var puzSetX = parseInt($("#puzSetX").val());
			var puzSetY = parseInt($("#puzSetY").val());
			if(puzSetX.toString()=="NaN" || puzSetX<1){
				puzSetX = 1;
			}
			if(puzSetY.toString()=="NaN" || puzSetY<1){
				puzSetY = 1;
			}
			if(puzSetX >20){puzSetX = 20;}
			if(puzSetY >20){puzSetY = 20;}
			//設定
			puzXSlice = puzSetX; 
			puzYSlice = puzSetY;
			$("#puzSetX").val(puzSetX);
			$("#puzSetY").val(puzSetY);

			puzBigW = -1;
			window.onresize();
		}

		//自動拼圖
		$("#autoPuz")[0].onclick = function(){
			var autoPutId = 0;
			for(var r=0;r<puzYSlice;r++){
				for(var k=0;k<puzXSlice;k++){
					var putPuzz = document.getElementById("sm" + autoPutId);
					$(putPuzz).animate({'top':r*puzSmH,'left':k*puzSmW},1000);
					autoPutId++;
				}
			}
		}


	};

	//隨機排序數字陣列
	function randNumArray(len){
		var arr = [];
		for (var i=0;i<len;i++){
			arr.push(i);
		}
		for (var i=0;i<len;i++){
			var rand1 = Math.random()*(len-1);
			rand1 = Math.round(rand1);
			var rand2 = Math.random()*(len-1);
			rand2 = Math.round(rand2);

			if (rand1 != rand2){
				var tmp;
				tmp = arr[rand1];
				arr[rand1] = arr[rand2];
				arr[rand2] = tmp;
			}
		}
		return arr;
	}









