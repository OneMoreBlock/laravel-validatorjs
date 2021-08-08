<?php

namespace OneMoreBlock\Validatorjs\Types;

trait ValueType {

	public static function String($data) {
		return "'$data'";
	}

	public static function Function($data)	{
		return $data;
	}
}
