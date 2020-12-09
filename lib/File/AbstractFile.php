<?php

    namespace Lib\File;

    use Lib\Restriction\AbstractRestriction;
    use Lib\File\Handler\AbstractHandler;

    abstract class AbstractFile {
        protected $_path;
        protected $_contents = [];
        protected $_restrictions = [];
        protected $_handler;
        protected $_conditions = [];

        public function __construct(string $filePath, AbstractHandler $handler)
        {
            $this->_path = $filePath;

            $this->_handler = $handler;

            $this->loadContents();
        }

        /**
         * Получаем путь к файлу
         *
         * @return string
         */
        public function getPath()
        {
            return $this->_path;
        }

        /**
         * Сохраняем содержимое файла
         *
         * @param array $contents
         */
        protected function setContents(array $contents)
        {
            $this->_contents = $contents;
        }

        /**
         * Получаем содержимое файла
         *
         * @return array
         */
        public function getContents()
        {
            return $this->_contents;
        }

        /**
         * Получаем обработчик текста
         *
         * @return AbstractHandler
         */
        public function getHandler()
        {
            return $this->_handler;
        }

        /**
         * Сохраняем условия для последующей проверки на ограничения
         *
         * @param array $conditions
         */
        public function setConditions(array $conditions)
        {
            $this->_conditions = $conditions;
        }

        /**
         * Добавляем ограничение
         *
         * @param AbstractRestriction $restriction
         */
        public function addRestriction(AbstractRestriction $restriction)
        {
            $this->_restrictions[$restriction->getType()] = $restriction;
        }

        /**
         * Получаем все сохраненные ограничения
         *
         * @return array
         */
        public function getRestrictions()
        {
            return $this->_restrictions;
        }

        /**
         * Проверяем файл на ограничения
         *
         * @throws \Exception
         */
        public function checkForRestrictions()
        {
            $conditions = $this->_conditions;
            $restrictions = $this->getRestrictions();

            if (!empty($conditions) && !empty($restrictions)) {
                foreach ($conditions as $conditionName => $conditionValue) {
                    if (!($restriction = $restrictions[$conditionName] ?? false)) {
                        throw new \Exception("Didn't find restriction handler for restriction " . $conditionName);
                    }

                    $restriction->validate($this, $conditionValue);
                }
            }
        }

        /**
         * Функция для подгрузки содержимого файла
         *
         * @return mixed
         */
        abstract protected function loadContents();
    }