<html>
<head>
	<meta charset="utf-8" />
	<script language="javascript" src="./TTSTOOL/TTSscript.js"></script>
	<script language="javascript" src="./lib/knockout-2.2.1.js"></script>
	<script type="text/javascript" src="./lib/jquery-1.10.1.js"></script>
	<script>
		var setting = {
			number_length: 8,
		}
		function getSingleRandomNum() {
			return Math.floor(Math.random()*10);
		}
		function getLimitRandomNum(length) {
			return $.map(new Array(length), function(){return getSingleRandomNum();}).join('');
		}
		function ttsReset() {
			TTS.ConverterIndex="./TTSTOOL/";
			TTS.ConvertInit("content","media","","","","","","");
			//StringOrObj, mediaID, Speaker, Volume, Speed, PitchLevel, PitchSign, PitchScale可空白(即使用預設值)
			//There is a lot of options can be set, please see the api to use.
		}
		function GameViewModel() {
			var self = this;
			self.num = ko.observable(getLimitRandomNum(setting.number_length));
			self.answer_num = ko.observable();
			self.reset = function () {
				$("#media").children().remove();
				self.answer_num('');
				self.num(getLimitRandomNum(setting.number_length));
				ttsReset();
			}
			self.give_answer = function () {
				if ( self.num() == self.answer_num() ) {
					alert('恭喜過關');
					self.reset();
				}else {
					alert('可惜，錯了喔＝＝');
					self.answer_num('');
				}
			}
		}
	</script>
	<style>
		span#random_num
		{
			display: none;
		}
	</style>
</head>
<body>
	<!-- <div class="header"><input type="button" data-bind="click: reset" value="開始"></div> -->
	<div id="content">
        <span id="random_num" data-bind="text: num"></span>
	</div>
	<div id="media"></div>
	<div class="footer">
		<input type="text" data-bind="value: answer_num" placeholder="請輸入聽到的數字">
		<input type="button" data-bind="click: give_answer" value="作答">
	</div>
	<script>
		GameVM = new GameViewModel();
		ko.applyBindings(GameVM);
		ttsReset();
	</script>
</body>
</html>