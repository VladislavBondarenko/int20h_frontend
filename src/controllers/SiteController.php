<?php

namespace app\controllers;
use app\components\Server;
use GuzzleHttp\Exception\RequestException;
use phpDocumentor\Reflection\Location;

class SiteController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        $params = require(ROOT . '/config/config.php');
        $server = new Server($params['serverParams']);

        //unset($_SESSION['access_token']);

        $groups = '';
        $authorize_url = '';
        $accessToken = '';
        $userProfile = '';

//        print_r($_REQUEST);
//        print_r($_SESSION);
//        die();

        if (!isset($_SESSION['access_token'])) {
            if (!isset($_REQUEST['code'])) {
                $authorize_url = $server->post('api/auth/auth-vk', [
                    'scope' => 'groups'
                ]);
            } else {
                $accessToken = $server->post('api/auth/auth-vk', [
                    'code' => $_REQUEST['code']
                ]);
                $_SESSION['access_token'] = $accessToken->accessToken;

                $userProfile = $server->get('api/user/get-profile', [
                    'access_token' => $_SESSION['access_token']
                ]);
            }
        } else {
            $userProfile = $server->get('api/user/get-profile', [
                'access_token' => $_SESSION['access_token']
            ]);
        }


//            $groups = $server->get('api/auth/friends', [
//                'access_token' => $_SESSION['access_token']
//            ]);
//        $userProfile = $server->get('api/user/get-profile', [
//            'access_token' => $_SESSION['access_token']
//        ]);
        if (!isset($_SESSION['access_token'])) {
            $news = $server->get('api/news/all');

            $categories = $server->get('api/category/all');

            foreach ($news as $index => $new) {
                $tags = $server->get('api/category/tags', [
                    'category_id' => $new->category_id
                ]);
                $news[$index]->tags = $tags;
            }
        } else {

            $news = $server->get('api/news/all', [
                'access_token' => $_SESSION['access_token']
            ]);

            $categories = $server->get('api/category/all', [
                'access_token' => $_SESSION['access_token']
            ]);

            foreach ($news as $index => $new) {
                $tags = $server->get('api/category/tags', [
                    'category_id' => $new->category_id,
                    'access_token' => $_SESSION['access_token']
                ]);
                $news[$index]->tags = $tags;
            }
        }


        require_once(ROOT . '/src/views/site/index.php');

         return true;
    }

    public function actionLogout() {
        unset($_SESSION['access_token']);
        require_once(ROOT . '/src/views/site/index.php');

        return true;
    }

    public function actionCategory() {

        $params = require(ROOT . '/config/config.php');
        $server = new Server($params['serverParams']);

        $userProfile = $server->get('api/user/get-profile', [
            'access_token' => $_SESSION['access_token']
        ]);

        $categories = $server->get('api/category/all', [
            'access_token' => $_SESSION['access_token']
        ]);

        $news = $server->get('api/news/get-by-category', [
            'category' => $_REQUEST['category'],
            'access_token' => $_SESSION['access_token']
        ]);

        foreach ($news as $index => $new) {
            $tags = $server->get('api/category/tags', [
                'category_id' => $new->category_id,
                'access_token' => $_SESSION['access_token']
            ]);
            $news[$index]->tags = $tags;
        }

        require_once(ROOT . '/src/views/site/category.php');

        return true;
    }

    public function actionNew()
    {
        $params = require(ROOT . '/config/config.php');
        $server = new Server($params['serverParams']);

        $new = $server->get('api/news/view', [
            'id' => $_REQUEST['id'],
            'access_token' => $_SESSION['access_token']
        ]);

        require_once(ROOT . '/src/views/site/new.php');

        return true;
    }

}