define(['openbuild/log', 'knockout', 'toastr', 'jquery', 'openbuild/dataservice', 'durandal/app', 'plugins/router', 'durandal/events'], function(log, ko, toastr, jquery, dataservice, app, router, events){

console.log('CHECKME:');
console.log(app);
console.log(router.activeInstruction());
/*
	var ctor = function(){
    
    	var self = this;
    
		this.displayName = 'Welcome to OpenBuild (Sheffield) LTD!';

		this.description = 'Durandal is a cross-device, cross-platform client framework written in JavaScript and designed to make Single Page Applications (SPAs) easy to create and maintain.';

		this.features = [
			'Clean MV* Architecture',
			'JS & HTML Modularity',
			'Simple App Lifecycle',
			'Eventing, Modals, Message Boxes, etc.',
			'Navigation & Screen State Management',
			'Consistent Async Programming w/ Promises',
			'App Bundling and Optimization',
			'Use any Backend Technology',
			'Built on top of jQuery, Knockout & RequireJS',
			'Integrates with other libraries such as SammyJS & Bootstrap',
			'Make jQuery & Bootstrap widgets templatable and bindable (or build your own widgets).'
		];
        
		this.activate = function(){
		
			toastr.info('Welcome to OpenBuild');
		
		};

		this.messageUri = ko.observable();
		this.messageData = ko.observable();
		this.messageResponse = ko.observable();

		this.sendData = function(){
		
			var data = {};
			data.uri = this.messageUri();
			data.data = jquery.parseJSON(this.messageData());
			dataservice.sendMessage(data);
			
		}

		this.sendAjax = function(){

			var data = {};
			data.uri = this.messageUri();
			data.data = jquery.parseJSON(this.messageData());
			dataservice.sendJson(data);
			
			self.messageResponse('Loading...');

		}

	};
*/
    //Note: This module exports a function. That means that you, the developer, can create multiple instances.
    //This pattern is also recognized by Durandal so that it can create instances on demand.
    //If you wish to create a singleton, you should export an object instead of a function.
    //See the "flickr" module for an example of object export.

	var ctor = {};

	events.includeIn(ctor);

	ctor.displayName = 'Welcome to OpenBuild (Sheffield) LTD!';

	ctor.description = 'We are passionate technologist with a love of open source software and an agile approach to development and can help you deliver the solutions you need in a timely fashion. &nbsp;We specialise in open web technologies including Linux, Apache, Nginx, MySQL, Mongo, PHP, Node.JS on the server and well written Javascript on the client including Durandal, Knockout &amp; jQuery.  We also deliver a iOS app.';

	ctor.features = [
		'Clean MV* Architecture',
		'JS & HTML Modularity',
		'Simple App Lifecycle',
		'Eventing, Modals, Message Boxes, etc.',
		'Navigation & Screen State Management',
		'Consistent Async Programming w/ Promises',
		'App Bundling and Optimization',
		'Use any Backend Technology',
		'Built on top of jQuery, Knockout & RequireJS',
		'Integrates with other libraries such as SammyJS & Bootstrap',
		'Make jQuery & Bootstrap widgets templatable and bindable (or build your own widgets).'
	];
	
	ctor.quotes = [
		'Adam Land, Director of Remedies and Business Analysis at the Competition Commission, said: &quot;<strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; "><em style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">T</em><em style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">his&nbsp;website&nbsp;is a vital component of the package of remedies put in place following our market investigation. Along with other measures, such as data sharing, we expect that our remedy package will open up the market to greater competition, so that customers get more choice and lower prices. I have been impressed by the way in which the home credit industry has worked with other stakeholders to deliver this project</em></strong>.&quot;',
		'&quot;Fantastic&nbsp;app, works&nbsp;well, seems to be intuitive and very useful. It should enable further development in using mobile technology in our school - St. Joseph&#39;s,&nbsp;Workington&quot;&nbsp;mapandrews',
		'Duncan Randall&nbsp;<strong>&quot;They are delighted with the site, it exceeds all expectations, uptake is higher than anyone imagined and they would like to thank us all for our helpful and diplomatic approach to the project, which went beyond our obligations.&quot;</strong>',
		'&quot;The most useful of the polling&nbsp;apps&nbsp;the I&#39;ve tried; working better then several more expensive&nbsp;programs&nbsp;in the&nbsp;App&nbsp;Store&quot;&nbsp;dweran',
		'Consumer Affairs Minister&nbsp;Gareth&nbsp;Thomas said: &quot;<strong style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; "><em style="margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; ">This&nbsp;website&nbsp;will help people to save money and get a good deal. Consumers will be able to shop around for loans from Home Credit providers and local Credit Unions that best meet their needs</em></strong>.&quot;'
	];

	ctor.activate = function(){
		
		toastr.info('Welcome to OpenBuild');
		
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

console.log('CHECK ME');
console.log(ctor);

	ctor.on('developer').then(function(data){
		console.log('In ctor trigger');
		console.log(data);
		ctor.messageResponse(JSON.stringify(data, undefined, 2));		
	});

	app.on('developer').then(function(data){
		console.log('In app trigger');
		ctor.trigger('developer', data);
	});

    return ctor;
    
});