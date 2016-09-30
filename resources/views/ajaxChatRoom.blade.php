@extends('frame')
@section('main')
<script src="public/js/Services/ajaxChatRoom.js"></script>
<script src="public/js/Services/ajaxChatPaint.js"></script>

<h1>AJAX塗鴉聊天室</h1>
	<div id="onlineSpeakerBoard">
		<div id="SpeakerAmountBoard">
			<a href="#hideShow"><span id="AmountBoardHideWord">隱藏</span>在線人員</a>
			<span class="smallWord">[線上 <span id="SpeakerAmountBoardSpan">0</span> ]</span>
		</div>
		<div id="SpeakerUsersBoard">
		</div>
	</div>

	<div id="chatStateBar"></div>
	<input type="hidden"  id="chatStateTime" value="0"><input type="hidden" id="stateDate" value="0">
	<div class='col-sm-4 chatInputRow'>暱稱：
		<input type="text" id="speaker" maxlength="20" placeholder="輸入暱稱開始聊天" value= @if(isset($_COOKIE['cookie_speaker']))
																							{{ $_COOKIE['cookie_speaker']}} @endif >
		<input type="color"	id="chatColor" value=@if(isset($_COOKIE['cookie_chatColor'])){{ $_COOKIE['cookie_chatColor']}} 
											     @else "#666666" @endif >
		</div>
	<div class='col-sm-8 chatInputRow'>內容：
		<input type="text" id="chatContent" maxlength="60" >
		<input type="button" id="chatSubmit" value="送出" class="normalButton"></div>

	<div class='col-sm-12'>
		<div id="drawArea">
			<div id="showPencelDiv"><canvas id="showPencel"></canvas></div>
			<canvas id="drawCanvas">
				<div id="nocanvas">請以支援Canvas的瀏覽器瀏覽。</div>
			</canvas>
			<canvas id="compressCanvas" style="display:none"></canvas>
		</div>
		<div id="paintTools">
			<center>工具</center>
			<div class="toolBlock" data-tool="pencel"><span class="glyphicon glyphicon-pencil"></span></div>
			<div class="toolBlock" data-tool="eraser"><span class="glyphicon glyphicon-erase"></span></div>
			<center>大小</center>
			<div class="toolBlock" data-tool="sizeUp"><span class="glyphicon glyphicon-chevron-up"></span></div>
			<div class="toolBlock" data-tool="sizeDown"><span class="glyphicon glyphicon-chevron-down"></span></div>
			<center>透明</center>
			<div class="toolBlock" data-tool="alphaUp"><span class="glyphicon glyphicon-chevron-up"></span></div>
			<div class="toolBlock" data-tool="alphaDown"><span class="glyphicon glyphicon-chevron-down"></span></div>
			<center id="colorToolsTitle">顏色</center>
			<div class="toolBlock" data-tool="#000000"></div>
			<div class="toolBlock" data-tool="#FFFFFF"></div>
			<div class="toolBlock" data-tool="#FF0000"></div>
			<div class="toolBlock" data-tool="#FF5809"></div>
			<div class="toolBlock" data-tool="#F9F900"></div>
			<div class="toolBlock" data-tool="#28FF28"></div>
			<div class="toolBlock" data-tool="#00FFFF"></div>
			<div class="toolBlock" data-tool="#6A6AFF"></div>
			<div class="toolBlock" data-tool="#9F35FF"></div>
			<div class="toolBlock" data-tool="#8E8E8E"></div>
			<button id="postPaintButton" class="normalButton">送出繪圖</button>
		</div>
		<div id="paintAdvanceFunc">
		進階功能：	<a href="#func" data-func="clearAll">[全頻清除 ctrl+del]</a>
					<a href="#func" data-func="selectColor">[自訂顏色 ctrl+q]</a>
					<a href="#func" data-func="restore">[復原 ctrl+z]</a>
					<a href="#func" data-func="rrestore">[取消複原 ctrl+y]</a>
					<a href="#func" data-func="cut">[剪下 ctrl+x]</a>
					<a href="#func" data-func="copy">[複製 ctrl+c]</a>
					<a href="#func" data-func="paste">[貼上 ctrl+v]</a><br>
		快捷鍵：工具切換[tab]、筆刷大小[1(大)2(小)]、透明度[3(高)4(低)]
					<input type="color" id="selectPaintColor" style="visibility:hidden; width=5px;">
		</div>
	</div>
<p>
</p>
@stop