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
	
    return ctor;
    
});