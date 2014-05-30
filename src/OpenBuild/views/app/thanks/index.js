define(['openbuild/log', 'knockout', 'toastr', 'jquery', 'openbuild/dataservice', 'durandal/app', 'durandal/events'], function(log, ko, toastr, jquery, dataservice, app, events){

	var ctor = {};

	events.includeIn(ctor);

    return ctor;
    
});