define({
	clearErrors: function(field) {
		var previousErrors = field.parentNode.getElementsByClassName('error');
		
		for (var i = 0, term = previousErrors.length; i < term; ++i) {
			field.parentNode.removeChild(previousErrors[i]);
		}
		
		field.classList.remove('wrong');
	},
	
	setError: function(field, what) {
		var error = document.createElement('div');
		error.classList.add('error');
		
		error.innerHTML = what;
		
		this.clearErrors(field);
		
		field.parentNode.appendChild(error);
		
		field.classList.add('wrong');
	},
	
	hasError: function(form) {
		var children = form.childNodes,
				stopper = false;
		
		for (var i = 0, term = children.length; i < term && false == stopper; ++i) {
			if ('error' == children[i].className) {
				stopper = true;
				continue;
			}
			
			if (children[i].hasChildNodes()) {
				stopper = this.hasError(children[i]);
			}
		}
		
		return stopper;
	}
});
