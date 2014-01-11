<?php
/**
 * SitemapComponent Controller
 *
 * Pretty much just baked admin actions except add/edit use generateTreeList()
 * for finding the parents so you see the hierarchy.
 *
 * @author Juan Gimenez <neojoda@gmail.com>
 * @link http://www.montcat.org/portfolio
 * @copyright (c) 2014 Juan Gimenez
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php *
 */

//http://webdesign.about.com/od/localization/l/bllanguagecodes.htm
App::uses('Component', 'Controller');

class SitemapComponent extends Component {
	
	private $urls = array();
	
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
		
		
		if ($includeHome) {
			$this->urls[] = Router::url('/', true);
		}
		
		$controllers = Configure::read("Sitemapcake2.Controller");
		if ( ($controllers !== null) && is_array($controllers)) {
			foreach ($controllers as $controller) {
				$this->addController($controller['name']);
			}
		}
		
		return $this->urls;
	}
	
}
