<?php

    namespace Lib\Strategy;

    class BaseStrategy extends IStrategy {
        public function do(array $args)
        {
            $substring = $args['substring'] ?? null;

            $contents = $this->getContents();

            foreach ($contents as $lineNumber => $string) {
                if (($position = strpos($string, $substring)) !== false) {
                    return [
                        'line' => $lineNumber + 1,
                        'position' => $position + 1
                    ];
                }
            }

            return null;
        }
    }