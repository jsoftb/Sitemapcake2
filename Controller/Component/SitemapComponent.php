<?php

App::uses('Component', 'Controller');

class SitemapComponent extends Component {
	
	/**
	 * 
	 * @param string $controllername
	 * @param array $excludeActions
	 */
	public function addController($controllername, $excludeActions = array()) {
		
	}
	
	/**
	 * 
	 * If no condition is given, it get all the records of a model
	 * $allArticles = $modelName->find('all');
	 * It must exists the Models' controller
	 * 
	 * @param Model $modelName
	 * @param array $conditions
	 */
	public function addModel ($modelName, $conditions = array()) {
		
	}
	
	
	public function generateSitemap() {
		
	}
	
}
