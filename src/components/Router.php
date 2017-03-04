<?php 

namespace app\components;
class Router
{
	private $routes;

    public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

    /**
     * @return string
     */
    private function getURI()
	{
		if(!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
		return '';
	}

    public function run()
	{
		$uri = $this->getURI();
		foreach ($this->routes as $uriPattern => $path) {
			
			if (preg_match("~$uriPattern~",$uri)) {
				$internalRoute = preg_replace("~$uriPattern~",$path,$uri);
				//определить контроллер, action и параметры
				$segments = explode('/',$internalRoute);
				$controllerName = array_shift($segments).'Controller';
				$controllerName = 'app\controllers\\' . ucfirst($controllerName);
				$actionName = 'action'.ucfirst(array_shift($segments));
				$parameters = $segments;
				//$controllerFile = ROOT.'/src/controllers/'.$controllerName.'.php';
//				if (file_exists($controllerFile)) {
//					include_once($controllerFile);
//				}
				
//				$controllerObject = new $controllerName;
                $controllerObject = new $controllerName();
				$result = call_user_func_array(array($controllerObject, $actionName),$parameters);
				if($result != null) {
					break;
				}
				else {
                    header("Location: /");
                }
			}
		}
	}
}