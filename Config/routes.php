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

Router::connect('/sitemap.xml', array('plugin'=>'Sitemapcake2', 'controller' => 'sitemap', 'action' => 'index'));
 
?>