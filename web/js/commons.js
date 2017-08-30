var doAjax = function(url, data){
	data['ajx-rqst'] = true;
    return $.ajax({
        'type' : 'POST',
        'url'  : url,
        'data' : data,
    });
};