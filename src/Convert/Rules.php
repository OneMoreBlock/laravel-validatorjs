<?php

namespace OneMoreBlock\Validatorjs\Convert;

trait Rules {

    protected $validRules;

    protected $parsedRules;

    public function getParsedRules() {

        $rules = $this->rules();

    }
}
