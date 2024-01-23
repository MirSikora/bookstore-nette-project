<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('<presenter>/<action>[/<id>]', 'Home:default');
		$router->addRoute('Cart:default', 'Cart:default');
		$router->addRoute('Cart:delete', 'Cart:delete');		
		$router->addRoute('Delivery/<id>', 'Delivery:default/<id>');
		$router->addRoute('Payment/<id>', 'Payment:default/<id>');		
		return $router;
	}
}
