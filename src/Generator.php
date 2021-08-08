<?php

namespace OneMoreBlock\Validatorjs;

use OneMoreBlock\Validatorjs\Types\ValueType;
use OneMoreBlock\Validatorjs\Convert\Messages;

trait Generator
{

    use ValueType, Messages;

    protected $prodValidatorJs = '<script src="https://cdnjs.cloudflare.com/ajax/libs/validatorjs/2.0.0/validator.min.js" integrity="sha512-Y/Pox7RqKmT84klgmJCva3drWoXQWO42oHiWWhb9zd1pkIH60NF2SamgBrFHOTzrzHJhwgPGNGjNJ5ZmxLpUAQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';

    protected $devValidatorJs = '<script src="https://cdn.jsdelivr.net/gh/mikeerickson/validatorjs/dist/validator.js"></script>';

    public function generateScriptData()
    {
        $outPut = '';

        foreach ($this->getRequiredScripts() as $value) {
            $outPut .= $value . "\n";
        }

        return $outPut;
    }

    private function getRequiredScripts()
    {

        return [
            $this->getValidatorLibrary(),
            '<script> validatorjs = ' . json_encode($this->getScriptsData()) . '</script>',
            $this->generateScriptTag(config('validatorjs.js_vendor')),
        ];

    }

    private function getScriptsData()
    {
        return [
            'table_id'          => $this->tableID,
            'successCallback'   => $this->successCallback,
            'rules'             => $this->rules(),
            'attributes'        => $this->attributes(),
            'messages'          => $this->getValidatorMessages(),
        ];
    }

    private function getValidatorLibrary()
    {
        return config('app.env') == 'local' ? $this->devValidatorJs : $this->prodValidatorJs;
    }

    private function generateScriptTag($filePath) {
        return '<script src="' . $filePath . '"></script>';
    }
}
