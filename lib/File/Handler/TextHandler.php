<?php

    namespace Lib\File\Handler;

    class TextHandler extends AbstractHandler {
        public function handle(string $contents)
        {
            return explode(PHP_EOL, $contents);
        }
    }