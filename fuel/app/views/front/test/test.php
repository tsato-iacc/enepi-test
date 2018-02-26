<style>
div.main{
	margin: 5% 2%;
}
</style>


<div class="main">

メール送信テスト<br>
宛先：<input type="text" value="dfukushi@iacc.co.jp" placeholder="test@test" id="to_addr">
<input type="button" value="メール送信" onclick="go_mail()">

<br><br>


SMS送信テスト<br>
電話番号：<input type="text" value="09073264349" placeholder="08012345678" id="sms_num">
<input type="button" value="SMS送信" onclick="go_sms()">

<br><br>


音声送信テスト<br>
電話番号：<input type="text" value="09073264349" placeholder="08012345678" id="sms_num2">
<input type="button" value="音声送信" onclick="go_talk()">

<br><br>




</div>

<script>
function go_mail(){

	document.body.style.cursor = 'wait';

	to = $("#to_addr")[0].value;
	if(!to){
		alert("アドレス入力してください");
		return;
	}


	$.ajax({
		  url: 'test',
		  type: 'POST',
		  cache: false,
		  dataType: 'html',
		  data: {
			  "cmd" : "mail",
			  "to" : to
			 }
		})
		.done(function(data, textStatus, jqXHR){

			alert("送信完了");

		})
		.fail(function(jqXHR, textStatus, errorThrown){

			alert("失敗...");

		})
		.always(function(data, textStatus, jqXHR){
			document.body.style.cursor = 'auto';
		});

}

function go_sms(){


	document.body.style.cursor = 'wait';

	to = $("#sms_num")[0].value;
	if(!to){
		alert("電話番号を入力してください");
		return;
	}


	$.ajax({
		  url: 'test',
		  type: 'POST',
		  cache: false,
		  dataType: 'html',
		  data: {
			  "cmd" : "twilio",
			  "to" : to
			 }
		})
		.done(function(data, textStatus, jqXHR){

			alert("SMS送信完了");

		})
		.fail(function(jqXHR, textStatus, errorThrown){

			alert("失敗...");

		})
		.always(function(data, textStatus, jqXHR){
			document.body.style.cursor = 'auto';
		});

}



function go_talk(){


	document.body.style.cursor = 'wait';

	to = $("#sms_num2")[0].value;
	if(!to){
		alert("電話番号を入力してください");
		return;
	}


	$.ajax({
		  url: 'test',
		  type: 'POST',
		  cache: false,
		  dataType: 'html',
		  data: {
			  "cmd" : "talk",
			  "to" : to
			 }
		})
		.done(function(data, textStatus, jqXHR){

			alert("音声送信完了");

		})
		.fail(function(jqXHR, textStatus, errorThrown){

			alert("失敗...");

		})
		.always(function(data, textStatus, jqXHR){
			document.body.style.cursor = 'auto';
		});

}


</script>