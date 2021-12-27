<?php
/******************************************************************************\
    ______  _                                    ____ _____  _  ____  ______
    | ___ \| |                                  / _  | ___ \| |/ __ \/ ____/
    | |  \ \ |          Dmitry Lebedev         / /_| | |  \ \ | /  \ \____ \
    | |__/ / |____      <dl@adios.ru>         / ___  | |__/ / | \__/ /___/ /
    |_____/|_____/                           /_/   |_|_____/|_|\____/_____/

    ------------------------------------------------------------------------

    enum dl\data\Code

    ------------------------------------------------------------------------

    PHP 8.1                                                         (C) 2021

\******************************************************************************/
declare(strict_types=1);
namespace dl\data;

enum Code: int implements \dl\ErrorCodifier {
	// VALUE RANGE 300 - 349
	case Query   = 300; // Ошибка в SQL запросе.
	case Type    = 301; // В строке подключения отсутствует информация о типе источника данных.
	case Dsn     = 302; // Тип источника данных не известен, либо в данной версии не поддерживается.
	case Cs      = 303; // Строка подключения содержит ошибки. Опция не входит в список допустимых параметров подключения к источнику данных.
	case Ext     = 304; // Расширение не доступно. Необходимо скомпилировать PHP с поддержкой этого расширения, либо подключить его в файле 'php.ini'.
	case Connect = 305; // Интерфейс подключения к источнику данных, соответствующий конфигурации, не доступен в данной версии системы.
	case Link    = 306; // Ошибка подключения к источнику данных.
	case Create  = 307; // Коннектор с идентификатором не существует и попытка его создания не предпринималась.
	case State   = 308; // Подключение к источнику данных выполнено, но поставщик данных не смог выполнить настройку, использовать соединение невозможно.
	case Combine = 309; // Комбинация полей для результата запроса невозможна, поля не содержаться в строке запроса
	case Column  = 310; // Невозможно вернуть результат запроса, поле, ассоциированное с результирующими строками, отсутствует в строке запроса.
	case Browser = 311; // Невозможно создать объект доступа к данным с интерфейсом ISQLBrowser. Поставщик данных соответствующий конфигурации отсутствует в системе.
	case Trans   = 312; // Невозможно создать объект доступа к данным с интерфейсом ISQLTransact. Поставщик данных соответствующий конфигурации отсутствует в системе.
	case Cache   = 313; // Невозможно создать объект доступа к данным с интерфейсом IDataCache. Поставщик данных соответствующий конфигурации отсутствует в системе.
	case Down    = 314; // Источник данных не работает по указанному адресу
	case Tcp     = 315; // Нет сетевого соединения с источником данных

	public function isFatal(): bool {
		return false;
	}
}