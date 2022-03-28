// JavaScript Document
$(function(){
	/**
	 * 不能为空(字符)
	 */
	mini.VTypes["notemptyErrorText"] = "不能为空(字符)";
	mini.VTypes["notempty"] = function (v) {
	    if (v && $.trim(v)) return true;
	    return false;
	}
	
	/**
	 * 判断是否为正整数 
	 */	
	mini.VTypes["positiventegerErrorText"] = "请输入正整數";
	mini.VTypes["positiventeger"] = function (v) {
		var re = new RegExp("^([1-9][0-9]*)$");
	    if (re.test(v)) return true;
	    return false;
	}
	
	/**
	 * 判是否为小数
	 * yue.shen
	 */
	mini.VTypes["floatnumberErrorText"] = "请输入數字";
	mini.VTypes["floatnumber"] = function (v) {
		var re = new RegExp("^-?([1-9]d*.d*|0.d*[1-9]d*|0?.0+|0)$");
	    if (re.test(v)) return true;
	    return false;
	}
})
	