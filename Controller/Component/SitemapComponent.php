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
