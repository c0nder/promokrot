<?php

    namespace Lib\Restriction;

    use Lib\File\AbstractFile;

    class MimeRestriction extends AbstractRestriction {
        public function getType(): string
        {
            return 'mime-type';
        }

        public function validate(AbstractFile $file, $value)
        {
            if (mime_content_type($file->getPath()) != $value) {
                throw new \Exception('File mime type is incorrect');
            }
        }
    }