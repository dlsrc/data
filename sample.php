<?php
/******************************************************************************\
    ______  _                                    ____ _____  _  ____  ______
    | ___ \| |                                  / _  | ___ \| |/ __ \/ ____/
    | |  \ \ |          Dmitry Lebedev         / /_| | |  \ \ | /  \ \____ \
    | |__/ / |____      <dl@adios.ru>         / ___  | |__/ / | \__/ /___/ /
    |_____/|_____/                           /_/   |_|_____/|_|\____/_____/

    ------------------------------------------------------------------------

    abstract class dl\data\Sample

    ------------------------------------------------------------------------

    PHP 8.1                                                         (C) 2021

\******************************************************************************/
declare(strict_types=1);
namespace dl\data;

use \dl\Error;

abstract class Sample implements \Iterator {
	private int $cursor;
	private array $field;
	private int|string $key;
	protected array $result;
	protected bool $assoc;

	public function __construct() {
		$this->cursor = 0;
		$this->field = [];
		$this->key = 0;
		$this->result = [];
		$this->assoc = false;
	}

	public function add(array $row): void {
		foreach ($row as $key => $value) {
			$this->result[$key][] = $value;
		}
	}

/*
	public function __construct(array $fields) {
		$this->cursor = 0;
		$this->field = [];

		if (empty($field)) {
			$this->result = [];
			$this->key = 0;
			$this->assoc = false;
		}
		else {
			foreach ($field as $name) {
				$this->result[$name] = [];
			}

			$this->key = \array_key_first($this->result);
			$this->assoc = true;
		}
	}

	public function add(array $row): void {
		if ($this->assoc) {
			foreach ($row as $name => $value) {
				if (isset($this->result[$name])) {
					$this->result[$name][] = $value;
				}
			}
		}
		else {
			foreach ($row as $key => $value) {
				$this->result[$key][] = $value;
			}
		}
	}
*/
	public function asKey(int|string $field): void {
		if (isset($this->result[$field])) {
			$this->key = $field;
		}
	}

	public function current(): mixed {
		$row = [];

		foreach ($this->field as $name) {
			$row[$name] = $this->result[$name][$this->cursor];
		}

		return $row;
	}

	public function key(): mixed {
		return $this->result[$this->key][$this->cursor];
	}

	public function next(): void {
		++$this->cursor;
	}

	public function rewind(): void {
		$this->cursor = 0;

		if (empty($this->field)) {
			$this->field = \array_keys($this->result);
		}
	}

	public function valid(): bool {
		return isset($this->result[$this->key][$this->cursor]);
	}

	public function unique(int|string $field): array|Error {
		return $this->errorField($field) ?? \array_unique($this->result[$field]);
	}

	public function column(int|string $field): array|Error {
		return $this->errorField($field) ?? $this->result[$field];
	}

	public function combine(int|string $field1, int|string $field2): array|Error {
		return $this->errorField($field1) ??
		       $this->errorField($field2) ??
			   \array_combine($this->result[$field1], $this->result[$field2]);
	}

	public function slice(int|string $field, float|int|string|null $value): array|Error {
		if ($e = $this->errorField($field)) {
			return $e;
		}

		$keys = \array_keys(\array_intersect($this->result[$field], [$value]));

		if (empty($keys)) {
			return [];
		}

		$fields = \array_keys($this->result);
		$slice  = [];

		foreach ($keys as $key) {
			foreach ($fields as $name) {
				$slice[$key][$name] = $this->result[$name][$key];
			}
		}

		return $slice;
	}

	private function errorField(string $field): Error|null {
		if (isset($this->result[$field])) {
			return null;
		}

		return Error::log(
			'Запрос данных из несуществующеей колонки `'.$field.'` в текущей '.
			'выборке [`'.\implode('`, `', \array_keys($this->result)).'`].',
			\dl\Code::Range
		);
	}
}