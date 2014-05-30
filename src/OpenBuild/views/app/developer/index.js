define(['openbuild/log', 'knockout', 'toastr', 'jquery', 'openbuild/dataservice', 'durandal/app', 'durandal/events'], function(log, ko, toastr, jquery, dataservice, app, events){


	var ctor = function(){
    
    	var self = this;
    
    	this.form = {
			uri:{
				help: 'Enter a uri to call.'
			},
			message:{
				help: 'Enter a well formed JSON message to send to the server.'
			},
		};
	
		this.uri = ko.observable();
		this.message = ko.observable();
		this.response = ko.observable();
		
		this.response('The last set of data returned by the server.');
	
		this.uriStatus = ko.observable();
		this.messageStatus = ko.observable();
		this.responseStatus = ko.observable();

		this.uriMessage = ko.observable();
		this.messageMessage = ko.observable();
		this.responseMessage = ko.observable();
    
    	this.help = function(where){
	
			$.each(ctor.form, function(k, v){
		
				messageProperty = k + 'Message';
				statusProperty = k + 'Status';
			
				if(k == where){

					if(self[messageProperty]() == ''){
						self[messageProperty](v.help);
						self[statusProperty]('form-group has-warning');
					}else{
						self[messageProperty]('');
						self[statusProperty]('form-group');
					}

				}else{

					self[messageProperty]('');
					self[statusProperty]('form-group');

				}
			
			});
		
		};

		this.sendData = function(){
console.log('SEND DATA');

			self.messageMessage('');
			self.messageStatus('form-group');
		
			var data = {};
			data.uri = self.uri();
		
			try{

				data.data = jquery.parseJSON(this.message());

			}catch(e){
console.log(e);

				error = 'Message is not well formed JSON.\n';

				if(e.message){
					error += e.message;
				}

				self.messageMessage(error);
				self.messageStatus('form-group has-error');
				return false;
	
			}

			dataservice.sendMessage(data);
		
			self.response('Loading from WebSocket...');
			
		}

		this.sendAjax = function(){

			var data = {};
			data.uri = self.uri();
			
			try{

				data.data = jquery.parseJSON(this.message());

			}catch(e){

				self.messageMessage('Message is not well formed JSON.');
				self.messageStatus('form-group has-error');
				return false;
		
			}
		
			dataservice.sendJson(data);
			
			ctor.response('Loading from AJAX');

		}
    	
	};

	events.includeIn(ctor);

	ctor.on('developer').then(function(data){
//		console.log('In ctor trigger');
//		console.log(data);
		self.response(JSON.stringify(data, undefined, 2));		
	});	

	app.on('developer').then(function(data){
//		console.log('In app trigger');
		ctor.trigger('developer', data);
	});

	return ctor;
	
/*
	var ctor = {};

	events.includeIn(ctor);

	ctor.form = {
		uri:{
			help: 'Enter a uri to call.'
		},
		message:{
			help: 'Enter a well formed JSON message to send to the server.'
		},
	};
	
	ctor.uri = ko.observable();
	ctor.message = ko.observable();
	ctor.response = ko.observable();
	
	ctor.response('The last set of data returned by the server.');
	
	ctor.uriStatus = ko.observable();
	ctor.messageStatus = ko.observable();
	ctor.responseStatus = ko.observable();

	ctor.uriMessage = ko.observable();
	ctor.messageMessage = ko.observable();
	ctor.responseMessage = ko.observable();

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


	ctor.sendData = function(){
console.log('SEND DATA');

		ctor.messageMessage('');
		ctor.messageStatus('form-group');
		
		var data = {};
		data.uri = this.uri();
		
		try{

			data.data = jquery.parseJSON(this.message());

		}catch(e){
console.log(e);

			error = 'Message is not well formed JSON.\n';

			if(e.message){
				error += e.message;
			}

			ctor.messageMessage(error);
			ctor.messageStatus('form-group has-error');
			return false;
		
		}

		dataservice.sendMessage(data);
		
		ctor.response('Loading from WebSocket...');
			
	}

	ctor.sendAjax = function(){

		var data = {};
		data.uri = this.uri();
		
		try{

			data.data = jquery.parseJSON(this.message());

		}catch(e){

			ctor.messageMessage('Message is not well formed JSON.');
			ctor.messageStatus('form-group has-error');
			return false;
		
		}
		
		dataservice.sendJson(data);
			
		ctor.response('Loading from AJAX');

	}

	ctor.on('developer').then(function(data){
//		console.log('In ctor trigger');
//		console.log(data);
		ctor.response(JSON.stringify(data, undefined, 2));		
	});

	app.on('developer').then(function(data){
//		console.log('In app trigger');
		ctor.trigger('developer', data);
	});

    return ctor;
*/    
});