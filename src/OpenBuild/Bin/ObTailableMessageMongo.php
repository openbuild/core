<?php

	//Capped collections are fixed size and can only be updated but they are fast, oldest removed first
	//db.createCollection("MessageQueueConnected", { capped : true, size : 5242880, max : 100000 } );
	//db.MessageQueueConnected.drop();
	
	//TODO - put this in the local DB
	$mongo = new \MongoClient();
	$db = $mongo->selectDB('OpenBuild');
	$collection = $db->selectCollection('MessageQueueConnected');
	$cursor = $collection->find()->tailable(true);
	
	while(true){
	
		if ($cursor->hasNext()){
			
			$doc = $cursor->getNext();
			
			if($doc['_processed'] === false){

				$toSend = $doc;
				unset($toSend['_id']);
				unset($toSend['_processed']);
			
				echo(json_encode($toSend));
						
				$collection->update($doc, array('$set' => array("_processed" => true)));
			
			}
				
		}else{
			
			sleep(1);
			
		}
	
	}