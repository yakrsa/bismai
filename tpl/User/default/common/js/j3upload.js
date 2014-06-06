/**
* 添加标签的函数
* @param els
* @param tags
* @return
*/

function imgSelectorInit() {
    $('#imgSelectorChoice').delegate('img', 'click', function () {
        var el = $(this);
        if (!el.hasClass('selected'))
            buildSelectedImg(el);
    }).delegate('img', 'mouseenter', function () {
        $(this).addClass('hovered');
    }).delegate('img', 'mouseleave', function () {
        $(this).removeClass('hovered');
    });
}
function ipostSortInit() {
    $('.ipost-list').sortable({
        items: '> .post',
        containment: 'parent',
        appendTo: 'parent',
        tolerance: 'pointer',
        axis: 'y',
        placeholder: 'holder',
        forceHelperSize: true,
        forcePlaceholderSize: true,
        opacity: 0.8,
        cursor: 'ns-resize'
    });
}

 
  
function addFile(image) {
    var el = $('<li class="imgbox" data-post-id="' + image.id + '" data-url="' + image.thm_url + '"><a class="item_close" href="javascript:void(0)" title="删除"></a>'
         + '<input type="hidden" value="' + image.id + '" name="photoid[]">'
		 + '<input type="hidden" value="' + image.url + '" name="url[]">'
		+ ' <span class="item_box">'	 
		+ '<img src="' + image.thm_url + '" width="90" height="80"></span> '
		        + '<span class="item_input">' 
			+ ' <textarea name="description[]" class="bewrite" cols="3" rows="4" style="resize: none" data-rule-maxlength="150" placeholder="图片描述...">' + image.title + '</textarea>' //this.title
			+ '<i class="shadow hc"></i></span>'
		        + '<span class="item_input">' 
			+ ' <textarea name="sort[]" class="bewrite" cols="3" rows="4" style="resize: none" data-rule-maxlength="150" placeholder="图片排序...">' + image.sort + '</textarea>' //this.title
			+ '<i class="shadow hc"></i></span>'
			 
		+ '</li>').appendTo($('#fileList'));
     
    return el;
     
}
function initUpload(el,count, op,url,delurl,swfurl) {
    var c = count - $("li.imgbox").length;
    el.uploadify({
        'swf': swfurl,
        'uploader': url,
        'cancelImage': 'uploadify-cancel.png',
        'buttonClass': 'btn pl_add btn-primary',
        'removeTimeout': 0,
        'fileSizeLimit': '300kb',
        'buttonText': '<i class="icon-plus-sign"></i> 添加图片',
        'formData': op,
        'buttonCursor': 'pointer',
        'fileTypeDesc': '图片格式',
        'fileTypeExts': '*.jpg;*.bmp;*.png; *.jpeg',
        'queueSizeLimit': 300,
        'uploadLimit': c<=0?1:c,
        'onUploadError': function (file, errorCode, errorMsg, errorString, queue) { alert(file.name + "上传失败") },
        'onUploadStart': function (file) {
            $('#file_upload-button').html('<i class="icon-plus-sign"></i> 继续上传');
            if ($("#bsubmit").length == 0) { $('#file_upload-button').parent().append('   <button id="bsubmit" type="submit" data-loading-text="提交中..." class="btn">保存</button>') }
  
        },
        'onInit': function(instance) {
            if ((count - $("li.imgbox").length) <= 0) {
                var button = $("#file_upload-button");
                button.addClass("disabled").attr("style", "z-index: 999;")
                button.html('上传已达限制...');
            }
        },
        'onUploadSuccess': function (file, data, response) {
            var json = $.parseJSON(data);
            if (json.result !== 'SUCCESS') {
                G.ui.tips.info(json.message || data);
                return;
            }else{
				addFile(json.image);
			}
        } 

    }); 
    $('#fileList').delegate('.item_close', 'click', function (e) {
        $.fallr('show', {
            buttons: {
                button1: {
                    text: '确定', danger: true, onclick: function () {
                        var el = $(e.target).closest('li.imgbox');
			 
                        $.post(delurl, {
                            "id": el.data('postId'),
							"url": el.children().eq(1).val()
                        });
                        el.remove(); 
 
                        $.fallr('hide');

                    }
                },
                button2: {
                    text: '取消'
                }
            },
            content: '<p>你确定要删除这张图片吗？</p>',
            icon: 'trash'
        });

    })

}

