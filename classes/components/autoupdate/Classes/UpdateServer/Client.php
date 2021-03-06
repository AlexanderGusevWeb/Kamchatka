<?php

	namespace UmiCms\Classes\Components\AutoUpdate\UpdateServer;

	use UmiCms\Classes\System\Utils\Api\Http\Xml\Client as HttpClient;
	use Guzzle\Http\Message\RequestInterface;
	use UmiCms\System\Request\Http\iRequest;
	use UmiCms\Classes\Components\AutoUpdate\iRegistry;
	use UmiCms\System\Registry\iSettings;
	use UmiCms\Classes\System\Entities\Date\iFactory;
	use UmiCms\System\Cache\iEngineFactory;

	/**
	 * Класс клиента сервера обновлений
	 * @package UmiCms\Classes\Components\AutoUpdate\UpdateServer
	 */
	class Client extends HttpClient implements iClient {

		/** @var iRequest $request http запрос */
		private $request;

		/** @var iRegistry $registry реестр модуля "Автообновления" */
		private $registry;

		/** @var iSettings $settings реестр общих настроек системы */
		private $settings;

		/** @var iFactory $dateFactory фабрика дат */
		private $dateFactory;

		/** @var \iCacheEngine $cacheEngine хранилище кеша */
		private $cacheEngine;

		/** @inheritdoc */
		public function __construct(
			iRequest $request, iRegistry $registry, iSettings $settings, iFactory $dateFactory,
			iEngineFactory $engineFactory
		) {
			$this->request = $request;
			$this->registry = $registry;
			$this->settings = $settings;
			$this->dateFactory = $dateFactory;
			$this->cacheEngine = $engineFactory->create();
			$this->initHttpClient();
		}

		/** @inheritdoc */
		public function getLastRevision() {
			$request = $this->createGetRequest([], [
				'type' => 'get-last-version'
			]);

			/** @var \SimpleXMLElement $response */
			$response = $this->getResponse($request);

			if (!$response instanceof \SimpleXMLElement) {
				throw new \RuntimeException('Incorrect response given', 1);
			}

			$revisionList = $response->xpath('/modules/system/revision');
			$revision = getFirstValue($revisionList);

			if (!$revision instanceof \SimpleXMLElement) {
				throw new \RuntimeException('Incorrect response given', 2);
			}

			return (int) $revision->__toString();
		}

		/** @inheritdoc */
		public function getAvailableModuleList() {
			$moduleList = [];

			foreach ($this->getAvailableComponentList() as $component) {
				if ($component['is_extension']) {
					continue;
				}

				$moduleList[$component['name']] = trim($component['label']);
			}

			return $moduleList;
		}

		/** @inheritdoc */
		public function getAvailableExtensionList() {
			$extensionList = [];

			foreach ($this->getAvailableComponentList() as $component) {
				if (!$component['is_extension']) {
					continue;
				}

				$extensionList[$component['name']] = trim($component['label']);
			}

			return $extensionList;
		}

		/** @inheritdoc */
		public function getSupportEndTime() {
			$supportTimeList = $this->getUpdateInstruction()
				->xpath('/package/@support_time');

			if (empty($supportTimeList)) {
				throw new \RuntimeException('Incorrect response given', 5);
			}

			/** @var \SimpleXMLElement $supportTime */
			$supportTime = getFirstValue($supportTimeList);

			return $this->getDateFactory()
				->createByDateString($supportTime->__toString());
		}

		/** @inheritdoc */
		public function getIllegalModuleList() {
			$moduleList = [];

			foreach ($this->getAllComponents()->xpath('/modules/module') as $component) {
				$attributeList = $component->attributes();

				if ((string) $attributeList->active === '1' || (string) $attributeList->is_extension === '1') {
					continue;
				}

				$moduleList[] = (string) $component->attributes()->name;
			}

			return $moduleList;
		}

		/** @inheritdoc */
		public function getIllegalExtensionList() {
			$extensionList = [];

			foreach ($this->getAllComponents()->xpath('/modules/module') as $component) {
				$attributeList = $component->attributes();

				if ((string) $attributeList->active === '1' || (string) $attributeList->is_extension === '0') {
					continue;
				}

				$extensionList[] = (string) $component->attributes()->name;
			}

			return $extensionList;
		}

		/** @inheritdoc */
		public function getComponentFileList($name) {
			$currentRevision = $this->getRegistry()
				->getRevision();
			$key = sprintf('component-%s-file-list-at-revision-%d', $name, $currentRevision);
			$cacheEngine = $this->getCacheEngine();
			$fileList = $cacheEngine->loadRawData($key);

			if (is_array($fileList) && !empty($fileList)) {
				return $fileList;
			}

			$request = $this->createRequest('get-component-file-list', [
				'component' => $name
			]);

			$fileList = [];

			foreach ($this->sendRequest($request)->xpath('/files/file') as $file) {
				$attributeList = $file->attributes();
				$hash = (string) $attributeList->hash;
				$path = (string) $attributeList->path;
				$fileList[$hash] = $path;
			}

			$cacheEngine->saveRawData($key, $fileList, 60 * 60 * 24 * 30);
			return $fileList;
		}

		/** @inheritdoc */
		protected function getPrefix() {
			return 'updateserver';
		}

		/** @inheritdoc */
		protected function getServiceUrl() {
			return $this->buildPath([
				base64_decode('aHR0cHM6Ly91cGRhdGVzLnVtaS1jbXMucnUv')
			]);
		}

		/**
		 * Возвращает список компонентов, доступных для установки
		 * @return array
		 *
		 * [
		 *      'name' => 'Строковый идентификатор',
		 *      'label' => 'Наименование',
		 *      'is_extension' => 'Является ли компонент расширением'
		 * ]
		 *
		 * @throws \RuntimeException
		 */
		private function getAvailableComponentList() {
			$componentList = [];

			/** @var \SimpleXMLElement $component */
			foreach ($this->getUpdateInstruction()->xpath('/package/component') as $component) {
				$attributeList = $component->attributes();
				$name = (string) $attributeList->name;

				if ($name == 'core') {
					continue;
				}

				$componentList[$name] = [
					'name' => $name,
					'label' => (string) $attributeList->label,
					'is_extension' => (string) $attributeList->is_extension,
				];
			}

			return $componentList;
		}

		/**
		 * Возвращает инструкции для обновления системы
		 * @return \SimpleXMLElement
		 *
		 * <package branch="dev" last-revision="84559" client-revision="80839" generated="1519053972"
		 *      domain_key="FOOOOOOOOO-BAAAAAAAAAR-BAAAAAAAAAZ"
		 *      ip="127.0.0.1"
		 *      host="foo.bar"
		 *      edition="commerce"
		 *      support_time="2019-11-12 18:02:00"
		 *      owner_fname="Foo"
		 *      owner_lname="Bar"
		 *      owner_mname="Baz"
		 *      owner_email="foo@bar.baz"
		 * >
		 *      <component name="menu" label="Меню" filesize="204800" is_extension="0">
		 *          <version name="dev" date="1518788525" revision="84559"/>
		 *      </component>
		 * </package>
		 *
		 * @throws \RuntimeException
		 */
		private function getUpdateInstruction() {
			$request = $this->createRequest('get-update-instructions');
			return $this->sendRequest($request);
		}

		/**
		 * Возвращает список всех компонентов (модулей и расширений)
		 * @return \SimpleXMLElement
		 *
		 * <modules>
		 *      <module name="photoalbum" active="1" is_extension="0"/>
		 *      <module name="icecorefiles" is_extension="1"/>
		 * </modules>
		 *
		 * @throws \RuntimeException
		 */
		private function getAllComponents() {
			$request = $this->createRequest('get-modules-list');
			return $this->sendRequest($request);
		}

		/**
		 * Создает запрос к серверу обновлений
		 * @param string $type тип запроса
		 * @param array $data дополнительные параметры
		 * @return RequestInterface
		 */
		private function createRequest($type, $data = []) {
			$license = $this->getSettings()
				->getLicense();
			$revision = $this->getRegistry()
				->getRevision();
			$request = $this->getRequest();
			return $this->createGetRequest([], [
				'type' => $type,
				'key' =>  $license,
				'revision' => $revision,
				'ip' => $request->serverAddress(),
				'host' => $request->host()
			] + $data);
		}

		/**
		 * Отправляет запрос к серверну обновлений и возвращает ответ
		 * @param RequestInterface $request запрос
		 * @return \SimpleXMLElement
		 */
		private function sendRequest(RequestInterface $request) {
			/** @var \SimpleXMLElement $response */
			$response = $this->getResponse($request);

			if (!$response instanceof \SimpleXMLElement) {
				throw new \RuntimeException('Incorrect response given', 3);
			}

			$errorList = $response->xpath('/response/error');

			if (!empty($errorList)) {
				/** @var \SimpleXMLElement $error */
				$error = getFirstValue($errorList);
				throw new \RuntimeException($error->__toString(), 4);
			}

			return $response;
		}

		/**
		 * Возвращает http запрос
		 * @return iRequest
		 */
		private function getRequest() {
			return $this->request;
		}

		/**
		 * Возвращает реестр модуля "Автообновления"
		 * @return iRegistry
		 */
		private function getRegistry() {
			return $this->registry;
		}

		/**
		 * Возвращает реестр общих настроек системы
		 * @return iSettings
		 */
		private function getSettings() {
			return $this->settings;
		}

		/**
		 * Возвращает фабрику дат
		 * @return iFactory
		 */
		private function getDateFactory() {
			return $this->dateFactory;
		}

		/**
		 * Возвращает хранилище кеша
		 * @return \iCacheEngine
		 */
		private function getCacheEngine() {
			return $this->cacheEngine;
		}
	}