<?php

namespace src\Integration;

/**
 * Базовый класс для получения данных из REST-API стороннего сервиса
 * 
 * @author Dmitry Evtushenko
 * @version 1.0, 27.09.2019
 * @package ExternalServiceProvider
 */
class DataProvider
{
	/** @var string Хост внешнего API */
	private $host;

	/** @var string Логин для авторизации */
	private $user;

	/** @var string Пароль для авторизации */
	private $password;

	/**
	 * Конструктор класса DataProvider
	 * 
	 * @author Dmitry Evtushenko
	 * @version 1.0, 27.09.2019
	 * 
	 * @param string $host Хост внешнего API
	 * @param string $user Логин для авторизации
	 * @param string $password Пароль для авторизации
	 * 
	 * @return void
	 */
	public function __construct(string $host, string $user, string $password)
	{
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
	}

	/**
	 * Выполнение запроса и получение ответа от стороннего сервиса
	 * 
	 * @author Dmitry Evtushenko
	 * @version 1.0, 27.09.2019
	 * 
	 * @param array $request Исходные данные запроса
	 *
	 * @return array
	 */
	public function get(array $request) : array
	{
		// returns a response from external service
	}
}
