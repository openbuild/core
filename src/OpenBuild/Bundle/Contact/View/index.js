define(['plugins/router', 'plugins/http', 'durandal/events', 'durandal/app', 'knockout', 'jquery'], function(router, http, events, app, ko, jquery){

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
		phone:{
			help: 'Please enter a valid phone number where we can contact you, we don\'t ever pass on your details.'
		},
		message:{
			help: 'What would you like to tell us?  How can we help you achieve your goals?'
		},
	};
	
	ctor.firstName = ko.observable();
	ctor.lastName = ko.observable();
	ctor.email = ko.observable();
	ctor.phone = ko.observable();
	ctor.message = ko.observable();
	
	ctor.firstNameStatus = ko.observable();
	ctor.lastNameStatus = ko.observable();
	ctor.emailStatus = ko.observable();
	ctor.phoneStatus = ko.observable();
	ctor.messageStatus = ko.observable();
	
	ctor.firstNameMessage = ko.observable();
	ctor.lastNameMessage = ko.observable();
	ctor.emailMessage = ko.observable();
	ctor.phoneMessage = ko.observable();
	ctor.messageMessage = ko.observable();
	
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
	
		$.each(ctor.form, function(k, v){
		
			messageProperty = k + 'Message';
			statusProperty = k + 'Status';
			
			if(k == where){

				if(ctor[messageProperty]() == ''){
					ctor[messageProperty](v.help);
					ctor[statusProperty]('form-group has-warning');
				}else{
					ctor[messageProperty]('');
					ctor[statusProperty]('form-group');
				}
			}else{

				ctor[messageProperty]('');
				ctor[statusProperty]('form-group');
			}
			
		});
		
	};
	
	ctor.send = function(){

		http.post('{{ dir }}/contact.js', {
			firstName: ctor.firstName(),
			lastName: ctor.lastName(),
			email: ctor.email(),
			phone: ctor.phone(),
			message: ctor.message()
		}).then(function(response){
			console.log('w00t response');
			console.log(response);
		}, function(error) {
			console.log('error');
			console.log(error);
			app.showMessage(error.statusText, "Error in contact");
		});
		
	};
	
/*
	ctor.page = null;

	ctor.getView = function(){
		return '/app/terms/' + ctor.page;
	};

	ctor.activate = function(page){
	
		var pages = ['index', 'cookies'];
	
		if(page == null){
			page = 'index';
		}
		
		if(jquery.inArray(page, pages) == -1){		
			router.navigate('404.obd');
			return;
		}
		
		ctor.page = page;
	
	};
*/
    return ctor;
    
});