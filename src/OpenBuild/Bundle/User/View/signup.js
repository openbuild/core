define(['plugins/router', 'durandal/events', 'knockout', 'jquery'], function(router, events, ko, jquery){

	/*
	has-success
	has-feedback
	has-warning
	has-error
	*/

	var ctor = {};

	events.includeIn(ctor);
	
	ctor.form = {
		firstName:{
			help: 'Please enter your first name, it should be letters and possibly spaces only.'
		},
		lastName:{
			help: 'Please enter your last name, it should be letters and possibly spaces a hyphen or apostrophe .'
		},
		email:{
			help: 'Please enter a valid e-mail address where we can contact you, we don\'t ever pass on your details.'
		},
		password:{
			help: 'Please enter a password, you will need this to open your certificate.'
		},
		passwordRepeat:{
			help: 'Please enter the same password as above.'
		},
		city:{
			help: 'Please enter your Town or City, we use this for internal marketing only and will never pass on your details.'
		},
		county:{
			help: 'Please enter your County, State or Province, we use this for internal marketing only and will never pass on your details.'
		},
		country:{
			help: 'Please enter your Country, we use this for internal marketing only and will never pass on your details.'
		},
	};
	
	ctor.firstName = ko.observable();
	ctor.lastName = ko.observable();
	ctor.email = ko.observable();
	ctor.password = ko.observable();
	ctor.passwordRepeat = ko.observable();
	ctor.city = ko.observable();
	ctor.county = ko.observable();
	ctor.country = ko.observable();
	
	ctor.firstNameStatus = ko.observable();
	ctor.lastNameStatus = ko.observable();
	ctor.emailStatus = ko.observable();
	ctor.passwordStatus = ko.observable();
	ctor.passwordRepeatStatus = ko.observable();
	ctor.cityStatus = ko.observable();
	ctor.countyStatus = ko.observable();
	ctor.countryStatus = ko.observable();
	
	ctor.firstNameMessage = ko.observable();
	ctor.lastNameMessage = ko.observable();
	ctor.emailMessage = ko.observable();
	ctor.passwordMessage = ko.observable();
	ctor.passwordRepeatMessage = ko.observable();
	ctor.cityMessage = ko.observable();
	ctor.countyMessage = ko.observable();
	ctor.countryMessage = ko.observable();
	
	//ctor.firstName.subscribe(function (newValue) {
		//console.log(data.firstName());
	//});
	/*
	ctor.validation = {};

	ctor.validation.state = function(thing){
		console.log('v: ' + thing);
		return '';
	};
	
	ctor.validation.message = function(thing){
		console.log('m: ' + thing);
		return '';
	};
	*/	
	ctor.help = function(where){
	
		//ctor.firstNameStatus('form-group has-warning');
		//ctor.firstNameMessage('dgdf');
		$.each(ctor.form, function(k, v){
		
			messageProperty = k + 'Message';
			statusProperty = k + 'Status';
			
			if(k == where){
//console.log('set:' + k);
//console.log(statusProperty + ' : ' + v.help);
//console.log(ctor[statusProperty]());
				if(ctor[messageProperty]() == ''){
					ctor[messageProperty](v.help);
					ctor[statusProperty]('form-group has-warning');
				}else{
					ctor[messageProperty]('');
					ctor[statusProperty]('form-group');
				}
			}else{
//console.log('blank:' + k);
				ctor[messageProperty]('');
				ctor[statusProperty]('form-group');
			}
			
		});
		
	};
	
	ctor.send = function(){
		alert('Send it!');
	};
	
    return ctor;
    
});