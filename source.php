<?php
/******************************************************************************\
    ______  _                                    ____ _____  _  ____  ______
    | ___ \| |                                  / _  | ___ \| |/ __ \/ ____/
    | |  \ \ |          Dmitry Lebedev         / /_| | |  \ \ | /  \ \____ \
    | |__/ / |____      <dl@adios.ru>         / ___  | |__/ / | \__/ /___/ /
    |_____/|_____/                           /_/   |_|_____/|_|\____/_____/

    ------------------------------------------------------------------------

    enum dl\data\Source

    ------------------------------------------------------------------------

    PHP 8.1                                                         (C) 2021

\******************************************************************************/
declare(strict_types=1);
namespace dl\data;

enum Source {
	case mysql;
    case postgresq;
	case sqlite;
/*
	public function config(): string {
		return match($this) {
			self::mysql => __NAMESPACE__.'\\mysql\\Config',
            self::postgresq => __NAMESPACE__.'\\postgresql\\Config',
			self::sqlite => __NAMESPACE__.'\\sqlite\\Config',
		};
	}

	public function connector(): string {
		return match($this) {
			self::mysql => __NAMESPACE__.'\\mysql\\Connector',
            self::postgresq => __NAMESPACE__.'\\postgresql\\Connector',
			self::sqlite => __NAMESPACE__.'\\sqlite\\Connector',
		};
	}

	public function browser(): string {
		return match($this) {
			self::mysql => __NAMESPACE__.'\\mysql\\Browser',
            self::postgresq => __NAMESPACE__.'\\postgresql\\Browser',
			self::sqlite => __NAMESPACE__.'\\sqlite\\Browser',
		};
	}
*/
	public function config(): string {
		return $this->_class('Config');
	}

	public function connector(): string {
		return $this->_class('Connector');
	}

	public function browser(): string {
		return $this->_class('Browser');
	}

	private function _class(string $class): string {
		return __NAMESPACE__.'\\'.$this->name.'\\'.$class;
	}
}