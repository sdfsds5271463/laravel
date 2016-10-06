@extends('frame')

@section('hat')


	<!--滑動表頭效果-->
	<div id="hat" style="height:5000px; overflow:hidden; position:relative;"
		data-4000="opacity:1;"
		data-5000="opacity:0;"
	>
		<div id="hatContainer">
			<!--讀取中-->
			<div id="loadingBg" style=" position:fixed; width:100%; height:100%; z-index: 120; background:#FFFFFF;">
				<center style="position:relative;top:350px;"><img src='public/images/loading.gif'>網頁讀取中...</center>
			</div>


			<!--快速進入-->
			<div id="directIn" class="blackFontCase" style="position:fixed; z-index: 102; top:5px; right:8px;">
				<a href="#directIn">直接進入本站</a>
			</div>

			<!--首頁美工感謝-->
			<div class="blackFontCase" style="position:fixed; z-index: 101; bottom:5px; left:8px;">
				本頁美術圖為BABARA友情繪製提供
			</div>

			<!--方格效果-->
			<div id="bgLattice" style="height: 100%; width:100%; position:absolute; z-index: 100; border-bottom:dashed 2px;
			background-color:none; background-image:url(public/images/hat/lattice.png);"></div>
				<!--進度條-->
				<div style="height:20px;position:fixed;top:0px; z-index: 99; border-bottom:solid 1px;" 
					data-0    ="background-color:rgb(255,255,255); width:0%;" 
					data-5000 ="background-color:rgb(0,70,100); width:100%;" 
				></div>


				<!--背景區-->
				<div id="bg" style=" position:fixed; width:100%; z-index: 97;
				background-image:url(public/images/hat/3.jpg);">

					<!--內容，zindex界於 70~30之間-->
					<style>
						.slideContentDiv{
							position:fixed; width:100%; text-align: center; opacity:0; top:-3000px; padding: 0 15px;
						}
					</style>
						<!--歡迎訊息-->
						<div class="slideContentDiv blackFontCase" style="z-index:70; top:130px; font-size:50px; color:#FFFFFF; opacity:1;"
							data-0="top:130px;"
							data-1000="top:-1000px;"
						>
							<span style="font-size:25px;">歡迎來到</span><br>粉碎領域<br><br>
							<span style="font-size:25px;">請往下滾動</span><br>
							<span class="glyphicon glyphicon-arrow-down" style="font-size:100px;"></span>
						</div>
						<!--本站是個人的網頁學習空間-->
						<div class="slideContentDiv blackFontCase" style="z-index:69; font-size:20px; color:#FFFFFF;"
							data-100="top:2000px; opacity:1;"
							data-600="top:200px; opacity:1;"
							data-800="top:200px; opacity:1;"
							data-1800="top:-200px; opacity:1;"
							data-3000="top:-1000px; opacity:0;"
						>
							本站是個人的網頁學習空間，提供資源與大家交流分享<br>主要內容有：<br>
							<!--DHTML LOGO-->
							<center style="z-index:68;">
								<span style=" position:relative; text-align:center;"
									data-600 = "opacity:0; top:100px; left:-50px;"
									data-800 = "opacity:1; top:0px; left:0px;"
									data-1200 = "opacity:1; top:120px; left:0px"
									data-1400 = "opacity:1; top:0px; left:0px"
								><img src="public/images/hat/htmlLogo.png" style="margin:0px 50px -200px;"></span>
								<span style=" position:relative; text-align:center;"
									data-1000 = "opacity:0; top:220px;"
									data-1200 = "opacity:1; top:120px;"
									data-1600 = "opacity:1; top:240px;"
									data-1800 = "opacity:1; top:120px;"
								><img src="public/images/hat/cssLogo.png" style="margin:0px 50px -200px;"></span>
								<span style=" position:relative; text-align:center;"
									data-1400 = "opacity:0; top:340px; right:-50px;"
									data-1600 = "opacity:1; top:240px; right:0px;"
									data-2000 = "opacity:1; top:360px; right:0px;"
									data-2200 = "opacity:1; top:240px; right:0px;"
								><img src="public/images/hat/jsLogo.png" style="margin:0px 50px -200px;"></span>
							</center>
						</div>
						<!--DHTML敘述-->
						<div class="slideContentDiv blackFontCase" style="z-index:67; font-size:20px; color:#FFFFFF;"
							data-800="top:580px; opacity:0;"
							data-1000="top:580px; opacity:1;"
							data-1400="top:580px; opacity:1;"
							data-4000="top:-500px; opacity:1;"
						>DHTML的基本要素<br><br>
							<span
								data-0="opacity:0;"
								data-1200="opacity:0;"
								data-1400="opacity:1;"
								data-4000="opacity:1;"
							>包含了相關的函式庫與框架等資源的應用<br>例如您現在流覽的這個頁面就是使用javaScript函式庫skrollr所建置
							</span>
						</div>

						<!--PHP LOGO-->
						<div class="slideContentDiv blackFontCase" style="z-index:67; font-size:20px; color:#FFFFFF;"
							data-2400="top:200px; opacity:0;"
							data-2800="top:200px; opacity:1;"
							data-3800="top:200px; opacity:1;"
							data-6000="top:-500px; opacity:1;"
						>
							<img src="public/images/hat/phpLogo.png"
								data-2400="transform:  scale(5);"
								data-2800="transform:  scale(1);"
							><br><br>
							<span
								data-0="opacity:0;"
								data-2900="opacity:0;"
								data-3100="opacity:1;"
							>主角是後端網頁程式語言PHP<br>包含資料庫使用、框架應用等內容，例如本站就是使用Laravel框架所建置
							<br>其他內容關鍵字如：MySqli、jQuery、AJAX、Bootstrap、Box2D、PDO、XAJAX</span><br><br>
							<span
								data-0="opacity:0;"
								data-3700="opacity:0;"
								data-3900="opacity:1;"
							>進站中...<br><span class="glyphicon glyphicon-arrow-down" style="font-size:50px;"></span></span>
						</div>




					<!--圖片 背景-->
					<img id="bg3img" src="public/images/hat/3.jpg" style="position:absolute; z-index: 26">
					<img id="bg2img" src="public/images/hat/2.png" style="position:absolute; z-index: 27">
					<!--圖片 前景建築-->
					<img id="bg1gimg" src="public/images/hat/15g.png" style="position:absolute; z-index: 28">
					<img id="bg1rimg" src="public/images/hat/11r.png" style="position:absolute; z-index: 29">
					<img id="bg1limg" src="public/images/hat/10l.png" style="position:absolute; z-index: 30">
					<!--圖片 塵土與樹木-->
					<img id="bg0img" src="public/images/hat/0.png" style="position:absolute; z-index: 77">
					<img id="bg1slimg" src="public/images/hat/13sl.png" style="position:absolute; z-index: 78">
					<img id="bg1srimg" src="public/images/hat/12sr.png" style="position:absolute; z-index: 79">
					<img id="bg02img" src="public/images/hat/0.png" style="position:absolute; z-index: 80">
				</div>
		</div>
	</div>
	
	<script src="public/js/library/skrollr.min.js"></script>
	<script src="public/js/Services/indexHatAndPuzzle.js"></script>


