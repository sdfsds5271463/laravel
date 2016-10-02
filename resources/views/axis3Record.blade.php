@extends('frame')
@section('main')

	<script src="public/js/Services/axis3Record.js"></script>

	<h1>三軸加速度線上監控</h1>
	<h3><span id="msg"></span></h3>
	<p>此頁面可以即時監控並記錄目前裝置的「三軸加速度感測器」資訊，並產生.json監控資料檔 (不支援無三軸加速度感測器之裝置，如一般桌機)。</p>
	<button id="accToJson" class="normalButton">產生本次紀錄.json</button>
	<a id="downloadAccJson" href="#" target="_blank" class="normalButton" style="color:#999999">下載本次記錄.json</a>
	<button id="reAccRecord" class="normalButton">重新開始三軸記錄</button>
	<h3>X:<span id="x"></span></h3>
	<h3>Y:<span id="y"></span></h3>
	<h3>Z:<span id="z"></span></h3>
	<h3>rss:<span id="rss"></span></h3>
	圖表顯示扣除地心引力g之rss(方和根值)：
	<div style="position:relative">
		<canvas id="accDraw"></canvas>
		<canvas id="accDrawWord"></canvas>
	</div>
@stop