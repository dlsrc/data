<?php
/******************************************************************************\
    ______  _                                    ____ _____  _  ____  ______
    | ___ \| |                                  / _  | ___ \| |/ __ \/ ____/
    | |  \ \ |          Dmitry Lebedev         / /_| | |  \ \ | /  \ \____ \
    | |__/ / |____      <dl@adios.ru>         / ___  | |__/ / | \__/ /___/ /
    |_____/|_____/                           /_/   |_|_____/|_|\____/_____/

    ------------------------------------------------------------------------

    abstract class dl\data\Config

    ------------------------------------------------------------------------

    PHP 8.1                                                         (C) 2021

\******************************************************************************/
declare(strict_types=1);
namespace dl\data;

abstract class Config implements \dl\Mutable, \dl\Named {
	use \dl\ContainerName;
	use \dl\NamedContainerGetter;
	use \dl\PropertySetter;

	protected function __construct(array $state = [], string $name = '') {
		if ('' == $name) {
			$this->_name = \get_class($this);
		}
		else {
			$this->_name = $name;
		}

		$this->initialize();
	}
}
