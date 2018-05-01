<?php
/**
 * Kenshimdev : Développeur web et administrateur système (https://kenshimdev.fr/)
 * @author        Kenshimdev - https://kenshimdev.fr
 * @copyright     Kenshimdev - All rights reserved
 * @link          http://mineweb.org/market
 * @since         10.03.17
 */

Router::connect('/admin/Changelog', ['controller' => 'Changelog', 'action' => 'index', 'plugin' => 'Changelog', 'admin' => true]);
Router::connect('/admin/Changelog/delete/:id', ['controller' => 'Changelog', 'action' => 'delete', 'plugin' => 'Changelog', 'admin' => true], ['pass' => ['id']], ['id' => '[0-9]+']);
Router::connect('/Changelog', ['controller' => 'Changelog', 'action' => 'index', 'plugin' => 'Changelog']);
