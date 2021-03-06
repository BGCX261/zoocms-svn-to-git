<?php

/**
 * @package Navigate
 * @subpackage Block
 */

/**
 * @package    Navigate
 * @subpackage Block
 * @copyright  Copyright (c) 2008 ZooCMS
 * @version    1.0
 */
class Navigate_Block_Breadcrumbs extends Zoo_Block_Abstract {

  /**
   * Retrieve node listing
   *
   * @return array
   */
  function getTemplateVars() {
    $menu = null;
    if (Zend_Registry::isRegistered('context')) {
      $menu = Zoo::getService('menu')->getBreadcrumbsFromNode(Zend_Registry::get('context')->node);
    }
    return array('menu' => $menu);
  }

  /**
   * Get cache ID - differs depending on URL
   * @see library/Zoo/Block/Zoo_Block_Abstract#getCacheId()
   */
  function getCacheId() {
    if (Zend_Registry::get('context')->node && Zend_Registry::get('context')->node->id > 0) {
      return parent::getCacheId() . md5(Zend_Controller_Front::getInstance()->getRequest()->getRequestUri());
    }
    return false;
  }

  /**
   * Get cache tags for the block's content
   * @return array
   */
  function getCacheTags() {
    if (Zend_Registry::get('context')->node) {
      return array('node_' . Zend_Registry::get('context')->node->id);
    }
    return parent::getCacheTags();
  }

}