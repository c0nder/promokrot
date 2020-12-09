<?php

    namespace Lib\Strategy;

    abstract class IStrategy {
        protected $_contents;

        /**
         * Сохраняем контент файла, с которым будет работать алгоритм
         *
         * @param array $contents
         */
        public function setContents(array $contents)
        {
            $this->_contents = $contents;
        }

        /**
         * Получаем контент, с которым будет работать файл
         *
         * @return mixed
         */
        public function getContents()
        {
            return $this->_contents;
        }

        /**
         * Функция для выполнения алгоритма
         *
         * @param array $args
         * @return mixed
         */
        abstract public function do(array $args);
    }