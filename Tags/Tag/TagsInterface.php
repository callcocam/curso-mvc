<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIGA\Tags\Tag;

/**
 *
 * @author caltj
 */
interface TagsInterface {

    public function validate();

    public function __toString(): string;
}
