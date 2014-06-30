define(['openbuild/log', 'knockout', 'toastr', 'jquery', 'openbuild/dataservice', 'durandal/app', 'durandal/events'], function(log, ko, toastr, jquery, dataservice, app, events){

	var ctor = {};

	events.includeIn(ctor);

	ctor.displayName = 'Page not found on OpenBuild (Sheffield) LTD!';

	ctor.description = 'We could not find the page you were looking for.';

	ctor.features = [
		'Clean MV* Architecture',
	];

	ctor.activate = function(){
		
		toastr.warning('We could not find the page you are looking for');
		
	};

	ctor.messageUri = ko.observable();
	ctor.messageData = ko.observable();
	ctor.messageResponse = ko.observable();

    return ctor;
    
});