                                    var editor;
				 
                                    KindEditor.ready(function (K) {
                                        editor = K.editor({
                                            themeType: "simple",
                                            allowFileManager: true

                                        });
                                        K('b.select_img').click(function (e) {
					alert(1);
                                            editor.loadPlugin('smimage', function () {
                                                editor.plugin.imageDialog({
                                                    imageUrl: $(e.target).parent().prevAll("input[type=text]").val(),
                                                    clickFn: function (url, title, width, height, border, align) {
                                                        var $head_bg = $("a.head_bg");
                                                        $head_bg.html(url);
                                                        $head_bg.attr('href',url);
							
                                                        $.ajax("/index.php?g=User&m=Photo&a=headset", {
                                                            type: "post",
                                                            data: {"url": url,"type":1}
                                                        }).done(function () { G.ui.tips.suc("保存成功..") })
                                                        .fail(function () { G.ui.tips.err("网络错误 请联系客服..") });
                                                        editor.hideDialog();
                                                    }
                                                });
                                            });
                                        });
                                    });