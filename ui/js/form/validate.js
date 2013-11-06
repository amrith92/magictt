define(['../ajaxresponder'], function(ajax) {

	return {
		empty: function(str) {
			return (0 == str.length);
		},
		
		alphabets: function(str) {
			return /^[A-Za-z]+$/.test(str);
		},
		
		alphanumeric: function(str) {
			return /^[A-Za-z0-9]{2,10}$/.test(str);
		},
		
		numeric: function(str, _min, _max) {
			var is_valid = /^[0-9]+$/.test(str);
			
			if (is_valid && _min != undefined) {
				is_valid = (str >= _min) ? true : false;
			}
			
			if (is_valid && _max != undefined) {
				is_valid = (str <= _max) ? true : false;
			}
			
			return is_valid;
		},
		
		name: function(str) {
			return /^[A-Za-z \-]+$/.test(str);
		},
		
		email: function(str) {
			return /^[A-Za-z0-9\-\_\.]+@[A-Za-z0-9\-\_\.]+$/.test(str);
		},
		
		async: function(url, responder) {
			ajax.get(url, responder);
		}
	};
});
