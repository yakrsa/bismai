   $(document).ready(function () {
                                            initUpload($("#file_upload"), 50,{
                                                'type_id': 1, 
                                                'abid':"206",
                                                'aid':"4075",
												'utype':"102",
												'uid':"8546",
												'uu':"d6e33cb5984b08926ef0ddec6179939f"
                                            },"http://www.iMicms.com/uploadify/uploadify.php","","http://www.iMicms.com/uploadify/uploadify.swf");
                                            imgSelectorInit();
                                            ipostSortInit();
                                            if ($("#fileList li").length > 0) {
                                                if ($("#bsubmit").length == 0) { $('#file_upload-button').parent().add("#upimg_main").append('   <button id="bsubmit" type="submit" data-loading-text="提交中..." class="btn">保存</button>') }
                                            }
//											  if ((/Firefox/i.test(navigator.userAgent))) {
//													G.ui.tips.info("您当前使用的是firefox浏览器 暂时不兼容此上传 .请使用其他浏览器来上传图片");
//													$("#file_upload-button").addClass("disabled").attr("style", "z-index: 999;")
//											}
                                          
                                        });
