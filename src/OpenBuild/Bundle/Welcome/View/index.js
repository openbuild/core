define(['openbuild/log', 'knockout', 'toastr', 'jquery', 'openbuild/dataservice', 'durandal/app', 'plugins/router', 'durandal/events'], function(log, ko, toastr, jquery, dataservice, app, router, events){

	var ctor = {};

	events.includeIn(ctor);

	ctor.displayName = '{{ introduction.getDisplay().getValue() }}';

	ctor.description = '{{ description.getDisplay().getValue() }}';

	ctor.features = [
		{% for feature in features %}
		'{{ feature.getFeature().getValue() }}',
		{% endfor %}
	];
	
	ctor.quotes = [
		{% for quote in quotes %}
		'<blockquote><cite>{{ quote.getIndividual().getValue().name }} {{ quote.getIndividual().getValue().position }} </cite> "{{ quote.getQuote().getValue() }}"</blockquote>',
		{% endfor %}
	];

	ctor.activate = function(){
		
		toastr.info('{{ introduction.getDisplay().getValue() }}');
		
	};

	ctor.messageUri = ko.observable();
	ctor.messageData = ko.observable();
	ctor.messageResponse = ko.observable();

	ctor.sendData = function(){
		
		var data = {};
		data.uri = this.messageUri();
		data.data = jquery.parseJSON(this.messageData());
		dataservice.sendMessage(data);
		
		ctor.messageResponse('Loading from WebSocket...');
			
	}

	ctor.sendAjax = function(){

		var data = {};
		data.uri = this.messageUri();
		data.data = jquery.parseJSON(this.messageData());
		dataservice.sendJson(data);
			
		ctor.messageResponse('Loading from AJAX');

	}

	ctor.on('developer').then(function(data){
		ctor.messageResponse(JSON.stringify(data, undefined, 2));		
	});

	app.on('developer').then(function(data){
		ctor.trigger('developer', data);
	});

    return ctor;
    
});