<?php

namespace PSR2R\Tests\WhiteSpace;

/**
 * Class ObjectAttributeSpacingUnitTest
 *
 * @author  Ed Barnard
 * @license MIT
 * @package PSR2R\Tests\WhiteSpace
 */
class ObjectAttributeSpacingUnitTestInc {
	private static $a = 1;
	private $b = 2;
	public static function one() {
		return 1;
	}

	public function two() {
		$a = ObjectAttributeSpacingUnitTestInc::one();
		$b = ObjectAttributeSpacingUnitTestInc :: one();
		$c = $this->three();
		$d = $this -> three();
		$e = $this
			->three();
		$f = static :: $a;
		$g = ObjectAttributeSpacingUnitTestInc :: $a;
		$h = $this -> b;
	}

	public function three() {
		return 3;
	}
}
