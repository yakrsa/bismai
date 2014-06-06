 										KindEditor.ready(function (K) {
											var editor = K.editor({
												themeType: "simple",
												allowFileManager: true

											});
											var _mp3_i = 0;
											K('button.select_img').click(function (e) {
												editor.loadPlugin('smimage', function () {
													editor.plugin.imageDialog({
														imageUrl: $(e.target).parent().prevAll("input[type=text]").val(),
														clickFn: function (url, title, width, height, border, align) {
															var $input = $(e.target).parent().prevAll("input[type=text]")
															$input.val(url)
															$input.hide();
															var t_img = $(e.target).parent().prevAll(".thumb_img:first");
															if (t_img.length == 0) {
																var tmp = '<img class="thumb_img" src="{0}" style="max-height: 100px;">';
																$input.before(tmp.format(url))
															} else {
																t_img.attr("src", url);
															}

															editor.hideDialog();
														}
													});
												});
											});
											K('button.addmp3').click(function (e) {
												editor.loadPlugin('mp3', function () {
													editor.plugin.imageDialog({
														mp3Url: $(e.target).parent().prevAll("input[type=text]").val(),
														clickFn: function (url, title, width, height, border, align) {
															_mp3_i++;
															var $input = $(e.target).parent().prevAll("input[type=hidden]")
															var $mp3 = $(e.target).parent().prevAll("div.mp3");
															var $flag = $mp3.find("a.audio");
															var $filename = url.match(/[^\/]*$/)[0];
															if ($filename.lastIndexOf('.') > -1) {
																$filename = $filename.substring(0, $filename.lastIndexOf('.'))
															}
															$input.val(url)
															if ($flag.length > 0) {
																$flag.mb_miniPlayer_changeFile({ mp3: url }, $filename);
																$flag.mb_miniPlayer_play();
															}
															else {
																while ($("#m" + _mp3_i).length > 0) {
																	_mp3_i++;
																}
																var _tmp = '<a id="m{1}" class="audio {skin:\'blue\'}" href="{0}">{2}</a> ';
																$mp3.html(_tmp.format(url, _mp3_i, $filename));
																$mp3.find("a.audio").mb_miniPlayer();
																var $id = $mp3.find("a.audio").attr("id");
																setTimeout(function () {
																	$("#" + $id).mb_miniPlayer_play();
																},1000);
															}
															editor.hideDialog();
															$(e.target).text("重新选择");
														}
													});
												});
											});
											$("#select_bg").change(function () {
												var v = $(this).val();
												if (v.length > 0) {
													$("img.gwbg").attr("src", v)
													$("#bg_img").val(v);
												}
											})
										});

 