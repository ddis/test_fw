<?php


namespace kernel;


use kernel\DB\DB;

abstract class Model extends DB
{
    abstract static function saveFields(): array;

    public function filterData(array $data)
    {
        $keys = array_filter(array_keys($data), function ($item) {
            return in_array($item, static::saveFields());
        });

        return array_intersect_key($data, array_flip($keys));

    }
}
