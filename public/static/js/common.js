
$(function(){
	formRequiredLabel();
	
	listenClearHotkey();
});
/**
 * 放资料到Cookie
 * @param name
 * @param value
 */
function setCookie(name,value){
	var Days = 300; //此 cookie 将被保存 30 天
	var exp  = new Date();    //new Date("December 31, 9998");
	exp.setTime(exp.getTime() + Days*24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}
/**
 * 取Cookie的资料
 * @param name
 * @returns
 */
function getCookie(name){
    var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
    if(arr != null) return unescape(arr[2]);
    return null;
}
/**
 * 用Ajax把Json资料做传递与接收
 * @param url
 * @param data
 * @param successFun
 */
function doJsonAjax(url, data, successFun){
	$.ajax({
    	type: "post",
        dataType: "json",
        url: url,
        data: data,
        success: successFun,
        error: function(XMLHttpRequest, textStatus, errorThrown){
        	alert(errorThrown);
        }
    });
}
/**
 * Esc键刷新页面
 */
function listenClearHotkey(){
	$(document).keyup(function(e){
		if (event.keyCode == 27) {
			location.href = "?";
        }
	});
}

/**
 * 在每個Form表單裡必填栏位加註必填欄位*
 */
function formRequiredLabel(){
	$("label.required").each(function(){
		$(this).prepend('<span style="color: #FF0000;">*</span>');
	});
}
/**
 * 共用的Ajax Error
 * @param XMLHttpRequest
 * @param textStatus
 * @param errorThrown
 */
function ajaxError(XMLHttpRequest, textStatus, errorThrown){
	alert(errorThrown);
}
/**
 * ajax成功时的共用方法
 * @param string resultStr 回应的文字
 * @param resultFunction 返回的方法
 */
function ajaxSuccessResult(resultStr, resultFunction){
	if(isJson(resultStr)){
    	var data = mini.decode(resultStr);
    	if(data.isSuccess){
    		resultFunction(data.dataObj);
    	}else{
    		alert(data.message);
    	}
    }else{
    	showSystemErrorWindow(resultStr);
    }
}

/**
 * 判斷是否為JSON
 * @param string obj
 * @returns {Boolean}
 */
function isJson(obj){
	var isjson = typeof(obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length; 
	return isjson;
}
/**
 * 遮照加载
 */
function mask(message){
	message=message?message:'loading……';
	mini.mask({
        el: document.body,
        cls: 'mini-mask-loading',
        html: message
    });
}
/**
 * 遮照取消
 */
function unmask(){mini.unmask();}

/**
 * 显示提示讯息
 * @param string messageStr
 */
function showTipMessage(messageStr){
	mini.showTips({
        content: messageStr,
        state: 'danger',
        x: 'center',
        y: 'center',
        timeout: 3000
    });
}
/**
 * 秀出系統錯誤訊息
 * @param string htmlStr
 */
function showSystemErrorWindow(htmlStr){
	alert(htmlStr, "Program error ");
}
/**
 * 生成虚拟表单(中间的data是需要有key和value的二维数组，并且value只能为string类型)
 * @param url 响应url
 * @param data 数据集
 * @param blink 是否弹出新窗口
 * @returns void
 */
function postFormSubmit(url,data,blink = true)
{
    var tempForm = document.createElement("form");
    tempForm.id = "tempForm1";
    tempForm.method = "post";
    tempForm.action = url;
    if(blink)
    	tempForm.target = url;    // _blank - URL加载到一个新的窗口
    
    //遍历需要传至后台的数据数组，生成多个input用于提交
    for ( const [key,value] of data)
    	{
	    	var hideInput = document.createElement("input");
	        hideInput.type = "hidden";
	        hideInput.name = key;
	        hideInput.value = value;
	        tempForm.appendChild(hideInput);
    	}
    
    if(document.all&&(!+"\v1")){    // 兼容不同浏览器
        tempForm.attachEvent("onsubmit",function(){});        //IE
    }else{
        tempForm.addEventListener("submit",function(){},false);    //firefox
    }
    document.body.appendChild(tempForm);
    if(document.all&&(!+"\v1")){    // 兼容不同浏览器
        tempForm.fireEvent("onsubmit");
    }else{
        var event;
        if(typeof(Event) === 'function') {
            event = new Event('submit');
        }else{
            event = document.createEvent('Event');
            event.initEvent('submit', true, true);
        }
        tempForm.dispatchEvent(event);
    }
    tempForm.submit();
    document.body.removeChild(tempForm);
}