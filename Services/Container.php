<?php

namespace SIGA\Services;

/**
 * Description of Container
 *
 * @author Claudio Campos
 */
class Container {

    private $dependecies_inject;

    public function resolveFunction($fn, $dependecies_inject = []) {
        if ($dependecies_inject !== []):
            $this->dependecies_inject = $dependecies_inject;
        endif;

        $info = new \ReflectionFunction($fn);

        $parameters = $info->getParameters();

        $dependecies = $this->getDependencies($parameters);

        return call_user_func_array($info->getClosure(), $dependecies);
    }

    public function resolveClass($class, $dependecies_inject = []) {
        if ($dependecies_inject !== []):
            $this->dependecies_inject = $dependecies_inject;
        endif;

        if (is_string($class)):
            $class = new \ReflectionClass($class);
        endif;
        if (!$class->isInstantiable()):
            throw new \Exception("{$class->name} is not instanciable");
        endif;

        $constructor = $class->getConstructor();

        if (is_null($constructor)):
            return new $class->name;
        endif;

        $parameters = $constructor->getParameters();

        $dependecies = $this->getDependencies($parameters);

        return $class->newInstanceArgs($dependecies);
    }

    protected function getDependencies($parameters) {
        $dependecies = [];

        foreach ($parameters as $parameter):

            $dependecy = $parameter->getClass();

            if (is_null($dependecy)):

                $dependecies[] = $this->resolveNoClass($parameter);

            else:

                $dependecies[] = $this->resolveClass($dependecy);

            endif;

        endforeach;

        return $dependecies;
    }

    protected function resolveNoClass(\ReflectionParameter $parameter) {

        if (isset($this->dependecies_inject[$parameter->name])):
            return $this->dependecies_inject[$parameter->name];
        endif;

        if ($parameter->isDefaultValueAvailable()):
            return $parameter->getDefaultValue();
        endif;

        throw \SIGA\Utils::dump(new \Exception("Cannot resolve unknow!"));
    }

}
