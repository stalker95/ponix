<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    // $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
    //     'httpOnly' => true
    // ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    // $routes->applyMiddleware('csrf');

    Router::prefix('admin', function ($routes) {
        // All routes here will be prefixed with `/admin`
        // And have the prefix => admin route element added.
        $routes->fallbacks(DashedRoute::class);
    });
    Router::extensions('csv');


    $routes->connect('/admin/', ['controller' => 'dashboard', 'action' => 'index', 'prefix' => 'admin']);
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Main', 'action' => 'index']);
    $routes->connect('/categories/:param1', array('controller' => 'categories', 'action' => 'view', 'param1'=> '[0-9a-zA-Z]+'));
    //$routes->connect('/categories/:param1', array('controller' => 'categories', 'action' => 'view'));
    $routes->connect('/products/*', array('controller' => 'products', 'action' => 'view'));
    $routes->connect('/actions/*', array('controller' => 'actions', 'action' => 'view'));
    $routes->connect('/actions/index', array('controller' => 'actions', 'action' => 'index'));
    $routes->connect('/categories/', array('controller' => 'categories', 'action' => 'index'));
    $routes->connect('/categories/index', array('controller' => 'categories', 'action' => 'index'));
    $routes->connect('/producers/*', array('controller' => 'producers', 'action' => 'view'));
  //  $routes->connect('/categories/:param1', array('controller' => 'categories', 'action' => 'view'));

   // $routes->connect('/blog/*', array('controller' => 'blog', 'action' => 'view'));

    $routes->connect('/promotions/:param1', array('controller' => 'promotions', 'action' => 'view'));
    $routes->connect('/promotions/index', array('controller' => 'promotions', 'action' => 'index'));
    $routes->connect('/promotions/', array('controller' => 'promotions', 'action' => 'index'));
         $routes->connect('/blog/', array('controller' => 'blog', 'action' => 'index'));

   $routes->connect('/blog/:param1', array('controller' => 'blog', 'action' => 'view'));
   $routes->connect('/blog/search', array('controller' => 'blog', 'action' => 'search'));
   
    $routes->connect('/blog/index', array('controller' => 'blog', 'action' => 'index'));
    $routes->connect('/blog/category/*', array('controller' => 'blog', 'action' => 'category'));

$routes->connect('/compares/:param1', array('controller' => 'compares', 'action' => 'index'));
$routes->connect('/compares/add', array('controller' => 'compares', 'action' => 'add'));
$routes->connect('/compares/remove', array('controller' => 'compares', 'action' => 'remove'));

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
  //  $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});



/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
//Router::connect('/blog/',array('controller'=>'blog','action'=>'index'));
