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

class SitemapController extends AppController {

	public $components = array('Sitemapcake2.Sitemap');
	
    public function index() {
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
    
}

?>