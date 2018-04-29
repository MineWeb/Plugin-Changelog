<?php
/**
 * Kenshimdev : Développeur web et administrateur système (https://kenshimdev.fr/)
 * @author        Kenshimdev - https://kenshimdev.fr
 * @copyright     Kenshimdev - All rights reserved
 * @link          http://mineweb.org/market
 * @since         10.03.17
 */

Router::connect('/admin/ChangeLog', ['controller' => 'Changelog', 'action' => 'index', 'plugin' => 'ChangeLog', 'admin' => true]);
Router::connect('/admin/ChangeLog/delete/:id', ['controller' => 'Changelog', 'action' => 'delete', 'plugin' => 'ChangeLog', 'admin' => true], ['pass' => ['id']], ['id' => '[0-9]+']);
Router::connect('/changelog', ['controller' => 'Changelog', 'action' => 'index', 'plugin' => 'ChangeLog']);