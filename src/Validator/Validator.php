<?php

namespace Validator;

interface Validator
{
    public function validate(array $params): bool;
}