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
	private static $defaultExcludeActionsControllers = array("beforeFilter","__construct","__isset","__get","__set","setRequest","invokeAction","implementedEvents","constructClasses","getEventManager","startupProcess","shutdownProcess","httpCodes","loadModel","redirect","header","set","setAction","validate","validateErrors","render","referer","disableCache","flash","postConditions","paginate","beforeRender","beforeRedirect","afterFilter","beforeScaffold","afterScaffoldSave","afterScaffoldSaveError","scaffoldError","toString","requestAction","dispatchMethod","_stop","log","_set","_mergeVars");
	private $alternateLoc = array();
	
	/**
	 * 
	 * @param string $controllername
	 * @param array $excludeActions
	 * @param array $alternateLoc
	 */
	public function addController($controllername, $excludeActions = array()) {
		
		$excludeActions = array_merge($excludeActions, self::$defaultExcludeActionsControllers);
		$controllername = str_replace('Controller', '', $controllername);
		
		if ($controllername == 'Pages') {
			$excludeActions[] = 'display';
		}
		
		App::import('Controller', $controllername);
		$controllerMethods = get_class_methods($controllername."Controller");
		
		foreach ($controllerMethods as $key => $action) {
			if (!in_array($action, $excludeActions) ) {
				$this->_setUri("/Pages/".$action);
			}
		}
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
	 * @param array $alternateLoc
	 */
	public function addModel ($model, $controllerName, $action = 'view') {
		
	}
	
	/**
	 * Returns the sitemap XML content 
	 */
	public function getSitemap($includeHome = true) {
		
		$this->alternateLoc = Configure::read("Sitemapcake2.AlternateLoc");
		
		if ($includeHome) {
			$this->_setUri("/");
		}
		
		$controllers = Configure::read("Sitemapcake2.Controller");
		if ( ($controllers !== null) && is_array($controllers)) {
			foreach ($controllers as $controller) {
				$this->addController($controller['name']);
			}
		}
		
		return $this->urls;
	}
	
	private function _setUri($uri) {
		$key = count($this->urls);
		
		if(isset($this->alternateLoc['altLocs'])) {
			
			if (!isset($this->alternateLoc['position'])) {
				$this->alternateLoc['position'] = "PREPEND";
			}
			
			foreach ($this->alternateLoc['altLocs'] as $altLoc) {
			
				switch ($this->alternateLoc['position']) {
					case "APPEND":
						if ($uri !== "/") {
							$this->urls[$key]['altLoc'][] = Router::url($uri."/".$altLoc, true);
						} else {
							$this->urls[$key]['altLoc'][] = Router::url("/".$altLoc, true);
						}
						break;
					case "PREPEND":
					default:
						$this->urls[$key]['altLoc'][] = Router::url("/".$altLoc.$uri, true);
						break;
				}
			}
		}
		$this->urls[$key]['url']= Router::url($uri, true);
	}
	
}
