<?php


namespace kernel\DB;

use PDO;

/**
 * Class DB
 *
 * @package kernel\DB
 */
abstract class DB
{
    private $pdo = null;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->pdo = PDOProvider::getInstance();
    }

    abstract public static function tableName(): string;

    /**
     * @param $query
     *
     * @return bool
     */
    public function query($query): bool
    {
        $sth = $this->pdo->prepare($query);

        return $sth->execute();
    }

    /**
     * @param string $query
     * @param array  $bindParams
     * @param int    $fetchMod
     *
     * @return array
     */
    public function select(string $query, array $bindParams = [], $fetchMod = PDO::FETCH_ASSOC): array
    {
        $sth = $this->pdo->prepare($query);
        foreach ($bindParams as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMod);
    }

    /**
     * @param array $bindParams
     * @param int   $fetchMod
     *
     * @return array
     */
    public function findAll(array $bindParams = [], $fetchMod = PDO::FETCH_ASSOC)
    {
        $sth = $this->find($bindParams);

        $sth->execute();

        return $sth->fetchAll($fetchMod);
    }

    /**
     * @param array $bindParams
     * @param int   $fetchMod
     *
     * @return array
     */
    public function findOne(array $bindParams = [], $fetchMod = PDO::FETCH_ASSOC)
    {
        $sth = $this->find($bindParams);

        $sth->execute();

        return $sth->fetch($fetchMod);
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function insert(array $data): bool
    {
        $fields = implode('`, `', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $query = "INSERT " . static::tableName() . " (`$fields`) VALUES ($values)";
        $sth   = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        return $sth->execute();
    }

    /**
     * @param array  $data
     * @param string $where
     *
     * @return mixed
     */
    public function update(array $data, string $where)
    {
        $fields = array_map(function ($item) {
            return "`$item`=:$item";
        }, array_keys($data));

        $query = "UPDATE " . static::tableName() . " SET " . implode(', ', $fields) . " WHERE $where";

        $sth = $this->pdo->prepare($query);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        return $sth->execute();
    }

    /**
     * @param $where
     *
     * @return int
     */
    public function delete($where)
    {
        $query = "DELETE FROM " . static::tableName() . " WHERE $where";

        return $this->pdo->exec($query);
    }

    /**
     * @return mixed
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * @param array $bindParams
     *
     * @return bool|\PDOStatement
     */
    private function find(array $bindParams = [])
    {
        $params = array_map(function ($item) {
            return $item . " = :" . $item;
        }, array_keys($bindParams));

        $sth = $this->pdo->prepare("SELECT * FROM " . static::tableName() . " WHERE " . implode(" AND ", $params));

        foreach ($bindParams as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        return $sth;
    }
}
