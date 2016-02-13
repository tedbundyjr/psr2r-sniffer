<?php
namespace PSR2R\Sniffs\WhiteSpace;

use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;

/**
 * Ensures all language constructs contain a
 * single space between themselves and their content.
 * Also asserts that no unneeded parenthesis are used.
 *
 * @author Mark Scherer
 * @license MIT
 */
class LanguageConstructSpacingSniff implements PHP_CodeSniffer_Sniff {

	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register() {
		return [
			T_INCLUDE,
			T_INCLUDE_ONCE,
			T_REQUIRE,
			T_REQUIRE_ONCE,
			T_ECHO,
			T_PRINT,
			T_RETURN
		];
	}

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param \PHP_CodeSniffer_File $phpcsFile The file being scanned.
	 * @param int                  $stackPtr  The position of the current token in
	 *                                        the stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		$tokens = $phpcsFile->getTokens();

		if ($tokens[($stackPtr + 1)]['code'] === T_SEMICOLON) {
			// No content for this language construct.
			return;
		}

		// We don't care about the following whitespace and let another sniff take care of that
		$nextIndex = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);

		// No brackets
		if ($tokens[$nextIndex]['code'] !== T_OPEN_PARENTHESIS) {
			// Check if there is at least a whitespace in between
			if ($nextIndex - $stackPtr > 1) {
				// Everything's fine
				return;
			}

			$error = 'Language constructs must contain a whitespace.';
			$phpcsFile->addFixableError($error, $stackPtr, 'MissingWhitespace');

			if ($phpcsFile->fixer->enabled === true) {
				$phpcsFile->fixer->addContent($stackPtr, ' ');
			}

			return;
		}

		$closingTokenIndex = $tokens[$nextIndex]['parenthesis_closer'];

		$lastTokenIndex = $phpcsFile->findNext(T_WHITESPACE, ($closingTokenIndex + 1), null, true);
		if (!$lastTokenIndex || $tokens[$lastTokenIndex]['type'] !== 'T_SEMICOLON') {
			return;
		}

		$error = 'Language constructs must not be followed by parenthesesis.';
		$phpcsFile->addFixableError($error, $stackPtr, 'IncorrectParenthesis');

		// Do we need to add a space?
		$replacement = '';
		if ($nextIndex - $stackPtr === 1) {
			$replacement = ' ';
		}

		if ($phpcsFile->fixer->enabled === true) {
			$phpcsFile->fixer->replaceToken($nextIndex, $replacement);
			$phpcsFile->fixer->replaceToken($closingTokenIndex, '');
		}
	}

}