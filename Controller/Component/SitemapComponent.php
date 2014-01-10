<?php
//http://webdesign.about.com/od/localization/l/bllanguagecodes.htm
App::uses('Component', 'Controller');

class SitemapComponent extends Component {
	
	/**
	 * 
	 * @param string $controllername
	 * @param array $excludeActions
	 */
	public function addController($controllername, $excludeActions = array(), $languages = array()) {
		
	}
	
	/**
	 * 
	 * If no condition is given, it get all the records of a model
	 * $allArticles = $modelName->find('all');
	 * It must exists the Models' controller
	 * 
	 * @param Model $modelName
	 * @param string $controllerName
	 * @param array $languages
	 */
	public function addModel (Model $model, $controllerName, $languages = array()) {
		
	}
	
	/**
	 * Returns the sitemap XML content 
	 * @param boolean $includeHome
	 */
	public function getSitemap($includeHome = true, $languages = array()) {
		
	}
	
}
