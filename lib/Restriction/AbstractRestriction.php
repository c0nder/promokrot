<?php

    namespace Lib\Restriction;

    use Lib\File\AbstractFile;

    abstract class AbstractRestriction {
        /**
         * Получаем тип, который будет проверяться в ограничении
         * @return string
         */
        abstract function getType(): string;

        /**
         * Проверяем файл на соответствие ограничению
         *
         * @param AbstractFile $file
         * @param $value
         * @return mixed
         */
        abstract public function validate(AbstractFile $file, $value);
    }