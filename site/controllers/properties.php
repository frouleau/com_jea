<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     $Id$
 * @package     Joomla.Site
 * @subpackage  com_jea
 * @copyright   Copyright (C) 2008 - 2012 PHILIP Sylvain. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');

/**
 * Properties controller class.
 *
 * @package     Joomla.Site
 * @subpackage  com_jea
 */
class JeaControllerProperties extends JController
{

    public function search()
    {
        $app = JFactory::getApplication();
        $app->input->set('layout', 'default');
        $this->display();
    }

}
