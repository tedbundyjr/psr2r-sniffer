<?php

namespace PSR2R\Tests\WhiteSpace;

/**
 * Class LanguageConstructSpacingUnitTest
 *
 * @author  Ed Barnard
 * @license MIT
 * @package PSR2R\Tests\WhiteSpace
 */
class LanguageConstructSpacingUnitTestInc {
	private function one() {
		include __FILE__;
		include  __FILE__;
		include ( __FILE__ );
		include(__FILE__);
		include_once __FILE__;
		include_once  __FILE__;
		include_once ( __FILE__ );
		include_once(__FILE__);

		require __FILE__;
		require  __FILE__;
		require ( __FILE__ );
		require(__FILE__);
		require_once __FILE__;
		require_once  __FILE__;
		require_once ( __FILE__ );
		require_once(__FILE__);

		echo __FILE__;
		echo __FILE__;
		echo(__FILE__);
		echo(__FILE__);
		echo;

		print __FILE__;
		print __FILE__;
		print(__FILE__);
		print(__FILE__);
		print;

		return __FILE__;
		return __FILE__;
		return(__FILE__);
		return(__FILE__);
		return;
	}
}
