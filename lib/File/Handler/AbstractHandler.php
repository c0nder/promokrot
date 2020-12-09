<?php

    namespace Lib\File\Handler;

    abstract class AbstractHandler {
        abstract public function handle(string $contents);
    }