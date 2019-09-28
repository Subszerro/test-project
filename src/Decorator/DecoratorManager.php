<?php

namespace src\Decorator;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use src\Integration\DataProvider;

/**
 * Реализация получения данных из REST-API стороннего сервиса
 * 
 * @author Dmitry Evtushenko
 * @version 1.0, 27.09.2019
 * @package ExternalServiceProvider
 */
class DecoratorManager extends DataProvider
{
	/** @var CacheItemPoolInterface|null Реализация кеширования */
	private $cache;

	/** @var LoggerInterface|null Реализация логирования */
	private $logger;

	/**
	 * Конструктор класса DecoratorManager
	 * 
	 * @author Dmitry Evtushenko
	 * @version 1.0, 27.09.2019
	 * 
	 * @param string $host Хост внешнего API
	 * @param string $user Логин для авторизации
	 * @param string $password Пароль для авторизации
	 * @param CacheItemPoolInterface $cache Реализация класса для кеширования
	 * 
	 * @return void
	 */
	public function __construct(string $host, string $user, string $password, CacheItemPoolInterface $cache)
	{
		parent::__construct($host, $user, $password);
		$this->cache = $cache;
	}

	/**
	 * Определяем реализацию логирования
	 * 
	 * @author Dmitry Evtushenko
	 * @version 1.0, 27.09.2019
	 * 
	 * @param LoggerInterface $logger Реализация класса для логирования ошибок
	 * 
	 * @return void
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Получить данные из REST-API стороннего сервиса или из кеша
	 * 
	 * @author Dmitry Evtushenko
	 * @version 1.0, 27.09.2019
	 * 
	 * @param array $input Исходные данные запроса
	 * 
	 * @return string Ответ от стороннего сервиса или закешированный ответ
	 */
	public function getResponse(array $input)
	{
		try {
			$cacheKey = $this->getCacheKey($input);
			$cacheItem = $this->cache->getItem($cacheKey);

			if ($cacheItem->isHit()) {
				return $cacheItem->get();
			}

			$result = parent::get($input);

			if ($result) {
				$currentTime = new DateTime();
				$futureTime = (new DateTime())->modify('+1 day');
				$ttl = $currentTime->diff($futureTime);

				$cacheItem
					->set($result)
					->expiresAt($ttl);
			}

			return $result;
		} catch (Exception $e) {
			if ($this->logger instanceof LoggerInterface) {
				$this->logger->critical('Error requesting to third-party API: ' . $e->getMessage(), $input);
			}
		}

		return [];
	}

	/**
	 * Вернуть ключ для кеширования запроса к REST-API
	 * 
	 * @author Dmitry Evtushenko
	 * @version 1.0, 27.09.2019
	 * 
	 * @param array $input Исходные данные запроса
	 * 
	 * @return string Исходные данные запроса в формате JSON
	 */
	public function getCacheKey(array $input) : string
	{
		return json_encode($input);
	}
}
