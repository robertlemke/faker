<?php
declare(ENCODING = 'utf-8');
namespace F3\Faker;

/*                                                                        *
 * This script belongs to the FLOW3 package "Faker".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Internet class for the Faker package
 *
 * The Faker package is based on http://faker.rubyforge.org/
 *
 * @version $Id$
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License', version 3 or later
 */

class Internet extends Faker {

	static protected $freemailerDomains = array('gmail.com', 'yahoo.com', 'hotmail.com', 'gmx.net');

	static protected $topLevelDomains = array('co.uk', 'com', 'us', 'uk', 'ca', 'biz', 'info', 'name', 'de', 'fr', 'lv', 'tv', 'ly');

	static public function email($name = NULL) {
		return self::userName($name) . '@' . self::domainName();
	}

	static public function freeEmail($name = NULL) {
		return self::userName($name) . '@' . self::$freemailerDomains[array_rand(self::$freemailerDomains)];
	}

	static public function userName($name = NULL) {
		if ($name === NULL) {
			if (rand(1, 10) > 5) {
				$name = \F3\Faker\Name::firstName() . ' ' . \F3\Faker\Name::lastName();
			} else {
				$name = \F3\Faker\Name::firstName();
			}
		}

		$glue = array('.', '_');
		shuffle($glue);
		$nameParts = explode(' ', $name);
		shuffle($nameParts);
		$userName = implode($glue[0], $nameParts);

		return strtolower($userName);
	}

	static public function domainName() {
		return self::domainWord() . '.' . self::domainSuffix();
	}

	static protected function domainWord() {
		$words = explode(' ', \F3\Faker\Company::name());
		shuffle($words);
		return strtolower(preg_replace('/\W/', '', current($words)));
	}

	static protected function domainSuffix() {
		return self::$topLevelDomains[array_rand(self::$topLevelDomains)];
	}

}
?>