require.config({
    "packages": ["form"]
});

require(['form/booking'], function(booking) {
	booking.setup();
});

