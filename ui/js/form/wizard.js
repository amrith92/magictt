define(['./util', './validate'], function(util, validate) {
	return {
		fields: {
			age: document.getElementById('age'),
			maritalStatus: document.getElementById('marital-status'),
			kids: document.getElementById('kids'),
			next: document.getElementById('next-step')
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
		
		next: function(e, ctrl) {
			e.preventDefault();
				
			var step = ctrl.getAttribute('data-step'),
				  self = this;
			
			if ('age' == step) {
				self.fields.age.parentNode.parentNode.classList.add('hidden');
				self.fields.maritalStatus.parentNode.parentNode.classList.remove('hidden');
				ctrl.setAttribute('data-step', 'marital-status');
			} else if ('marital-status' == step) {
				self.fields.maritalStatus.parentNode.parentNode.classList.add('hidden');
				
				if (self.fields.maritalStatus.value == 'Yes') {
					self.fields.kids.parentNode.parentNode.classList.remove('hidden');
					ctrl.setAttribute('data-step', 'kids');
				} else {
					alert('Done!');
				}
			}
		}
	};
});
