<?php

namespace OneMoreBlock\Validatorjs\Convert;

trait Messages {

	/**
	 *
	 * Return validator messages in validatorJs format
	 *
	 * @return array
	 */
	public function getValidatorMessages() {

        $messages = $this->messages() ?? null ;

        if($messages == null) {
            return [];
        }

		return $this->parsedMessages($messages);
	}

	/**
	 *
	 * Convert Laravel validator messages to validatorJs format
	 *
	 * @param array $messages array of Laravel validator messages to be converted into validatorJs format
	 * @return array
	 */
	private function parsedMessages(array $messages) : array {

		$validatorJsMessage = [];

        foreach($messages as $key => $value) {
            $validatorJsMessage[$this->flipMessageKey($key)] = $value;
        }

        return $validatorJsMessage;
    }

    /**
     *
     * Convert the "attribute.validator" format to "validator.attribute"
     * @param string The key that is to be flipped
     *
     * @return string Flipped string
     */
    private function flipMessageKey(string $key) : string {

        $splittedKey = explode('.', $key);

        return $splittedKey[1] .'.'. $splittedKey[0];
    }
}
