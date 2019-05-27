<?php


namespace app\controllers;


use app\models\CD;
use kernel\Controller;

/**
 * Class IndexController
 *
 * @package app\controllers
 */
class HtmlController extends Controller
{
    public function create()
    {
        return $this->renderJson([
            'data'       => $this->renderFile('forms/form', ['action' => '/create']),
            'modalTitle' => "Создать запись",
            'saveBtn'    => "Создать",
        ]);
    }

    public function edit($id)
    {
        $item = (new CD())->getOne($id);

        return $this->renderJson([
            'data'       => $this->renderFile('forms/form', ['action' => '/edit/' . $id, 'item' => $item]),
            'modalTitle' => "Обновить запись",
            'saveBtn'    => "Обновить"
        ]);
    }
}
