<?php
namespace app\controllers;
use app\components\Server;
class SiteController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        echo 'Hello';

        //use app\components\Server;

        $params = require(ROOT . '/config/config.php');

        //$_SESSION['access_token'] = 'ecff8f00b4fd0029c8963bca2fa780f2074c947d8db76bb4009e8e3b0d5cf5f90ae8e8f388dbfe3a5489c';

        //unset($_SESSION['access_token']);

        $server = new Server($params['serverParams']);

        if (!isset($_SESSION['access_token'])) {
            if (!isset($_REQUEST['code'])) {
                $authorize_url = $server->post('api/auth/auth-vk', [
                    'scope' => 'groups'
                ]);
                //    print_r($authorize_url); die;
                echo '<a href="' . $authorize_url->authUri . '">Sign in with VK</a>';
            } else {
                $accessToken = $server->post('api/auth/auth-vk', [
                    'code' => $_REQUEST['code']
                ]);
                $_SESSION['access_token'] = $accessToken->accessToken;

                print_r($accessToken);
            }
        }
        else{
            $user = $server->get('api/auth/friends', [
                'access_token' => $_SESSION['access_token']
            ]);
            print_r($user);
}


        // $categories = Category::getCategoriesList();
        // $latestProducts = Product::getLatestProducts(6);
        // $sliderProducts = Product::getRecommendedProducts();
        // require_once(ROOT . '/views/site/index.php');
         return true;
    }

    /**
     * @return bool
     */
    public function actionContact()
    {
        $userEmail = false;
        $userText = false;
        $result = false;

        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            $errors = false;
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }
            if ($errors == false) {
                $adminEmail = 'php.start@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }

        require_once(ROOT . '/views/site/contact.php');
        return true;
    }

    /**
     * @return bool
     */
    public function actionAbout()
    {
        require_once(ROOT . '/views/site/about.php');
        return true;
    }
}