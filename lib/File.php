<?php
    namespace Lib;

    use Lib\File\AbstractFile;
    use Lib\Strategy\IStrategy;
    use Lib\Restriction\AbstractRestriction;

    class File {
        private $_file;
        private $_strategy;

        public function __construct(AbstractFile $file, IStrategy $strategy)
        {
            $this->_file = $file;
            $this->_strategy = $strategy;
        }

        /**
         * Получаем алгоритм, который будем использовать
         *
         * @return IStrategy
         */
        private function getStrategy()
        {
            return $this->_strategy;
        }

        /**
         * Получаем инстанс файла
         *
         * @return AbstractFile
         */
        private function getFile()
        {
            return $this->_file;
        }

        /**
         * Применяем алгоритм для файла
         *
         * @param array $arguments
         * @return array|mixed
         * @throws \Exception
         */
        public function doAlgorithm(array $arguments)
        {
            $contents = $this->getFile()->getContents();

            if (empty($contents)) {
                return $contents;
            }

            $this->getFile()->checkForRestrictions();

            $strategy = $this->getStrategy();

            $strategyMethod = [
                $strategy,
                'do'
            ];

            if (!is_callable($strategyMethod)) {
                throw new \RuntimeException('Strategy method is not callable');
            }

            $strategy->setContents($contents);

            return call_user_func_array($strategyMethod, [$arguments]);
        }
    }