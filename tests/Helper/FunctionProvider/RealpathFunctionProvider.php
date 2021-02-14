<?php

declare(strict_types = 1);

namespace App\Tests\Helper\FunctionProvider;

use phpmock\functions\FunctionProvider;

/**
 * Mimicks the native realpath function, but works with vfs-streams.
 * 
 * @package Fantestic
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class RealpathFunctionProvider implements FunctionProvider
{
    /**
     * 
     * @return callable 
     */
    public function getCallable() :callable
    {
        /**
         * @return string|false
         */
        return function (string $url) {
            preg_match("|^(\w+://)?(/)?(.*)$|", $url, $matches);
            $protocol = $matches[1];
            $root     = $matches[2];
            $rest     = $matches[3];
            
            $split = preg_split("|/|", $rest);

            $cleaned = [];
            foreach ($split as $item) {
                if ($item === '.' || $item === '') {
                    // If it's a ./ then it's nothing (just that dir) so don't add/delete anything
                } elseif ($item === '..') {
                    // Remove the last item added since .. negates it.
                    $removed = array_pop($cleaned);
                } else {
                    $cleaned[] = $item;
                }
            }

            $cleaned = $protocol.$root.implode('/', $cleaned);
            return file_exists($cleaned) ? $cleaned : false;
        };
    }
}