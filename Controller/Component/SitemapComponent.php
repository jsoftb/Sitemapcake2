<?php
/**
 * BlogPostCategories Controller
 *
 * Pretty much just baked admin actions except add/edit use generateTreeList()
 * for finding the parents so you see the hierarchy.
 *
 * @author Neil Crookes <neil@crook.es>
 * @link http://www.neilcrookes.com http://neil.crook.es
 * @copyright (c) 2011 Neil Crookes
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php *
 */

//http://webdesign.about.com/od/localization/l/bllanguagecodes.htm
App::uses('Component', 'Controller');

class SitemapComponent extends Component {
	
	/**
	 * 
	 * @param string $controllername
	 * @param array $excludeActions
	 */
	static public function addController($controllername, $excludeActions = array(), $languages = array()) {
		
	}
	
	/**
	 * 
	 * It gets all the records of a model
	 * $allArticles = $modelName->find('all');
	 * The default action to build the url is view
	 * 
	 * @param string $modelName
	 * @param string $controllerName
	 * @param string $action
	 * @param array $languages
	 */
	static public function addModel ($model, $controllerName, $action = 'view', $languages = array()) {
		
	}
	
	/**
	 * Returns the sitemap XML content 
	 * @param boolean $includeHome
	 */
	public function getSitemap($includeHome = true, $languages = array()) {
		
		$urls = array();
		if ($includeHome) {
			$urls[] = Router::url('/', true);
		}
		
		return $urls;
	}
	
}
