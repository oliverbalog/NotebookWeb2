<?php
namespace App\Models;

use App\Interfaces\CrudInterface;
use App\Interfaces\ModelInterface;
use Database\Sql;
use Exception;
use PDO;

abstract class Model implements ModelInterface, CrudInterface
{
	protected $id = null;
	protected $fillable = [];

	protected static $db = null;

	protected $table = null;

	protected $fetchMode = PDO::FETCH_ASSOC;

	public function __construct()
	{
		if (!$this->table) {
			throw new Exception("A model tábla nincs beállítva!");
		}

		if (static::$db === null) {
			static::$db = Sql::make()
				->setConnection(DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME)
				->makeConnection()
				->getPdo();
		}
	}

	public static function query()
	{
		return (new static);
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function raw(string $query, $fetch = 'fetchAll')
	{
		return $this->db()
					->query($query)
			->{$fetch}($this->fetchMode);
	}


	public function getAll($joins = null): iterable
	{
		$query = "SELECT * FROM {$this->table}";

		if ($joins) {
			$query .= " " . $joins;
		}

		return $this->db()
			->query($query)
			->fetchAll($this->fetchMode);
	}

	public function find($idOrKey, $value = null)
	{
		$key = 'id';

		if (is_int($idOrKey) && !$value) {
			$value = $idOrKey;
		}

		if (is_string($idOrKey) && $value) {
			$key = $idOrKey;
		}

		return $this->db()
			->query("SELECT * FROM {$this->table} WHERE $key = '$value'")
			->fetch($this->fetchMode);
	}

	public function tryFind($idOrKey, $value = null)
	{
		$data = $this->find($idOrKey, $value);

		abort_if(!$data);

		return $data;
	}

	public function insert(array $data): int
	{
		try {
			$marks = array_fill(0, count($data), '?');
			$fields = array_keys($data);
			$this->checkFillableFields($fields);
			$values = array_values($data);


			$stmt = $this->db()
				->prepare("
				INSERT INTO {$this->table} (" . implode(",", $fields) . ")
				VALUES(" . implode(",", $marks) . ")
			");


			$result = $stmt->execute($values);
			echo json_encode($result);

		} catch (Exception $ex) {
			print_r($ex);
		}
		$inserted = $this->db()->lastInsertId();
		return $inserted;
	}

	public function update(int $id, array $data): int
	{
		$this->tryFind($id);

		$set = [];
		$fields = array_keys($data);

		$this->checkFillableFields($fields);

		foreach ($fields as $field) {
			$set[] = "$field = :$field";
		}

		$stmt = $this->db()
			->prepare("
				UPDATE {$this->table} SET " . implode(", ", $set) . "
				WHERE id = '$id'
			");

		$stmt->execute($data);

		return $this->db()->lastInsertId();
	}

	public function delete(int $id): bool
	{
		$this->tryFind($id);

		$stmt = $this->db()
			->prepare("
				DELETE FROM {$this->table}
				WHERE id = '$id'
			");

		return $stmt->execute();
	}

	public function db(): PDO
	{
		return static::$db;
	}

	private function checkFillableFields(array $fields): void
	{
		if (!arrays_equals($this->fillable, $fields)) {
			throw new Exception(
				"A kitölthető mezők nem egyeznek a create/update mezőkkel!"
			);
		}
	}
}