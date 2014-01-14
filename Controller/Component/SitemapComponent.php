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
	private $modelToUse;
	
	/**
	 * 
	 * @param string $controllerName
	 * @param array $excludeActions
	 * @param array $alternateLoc
	 */
	public function addController($controllerName, $excludeActions = array()) {
		
		$excludeActions = array_merge($excludeActions, self::$defaultExcludeActionsControllers);
		
		if ($controllerName == 'Pages') {
			$excludeActions[] = 'display';
		}
		
		App::import('Controller', $controllerName);
		$controllerMethods = get_class_methods($controllerName."Controller");
		
		foreach ($controllerMethods as $key => $action) {
			if (!in_array($action, $excludeActions) ) {
				$url['controller'] = strtolower($controllerName);
				$url['action'] = $action;
				$url['plugin'] = false;
				
				$this->_setUri($url);
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
	public function addModel ($modelName, $controllerName, $action = 'view', $idField = 'id') {
		
		//$model->find("all");
		
		$this->modelToUse = ClassRegistry::init($modelName);
		$results = $this->modelToUse->find("all");
		foreach($results as $result) {
			$this->_setUri("/".$controllerName."/".$action."/".$result[$modelName][$idField]);
		}
		
	}
	
	/**
	 * Returns the sitemap XML content 
	 */
	public function getSitemap($includeHome = true) {
		
		$this->alternateLoc = Configure::read("Sitemapcake2.AlternateLoc");
		
		if ($includeHome) {
			$this->_setUri("/");
		}
		
		$this->_loadControllers();
		$this->_loadModels();
		
		return $this->urls;
	}
	
	private function _loadControllers() {
		$controllers = Configure::read("Sitemapcake2.Controller");
		if ( ($controllers !== null) && is_array($controllers)) {
			foreach ($controllers as $controller) {
				$excludeActions = (isset($controller['excludeActions']) ? $controller['excludeActions'] : array());
		
				$this->addController($controller['name'], $excludeActions);
			}
		}
	}
	
	
	private function _loadModels() {
		$models = Configure::read("Sitemapcake2.Model");
		if ( ($models !== null) && is_array($models)) {
			foreach ($models as $model) {
		
				$view = (isset($model['action']) ? $model['action'] : 'view');
				$idField = (isset($model['idField']) ? $model['idField'] : 'id');
		
				$this->addModel($model['name'], $model['controller'], $view, $idField);
			}
		}
	}
	
	private function _setUri($uri) {
		$key = count($this->urls);
		
		if(isset($this->alternateLoc['altLocs'])) {
			
			if (!isset($this->alternateLoc['position'])) {
				$this->alternateLoc['position'] = "PREPEND";
			}
			
			$keyAltLoc = 0;
			foreach ($this->alternateLoc['altLocs'] as $altLoc) {
			    
				switch ($this->alternateLoc['position']) {
					case "APPEND":
						if ($uri !== "/") {
							$this->urls[$key]['altLoc'][$keyAltLoc]['uri'] = Router::url($uri, true);
						} else {
							$this->urls[$key]['altLoc'][$keyAltLoc]['uri'] = Router::url("/".$altLoc['uri'], true);
						}
						break;
					case "PREPEND":
					default:
						$this->urls[$key]['altLoc'][$keyAltLoc]['uri'] = Router::url("/".$altLoc['uri'].$uri, true);
						break;
				}
				$this->urls[$key]['altLoc'][$keyAltLoc]['hreflang'] = $altLoc['lang'];
				$keyAltLoc++;
			}
		}
		$this->urls[$key]['url']= Router::url($uri, true);
	}
	
}
