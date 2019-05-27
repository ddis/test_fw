<?php


namespace app\models;

use kernel\Model;

class CD extends Model
{
    public static function saveFields(): array
    {
        return [
            'album_name',
            'artist_id',
            'year_of_issue',
            'durations',
            'buy_date',
            'price',
            'position_room',
            'position_rack',
            'position_shelf',
        ];
    }

    public static function tableName(): string
    {
        return "cd";
    }

    public function getAll()
    {
        return $this->select("SELECT *, cd.id as id FROM cd as cd INNER JOIN artists as a ON a.id = cd.artist_id");
    }

    public function getOne($id)
    {
        return $this->select("SELECT *, cd.id as id FROM cd as cd INNER JOIN artists as a ON a.id = cd.artist_id", ['cd.id' => $id])[0] ?? [];
    }

    public function save(array $data): bool
    {
        $data = $this->filterData($this->prepare($data));

        return $this->insert($data);
    }

    public function edit(array $data, int $id)
    {
        $data = $this->filterData($this->prepare($data));

        return $this->update($data, "id={$id}");
    }

    private function prepare($data)
    {
        $position = explode(':', $data['position']);

        $data['position_room']  = $position[0];
        $data['position_rack']  = $position[1];
        $data['position_shelf'] = $position[2];

        $data['price'] = $data['price'] * 100;

        $data['artist_id'] = (new Artist)->findOrCreate($data['artist_name'])['id'] ?? null;

        return $data;
    }
}
