<?php
/******************************************************************************\
    ______  _                                    ____ _____  _  ____  ______
    | ___ \| |                                  / _  | ___ \| |/ __ \/ ____/
    | |  \ \ |          Dmitry Lebedev         / /_| | |  \ \ | /  \ \____ \
    | |__/ / |____      <dl@adios.ru>         / ___  | |__/ / | \__/ /___/ /
    |_____/|_____/                           /_/   |_|_____/|_|\____/_____/

    ------------------------------------------------------------------------

    abstract class dl\data\Browser

    ------------------------------------------------------------------------

    PHP 8.1                                                         (C) 2021

\******************************************************************************/
declare(strict_types=1);
namespace dl\data;

use \dl\Error;

abstract class Browser {
	abstract protected function sqlEscape(string $string): string;

	public function select(Result $result, string $query, array $value): Sample|Error {
		
	}

	public function result(string $query, array $value): string|Error {
		
	}

	public function row(string $query, array $value): array|Error {
		
	}

	public function affect(string $query, array $value): int|Error {
		
	}
}
