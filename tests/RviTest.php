<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Romulodl\Rvi;

final class RviTest extends TestCase
{
	public function testCalculateWithWrongTypeValues(): void
	{
		$this->expectException(Exception::class);

		$obj = new Rvi();
		$obj->calculate(['poop']);
	}

	public function testCalculateWithInvalidValues(): void
	{
		$this->expectException(Exception::class);

		$values = require(__DIR__ . '/values.php');
		$values[] = [1, 2, 3];

		$obj = new Rvi();
		$obj->calculate($values);
	}

	public function testCalculateWithInvalidStringValues(): void
	{
		$this->expectException(Exception::class);

		$values = require(__DIR__ . '/values.php');
		$values[] = [1, 2, 3, 'poop'];

		$obj = new Rvi();
		$obj->calculate($values);
	}

	public function testCalculateWithEmptyValues(): void
	{
		$this->expectException(Exception::class);

		$obj = new Rvi();
		$obj->calculate([]);
	}

	public function testCalculateWithValidValues(): void
	{
		$values = require(__DIR__ . '/values.php');

		$obj = new Rvi();
		$val = $obj->calculate($values);

		$this->assertSame(-0.1211, round($val[0], 4));
		$this->assertSame(-0.0882, round($val[1], 4));
	}
}
