define(['./util', './validate'], function(util, validate) {
	return {
		fields: {
			age: document.getElementById('age'),
			maritalStatus: document.getElementById('marital-status'),
			kids: document.getElementById('kids'),
			next: document.getElementById('next-step')
		},
		
		data: {
			age: undefined,
			married: undefined,
			kids: undefined
		},
		
		setup: function() {
			var self = this;
			
			this.fields.age.addEventListener('keyup', function(e) {
				if (13 == e.keyCode) {
					if (!self.fields.next.parentNode.classList.contains('imaginary')) {
						self.next(e, self.fields.next);
					}
				}
				
				if (validate.numeric(this.value, 18)) {
					util.clearErrors(this);
					self.fields.next.parentNode.classList.remove('imaginary');
				} else {
					util.setError(this, 'You must be 18 years or older.');
					self.fields.next.parentNode.classList.add('imaginary');
				}
			});
			
			this.fields.next.addEventListener('click', function(e) {
				self.next(e, this);
			});
		},
		
		send: function() {
			var l = window.location;
			var str = l.protocol + "//" + l.hostname + "/tour?age=" + this.data.age;
			
			if (undefined != this.data.married) {
				str += "&married=" + this.data.married;
			}
			
			if (undefined != this.data.kids) {
				str += "&kids=" + this.data.kids;
			}
			
			window.location.href = str;
		},
		
		next: function(e, ctrl) {
			e.preventDefault();
				
			var step = ctrl.getAttribute('data-step'),
				  self = this;
			
			if ('age' == step) {
				self.fields.age.parentNode.parentNode.classList.add('hidden');
				self.fields.maritalStatus.parentNode.parentNode.classList.remove('hidden');
				ctrl.setAttribute('data-step', 'marital-status');
				self.data.age = self.fields.age.value;
			} else if ('marital-status' == step) {
				self.fields.maritalStatus.parentNode.parentNode.classList.add('hidden');
				
				if (self.fields.maritalStatus.value == 'Yes') {
					self.fields.kids.parentNode.parentNode.classList.remove('hidden');
					ctrl.setAttribute('data-step', 'kids');
					self.data.married = 'Yes';
				} else {
					self.data.married = 'No';
					self.send();
				}
			} else if ('kids' == step) {
				self.fields.maritalStatus.parentNode.parentNode.classList.add('hidden');
				if (self.fields.kids.value == 'Yes') {
					self.data.kids = 'Yes';
				} else {
					self.data.kids = 'No';
				}
				
				self.send();
			}
		}
	};
});
