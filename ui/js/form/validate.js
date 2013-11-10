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
		
		date: function(str, format) {
			if (format == undefined) {
				format = "d-m-Y";
			}
			
			var data = format.split('-');
			var pieces = str.split('-');
			
			var day, month, year;
			
			for (var i = 0; i < pieces.length; ++i) {
				if ('d' == data[i]) {
					day = pieces[i];
				}
				
				if ('m' == data[i]) {
					month = pieces[i];
				}
				
				if ('Y' == data[i]) {
					year = pieces[i];
				}
			}
			
			console.log(format + ": " + day + "-" + month + "-" + year);
				
			var date = new Date(year, month, day);
			
			return isNaN(date.getTime()) ? false : true;
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
