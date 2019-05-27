<?php


namespace app\models;


use kernel\Model;

class Artist extends Model
{

    public static function tableName(): string
    {
        return 'artists';
    }

    static function saveFields(): array
    {
        return [
            'name',
        ];
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function findOrCreate(string $name): array
    {
        $result = $this->findOne(['name' => $name]);

        if (!$result && $this->insert(['name' => $name])) {
            $result = [
                'name' => $name,
                'id' => $this->lastInsertId()
            ];
        }

        return $result;
    }
}
