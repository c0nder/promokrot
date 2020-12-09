<?php

    namespace Lib\File\Handler;

    use Symfony\Component\Yaml\Yaml;

    class YamlHandler extends AbstractHandler {
        public function handle(string $contents)
        {
            return Yaml::parse($contents);
        }
    }