<?php

namespace SIGA\Tags;

/**
 * Description of Html
 *
 * @author Claudio Campos
 */
class Html {

    /**
     * @var \SIGA\Config
     */
    private static $Config;

    public function __construct(\SIGA\Config $Config) {
        
        self::$Config = $Config;
    }
    public function __call(string $name, array $arguments) {
        return $this->createTags($name, $arguments);
    }

    public static function __callStatic(string $name, array $arguments) {
        return self::createTags($name, $arguments);
    }

    protected static function createTags(string $name, array $arguments) {
        $class = sprintf("SIGA\Tags\Tag\%s", ucfirst($name));

        array_unshift($arguments, new Attrs,new Options, self::$Config);

        $reflection = new \ReflectionClass($class);

        return $reflection->newInstanceArgs($arguments);
    }

}
