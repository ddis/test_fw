<?php


namespace app\controllers;


use app\models\CD;
use kernel\Controller;

/**
 * Class IndexController
 *
 * @package app\controllers
 */
class IndexController extends Controller
{
    public function index()
    {
        $items = (new CD)->getAll();

        return $this->render('index/index', ['items' => $items]);
    }
}
