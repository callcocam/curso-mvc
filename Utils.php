<?php

namespace SIGA;

/**
 * Description of Utils
 *
 * @author Claudio Campos
 */
class Utils {

    public static function getClass($class,$dependecies=[]){
        return (new Services\Container())->resolveClass($class,$dependecies);
    }

    public static function dump($dados, bool $dump = true) {
        echo '<pre>';
        ($dump) ? var_dump($dados) : print_r($dados);
        echo '</pre>';
    }

    public static function getName(string $name){
        $find=[
            '-',
            '_'
        ];
        $sub=[
            ' ',
            ' '
        ];
        return str_replace(' ', '', ucwords(str_replace($find, $sub, $name)));
    }

    public static function filteredFileName(string $text): string {
        $text = trim($text);

        $new = str_replace('&#34;', '', $text);

        $find = [
            '  ',
            '"',
            'á',
            'ã',
            'à',
            'â',
            'ª',
            'é',
            'è',
            'ê',
            'ë',
            'í',
            'ì',
            'î',
            'ï',
            'ó',
            'ò',
            'õ',
            'ô',
            '°',
            'º',
            'ö',
            'ú',
            'ù',
            'û',
            'ü',
            'ç',
            'ñ',
            'Á',
            'Ã',
            'À',
            'Â',
            'É',
            'È',
            'Ê',
            'Ë',
            'Í',
            'Ì',
            'Î',
            'Ï',
            'Ó',
            'Ò',
            'Õ',
            'Ô',
            'Ö',
            'Ú',
            'Ù',
            'Û',
            'Ü',
            'Ç',
            'Ñ',
        ];

        $replace = [
            '',
            '',
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'c',
            'n',
            'A',
            'A',
            'A',
            'A',
            'E',
            'E',
            'E',
            'E',
            'I',
            'I',
            'I',
            'I',
            'O',
            'O',
            'O',
            'O',
            'O',
            'U',
            'U',
            'U',
            'U',
            'C',
            'N',
        ];

        return strtolower(str_replace(' ', '_', str_replace($find, $replace, $new)));
    }

}
