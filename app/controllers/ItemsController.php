<?php


namespace app\controllers;


use app\models\CD;
use DateTime;
use kernel\Controller;
use kernel\ValidationData;

class ItemsController extends Controller
{
    public function create()
    {
        $validator = $this->validate();

        if ($validator->hasErrors()) {
            return $this->renderJson([
                "status" => "validate_error",
                "errors" => $validator->getMessages(),
            ]);
        }

        $data = $validator->getData();

        $myDateTime       = DateTime::createFromFormat('d.m.Y', $data['buy_date']);
        $data['buy_date'] = $myDateTime->format('Y-m-d');

        $model = new CD();

        if ($model->save($data)) {
            return $this->renderJson([
                'status' => 'ok',
            ]);
        }

        return $this->renderJson([
            'status' => 'error',
        ]);
    }

    public function edit($id)
    {
        $validator = $this->validate();

        if ($validator->hasErrors()) {
            return $this->renderJson([
                "status" => "validate_error",
                "errors" => $validator->getMessages(),
            ]);
        }

        $data = $validator->getData();

        $myDateTime       = DateTime::createFromFormat('d.m.Y', $data['buy_date']);
        $data['buy_date'] = $myDateTime->format('Y-m-d');

        $model = new CD();

        if ($model->edit($data, $id)) {
            return $this->renderJson([
                'status' => 'ok',
            ]);
        }

        return $this->renderJson([
            'status' => 'error',
        ]);
    }

    public function delete($id)
    {
        return $this->renderJson([
            'status' => (new CD())->delete("id = {$id}") ? "ok" : "fail",
        ]);
    }

    private function validate(): ValidationData
    {
        $validator = new ValidationData();

        $validator->setData(array_merge($_POST))
                  ->addRules([
                      [['album_name', 'artist_name', 'year_of_issue', 'durations', 'buy_date', 'price', 'position'], ValidationData::VALIDATE_REQUIRED, "message" => "Поле обязательное для заполнения"],
                      [['year_of_issue', 'durations'], ValidationData::VALIDATE_INTEGER, "message" => "Значение должно быть целым числом"],
                      [['price'], ValidationData::VALIDATE_FLOAT, "message" => "Неправильный формат цены"],
                      [['position'], ValidationData::VALIDATE_REGEXP, "pattern" => "/^[\d]+:[\d]+:[\d]+$/", "message" => "Неправельный формат (номер комнаты : номер стойки : номер полки)"],
                  ])
                  ->validate();

        return $validator;
    }
}
