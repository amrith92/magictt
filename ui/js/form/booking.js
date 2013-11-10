define(['./util', './validate'], function(util, validate) {
	return {
		ticketCtr: 2,
		
		fields: {
			addButton: document.getElementById('add-button'),
			tickets: document.getElementById('tickets'),
			journeyDate: document.getElementById('_journeyDate')
		},
		
		add: function(obj) {
			var self = this;
			obj.parentNode.removeChild(obj);
			
			var div = document.createElement('div');
			div.classList.add('row');
			div.innerHTML =
				'<div class="col-xs-4">'
				+ '<label for="_ticket_name_' + self.ticketCtr + '">Full Name</label>'
				+ '<input type="text" name="ticket_name[]" id="_ticket_name' + self.ticketCtr + '" class="form-control" placeholder="Full Name" />'
				+ '</div>'
				+ '<div class="col-xs-3">'
				+ '<label for="_ticket_dob' + self.ticketCtr + '">Date Of Birth</label>'
				+ '<input type="date" name="ticket_dob[]" id="_ticket_dob' + self.ticketCtr + '" class="form-control" placeholder="Date Of Birth (DD-MM-YYYY)" />'
				+ '</div>'
				+ '<div class="col-xs-4">'
				+ '<label for="_ticket_gender' + self.ticketCtr + '">Gender</label>'
				+ '<select class="form-control" name="ticket_gender[]" id="_ticket_gender' + self.ticketCtr + '">'
				+ '<option value="Female">Female</option>'
				+ '<option value="Male">Male</option>'
				+ '</select>'
				+ '</div>'
				+ '<div class="col-xs-1">'
				+ '</div>';
				
				self.fields.tickets.appendChild(div);
				
				var a = document.createElement('a');
				a.innerHTML = "+";
				a.id = "add-button";
				a.classList.add('btn');
				a.classList.add('btn-primary');
				
				var target = document.getElementsByClassName('col-xs-1')[self.ticketCtr - 1];
				
				target.appendChild(a);
				
				a.addEventListener('click', function(e) {
					e.preventDefault();
					self.add(this);
				});
				
				++self.ticketCtr;
		},
		
		setup: function() {
			var self = this;
			
			this.fields.journeyDate.addEventListener('keyup', function(e) {
				e.preventDefault();
				
				if (false == validate.date(this.value)) {
					util.setError(this, "Date must be a valid format");
				} else {
					util.clearErrors(this);
				}
			});
			
			this.fields.addButton.addEventListener('click', function(e) {
				e.preventDefault();
				
				self.add(this);
			});
		}
	};
});
