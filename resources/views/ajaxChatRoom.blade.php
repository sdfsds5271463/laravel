@extends('frame')
@section('main')
<script src="public/js/Services/ajaxChatRoom.js"></script>

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
	<div class='col-lg-4 chatInputRow'>暱稱：
		<input type="text" id="speaker" maxlength="20" placeholder="輸入暱稱開始聊天" value= @if(isset($_COOKIE['cookie_speaker']))
																							{{ $_COOKIE['cookie_speaker']}} @endif >
		<input type="color"	id="chatColor" value=@if(isset($_COOKIE['cookie_chatColor'])){{ $_COOKIE['cookie_chatColor']}} 
											     @else "#666666" @endif >


		</div>
	<div class='col-lg-8 chatInputRow'>內容：
		<input type="text" id="chatContent" maxlength="60" >
		<input type="button" id="chatSubmit" value="送出"></div>
<p>
</p>
@stop