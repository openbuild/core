define(['openbuild/log', 'knockout', 'toastr', 'jquery', 'openbuild/dataservice', 'durandal/app', 'durandal/events'], function(log, ko, toastr, jquery, dataservice, app, events){

	var ctor = {};

	events.includeIn(ctor);
	
	ctor.introductionTitle = '{{ introduction.getTitle().getValue() }}';

	ctor.introductionBody = '{{ introduction.getBody().getValue() }}';
	
	ctor.messages = [
		{% for message in messages %}
		'{{ message.getMessage().getHTML()|escape('js') }}',
		{% endfor %}
	];
	
	ctor.messageCounter = 0;
	
	ctor.templateGet = function(data){
//console.log('data:');
//console.log(data);
console.log(ctor.messageCounter);

console.log(ctor.messageCounter % 2 == 0);

		if(ctor.messageCounter % 2 == 0){
			template = 'templateStartRow';
		}else{
			template = 'templateEndRow';
		}

		ctor.messageCounter = ctor.messageCounter + 1;

		return template;
		
	}.bind(ctor);
	
    return ctor;
    
});