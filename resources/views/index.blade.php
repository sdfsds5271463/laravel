@extends('frame')
@section('main')

	<script src="public/js/Services/indexPuzzle.js"></script>
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