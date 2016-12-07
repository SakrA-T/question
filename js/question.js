(function($) {
	//获取学院和课程组信息,json格式
	$.getInfoJson = function (type) {
		var jsonText;

		$.ajaxSetup({ //必须设置为同步，否则变量传不出去
			async: false
		});

		if(type=="team" || type=="school" || type=="type"){
			$.post("get_"+type+".php", function(data, textStatus, xhr) {
				if(textStatus!="success"){
					alert("获取信息失败！请联系系统管理员进行修复！");
					return;
				}
				else jsonText=data;
			});
			return jsonText;
		}
		else{
			alert("Invalid request!");
			return;
		}
	};

	//获取试题类型信息,type=html || json
	$.getType = function (type) {
		var text;

		$.ajaxSetup({ //必须设置为同步，否则变量传不出去
			async: false
		});
		if(type=="html" || type=="json"){
			$.post('get_type.php', {type: type}, function(data, textStatus, xhr) {
				if(textStatus!="success"){
					alert("获取信息失败！请联系系统管理员进行修复！");
					return;
				}
				else text=data;
			});
			return text;
		}
		else{
			alert("Invalid request!");
			return;
		}
	};

	//把学院信息append到school的select里
	$.fn.appendSchool = function (jsonObj) {
		var schoolSelect=this;
		$.each(jsonObj, function(index, val) {
				schoolSelect.append("<option value='" + val.id + "'>" + val.name + "</option>");
		});
	};

	//根据所选学院，将对应的课程组append到课程组的select里
	$.fn.appendTeam = function (school,jsonObj) {
		var teamSelect=this;
		$.each(jsonObj, function(index, val) {
			if(school==val.id)
				$.each(val.team, function(index, val) {
					teamSelect.append("<option value='" + val.id + "'>" + val.name + "</option>");
				});
		});
	};
})(jQuery);
/*笔记*/
/* $.extend  第二种写法
(function ($) {
	$.extend({
		getSchool:function (select) {
			
		},

		getTeam:function (school,select) {
			
		},
	});

	$.fn.extend({
		
	})
})(jQuery);*/
