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

            $temp = explode('?',$uri);


            $uri = $temp[0];
            if (!empty($temp[1])) {
                $strParams = $temp[1];
            }

            //$uri = trim($uri, '?');

//            echo '<br>qp '; print_r($queryParams);
			if (preg_match("~$uriPattern~",$uri)) {
                if (empty($strParams)) {
                    $strParams = '';
                }
                $params = explode('&',$strParams);

                $queryParams = array();
                foreach ($params as $value) {
                    if ($value==''){
                        continue;
                    }
                    $map = explode('=', $value);
                    $queryParams[$map[0]] = $map[1];
                }


				$internalRoute = preg_replace("~$uriPattern~",$path,$uri);
				//определить контроллер, action и параметры
				$segments = explode('/',$internalRoute);
//				print_r($segments); die;
				$controllerName = array_shift($segments).'Controller';
				$controllerName = 'app\controllers\\' . ucfirst($controllerName);
				$actionName = 'action'.ucfirst(array_shift($segments));
				//$parameters = $segments;
				//$controllerFile = ROOT.'/src/controllers/'.$controllerName.'.php';
//				if (file_exists($controllerFile)) {
//					include_once($controllerFile);
//				}

                //echo '<br>p '; print_r($parameters);
 //               die();
				
//				$controllerObject = new $controllerName;
                $controllerObject = new $controllerName();

//                echo '<br>$controllerObject '; print_r($controllerObject);
//                echo '<br>$actionName '; print_r($actionName);
//                echo '<br>$queryParams '; print_r($queryParams);
//                die();

				$result = call_user_func_array(array($controllerObject, $actionName),$queryParams);
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