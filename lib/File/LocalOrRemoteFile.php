<?php

    namespace Lib\File;

    class LocalOrRemoteFile extends AbstractFile {
        protected function loadContents()
        {
            $fileContents = file_get_contents($this->getPath());

            if ($fileContents === false) {
                throw new \RuntimeException('File not found');
            }

            $this->setContents($this->getHandler()->handle($fileContents));
        }
    }