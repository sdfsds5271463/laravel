@extends('frame')
@section('main')


    <script src="public/js/Services/weather.js"></script>
    <script src="public/js/library/googleMapsApi.js"></script>

    <h1>XML天氣概況</h1>
    	<p>此頁面為使用yql代理伺服器跨域，存取<a href="http://opendata.cwb.gov.tw/">中央氣象局資料開放平台</a>之一周天氣XML，透過Javascript將天氣資訊崁入GoogmeMap，並設計與地圖的額外互動行為，點擊地圖中的天氣符號可以查看一周天氣。</p>
    	<div id="weatherXmlTitle"></div>
    	<div id="mapDiv"></div>
        <div id="allWeathersDiv"></div>
        <center>點擊地圖中的天氣符號，可以查看一周天氣。</center>
@stop