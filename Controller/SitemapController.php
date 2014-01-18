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

class SitemapController extends AppController {

	public $components = array('Sitemapcake2.Sitemap');
	
    public function index() {
    	
    	$this->_checkConfiguration();
    	
		Configure::write ('debug', 2);
		$this->layout = 'Sitemapcake2.xml/default';
		$this->set('xsdurl', Router::url("/Sitemapcake2/schema/sitemap.xsd", true));
		
		
		$options = Configure::read('Sitemapcake2.options');
		$includeHome = true;
		if (isset($options['includeHome'])) {
			if (is_bool($options['includeHome'])) {
				$includeHome = $options['includeHome'];
			}
		}
		
		$this->set('urls', $this->Sitemap->getSitemap($includeHome));
		$this->response->type('xml');
    }
    
    private function _checkConfiguration() {
    	
    	$alternateLocs = Configure::read('Sitemapcake2.AlternateLoc');
    	if (!is_array($alternateLocs)) {
    		throw new CakeException("Sitemapcake2.options must be an array");
    	}
    	
    	if(!empty($alternateLocs)) {
    		foreach ($alternateLocs['altLocs'] as $locs) {
    			if(!isset($locs['lang'])) {
    				throw new CakeException("Sitemapcake2.AlternateLoc needs to have define the lang option for every case");
    			}
    		}
    	}
    	
    }
    
}

?>