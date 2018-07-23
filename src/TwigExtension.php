<?php declare(strict_types=1);
/* 
 * This file is part of the spf-support package which is distributed under the MIT License.
 * See LICENSE.md or go to https://github.com/simon-downes/spf-support for full license details.
 */
namespace spf\support;

use Twig_Extension, Twig_Test, Twig_Filter, Twig_Function;

use spf\helpers\{StringHelper, Inflector};

class TwigExtension extends Twig_Extension {

    public function getName() {
        return 'SPF Twig Extension';
    }

    public function getTests() {
        return [
            new Twig_Test('numeric', function( $value ) {
                return is_numeric($value);
            }),
            new Twig_Test('integer', function( $value ) {
                return is_numeric($value) && ($value == (int) $value);
            }),
            new Twig_Test('string', function( $value ) {
                return is_string($value);
            }),
            new Twig_Test('array', function( $value ) {
                return is_array($value);
            }),
            new Twig_Test('object', function( $value, string $class = '' ) {
                $result = is_object($value);
                if( !empty($class) ) {
                    $result = $result && ($value instanceof $class);
                }
                return $result;
            }),
        ];
    }

    public function getFilters() {

        $filters = [
            new Twig_Filter('md5', 'md5'),
            new Twig_Filter('sha1', 'sha1'),
            new Twig_Filter('truncate', function( $str, int $length, string $replace = '...' ) {
                if( isset($str) ){
                    return strlen($str) <= $length ? $str : substr($str, 0, $length - strip_tags($replace)) . $replace;
                }
                return null;
            }),
            new Twig_Filter('sum', 'array_sum'),
            new Twig_Filter('shuffle', 'shuffle'),
        ];

        // include some helpful shit from spf-core/StringHelper if we have it available
        if( class_exists(StringHelper::class) ) {
            $filters = array_merge(
                $filters,
                [
                    new Twig_Filter('slugify', [StringHelper::class, 'slugify']),
                    new Twig_Filter('uncamelise', [StringHelper::class, 'uncamelise']),
                    new Twig_Filter('removeAccents', [StringHelper::class, 'removeAccents']),
                    new Twig_Filter('ordinal', [StringHelper::class, 'ordinal']),
                    new Twig_Filter('sizeFormat', [StringHelper::class, 'sizeFormat']),
                    new Twig_Filter('stripControlChars', [StringHelper::class, 'stripControlChars']),
                    new Twig_Filter('normaliseLineEndings', [StringHelper::class, 'normaliseLineEndings']),
                ]
            );
        }

        // more helpful shit from spf-core/Inflector if we have it available
        if( class_exists(Inflector::class) ) {
            $filters = array_merge(
                $filters,
                [
                    new Twig_Filter('pluralise', [Inflector::class, 'pluralise']),
                    new Twig_Filter('singularise', [Inflector::class, 'singularise']),
                ]
            );
        }

        return $filters;

    }

    public function getFunctions() {

        $functions = [
            new Twig_Function('ceil', 'ceil'),
            new Twig_Function('floor', 'floor'),
        ];

        // include some helpful shit from spf-core/StringHelper if we have it available
        if( class_exists(StringHelper::class) ) {
            $functions = array_merge(
                $functions,
                [
                    new Twig_Function('randomHex', [StringHelper::class, 'randomHex']),
                    new Twig_Function('randomString', [StringHelper::class, 'randomString']),
                ]
            );
        }

        return $functions;

    }

}
