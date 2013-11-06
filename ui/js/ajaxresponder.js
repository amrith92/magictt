define({
	newRequest: function() {
		var xhttp;
		
		if (window.XMLHttpRequest) {
			xhttp = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			try {
				xhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} 
			catch (e) {
				try {
					xhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} 
				catch (e) {}
			}
		}

		if (!xhttp) {
			alert('Giving up :( Cannot create an XMLHTTP instance');
		}
		
		return xhttp;
	},
	
	dispatch: function(params) {
		if (params.xhttp.readyState === 4) {
			if (params.xhttp.status === 200) {
				params.callback(JSON.parse(params.xhttp.responseText));
			} else {
				alert('There was a problem with the request.');
			}
		}
	},
	
	post: function(url, callback, async) {
		var xhttp = this.newRequest();
		
		if (xhttp) {
			var self = this;
			xhttp.onreadystatechange = function() {
				self.dispatch({
					xhttp: xhttp,
					callback: callback
				});
			};
			
			if (typeof(async) == 'undefined') {
				async = true;
			}
			
			xhttp.open('POST', url, async);
			xhttp.send();
		}
	},
	
	get: function(url, callback, async) {
		var xhttp = this.newRequest();
		
		if (xhttp) {
			var self = this;
			xhttp.onreadystatechange = function() {
				self.dispatch({
					xhttp: xhttp,
					callback: callback
				});
			};
			
			if (typeof(async) == 'undefined') {
				async = true;
			}
			
			xhttp.open('GET', url, async);
			xhttp.send();
		}
	}
});

