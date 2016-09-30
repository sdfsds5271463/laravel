@extends('frame')
@section('main')
	<script src="public/js/Services/axis3Video.js"></script>

	<h1>三軸步態實驗 <span class="smallWord">Html5影片播放器</span></h1>
	<p>此影片播放器與內容，是我研究生時代設計的，目地是能夠精準對應「步態三軸訊號」與影片人體動作的關係，透過一個簡單的Html5影片播放器進行呈現。
	影片播放器設計上，僅是透過Javascript取得並修改video元素的屬性達成功能，不過成效相當好，精準的影片對應動作讓我能夠定義人體步態的三軸特徵。</p>

    <video id="Video1" class="img-responsive" width="100%" loop autoplay>您的瀏覽器不支援Html5影片播放器。</video>

    <center>
		<button id="repeat"   class="videoBuootn normalButton"><span class="glyphicon glyphicon-repeat"></span></button>
	    <button id="play"	  class="videoBuootn normalButton"><span class="glyphicon glyphicon-pause"></span></button>
	    <button id="mute"	  class="videoBuootn normalButton"><span class="glyphicon glyphicon-volume-off"></span></button>
		<button id="backward" class="videoBuootn normalButton"><span class="glyphicon glyphicon-triangle-left"></span>-10ms</button>
	    <button id="foward"   class="videoBuootn normalButton">+10ms<span class="glyphicon glyphicon-triangle-right"></span></button>
	    <label>SpeedSet:+<input id="videoSpeed" type="range">-</label>
	</center>

	<div style="position:relative;" ondragstart="return false"; onselectstart="return false";>
		<div id="videoLine" style="display:none;"></div>
		<img id="videoImg" src="public/files/i1.png" class="img-responsive" width="100%">
	</div>
	<center id="videoInfo"></center>
@stop