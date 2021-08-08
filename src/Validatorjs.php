<?php

namespace OneMoreBlock\Validatorjs;

use Illuminate\Foundation\Http\FormRequest;

class Validatorjs extends FormRequest
{

    use Generator;

    protected $rules = [];

    protected $tableID = '';


    public function render($view, $data = [], $mergeData= [])
    {

        return view($view, $data, $mergeData)->with($this->getViewData());
    }

    private function getViewData()
    {

        return [
            'table_id' => $this->tableID,
            'scripts' => $this->generateScriptData(),
        ];
    }

}
