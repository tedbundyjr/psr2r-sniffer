<?php

namespace PSR2R\Tests\ControlStructures;

/**
 * Class UnneededElseUnitTest
 *
 * @author  Ed Barnard
 * @license MIT
 * @package PSR2R\Tests\ControlStructures
 */
class UnneededElseUnitTestInc {
	public function one($a) {
		++$a;
		if ($a === 1) {
			$a = 2;
			return;
		} elseif ($a === 2) {
			$a = 3;
		} else {
			$a = 0;
		}
		$b = 0;
		if ($a) {
			$b = 1;
		} elseif (!$a) {
			$b = 2;
		} else {
			$a = 0;
		}
		if ($a > 1) {
			return;
		} else {
			$a = 0;
		}
	}
}
