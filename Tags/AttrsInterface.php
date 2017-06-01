<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Tags;

/**
 *
 * @author caltj
 */
interface AttrsInterface {

    public function __toString(): string;

    public function setAttr(array $attr);
}
