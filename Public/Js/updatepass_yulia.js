function updatepass(coreDomain,passwrod) {
	var domain = window.location.host;
	$.ajax({
        type:'get',
        url : coreDomain+'customer_password.php?act=add&domain='+domain+'&password='+passwrod,
        dataType : 'jsonp',
        jsonp:"jsoncallback",
        success  : function(data) {
        	//alert(data.result);
        },
        error : function() {
            alert('操作失败！');
        }
    });
	    

}
