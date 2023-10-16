<?php
namespace App\Interfaces;

interface CrudInterface
{
	public function getAll(): iterable;

	public function find($idOrKey, $value = null);

	public function tryFind($idOrKey, $value = null);

	public function insert(array $data): int;

	public function update(int $id, array $data): int;

	public function delete(int $id): bool;
}