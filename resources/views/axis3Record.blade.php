@extends('frame')
@section('main')

	<script src="public/js/Services/axis3Record.js"></script>

	<h1>標題在這</h1>
	<h3><span id="msg"></span></h3>
	<button id="accToXml" class="normalButton">下載本次紀錄.json</button>
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