@stop


@section('main')
	<h1><b>粉碎領域</b> <span class="smallWord">PHP程式學習空間</span></h1>
	<p>小弟只是興趣使然的PHP一般使用者，正好最近在整理學習過的文件，就索性將學習過的一些技術做一些簡單的呈現，也順便把自己的學習紀錄做一些整理。
	文件資料是學習時隨手紀錄的，或是憑個人印象與概念百分百一字一字輸入而成的，因此難免有疏忽或是錯誤，請不吝提出指教謝謝。</p>
	<p>本網頁為AMP系統，使用Laravel 5.1.33(PHP Framework)建置，RWD的效果是透過BootStrap(Css&javaScript Framework)進行呈現，
	XML使用YQL代理伺服的服務進行跨域，AJAX資源運用jQuery(javaScript library)發送POST請求，模組使用Eloquent ORM與資料庫進行連線。</p>
	<p>下面是簡單的jQuery拖曳droppable功能拼圖。</p>
	<div id="puzzleDiv">
		<div id="whiteFog"></div>
		<img id="puzzBg" class="img-responsive">
	</div>
	<center>
		<input id="puzSetX" class="normalImg" type="text" size="1" maxlength="2" value="5">x
		<input id="puzSetY" class="normalImg" type="text" size="1" maxlength="2" value="5">拼圖矩陣
		<button id="puzSetButton" class="normalButton">重新產生</button>
		<button id="autoPuz" class="normalButton">自動拼圖</button>
	</center>
	<br>
	<p>最後要感謝強者我朋友提供專業美術圖繪製，讓我的網頁跟我本人都生動活潑了起來，
	<a href="http://www.pixiv.net/member.php?id=4041740" target="_blank">這是他的P網</a>，歡迎大家上去看看。</p>
@stop