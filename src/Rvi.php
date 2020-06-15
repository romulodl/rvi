<?php

namespace Romulodl;

class Rvi
{
	public function calculate(array $ohlc_values, int $periods = 10) : array
	{
		if (count($ohlc_values) < $periods + 6) {
			throw new \Exception('[' . __METHOD__ . '] $values parameters is invalid');
		}

		$pre = [];
		$nom = [];
		$den = [];
		$rvi = [];
		foreach ($ohlc_values as $key => $val) {
			if (!$this->isValidValue($val)) {
				throw new \Exception('[' . __METHOD__ . '] invalid OHLC value');
			}

			if (count($pre) < 3) {
				$pre[] = $val;
				continue;
			}

			$nom[] = (
				     ($val[3] - $val[0]) +
				(2 * ($pre[2][3] - $pre[2][0])) +
				(2 * ($pre[1][3] - $pre[1][0])) +
				     ($pre[0][3] - $pre[0][0])
			    ) / 6;

			$den[] = (
				     ($val[1] - $val[2]) +
				(2 * ($pre[2][1] - $pre[2][2])) +
				(2 * ($pre[1][1] - $pre[1][2])) +
				     ($pre[0][1] - $pre[0][2])
			    ) / 6;

			array_shift($pre);
			$pre[2] = $val;

			if (count($nom) < $periods) {
				continue;
			}

			$rvi[$key] = (array_sum(array_slice($nom, -1 * $periods)) / $periods) /
				     (array_sum(array_slice($den, -1 * $periods)) / $periods);

			if (count($rvi) < 4) {
				continue;
			}

			$signal[] = (
				$rvi[$key] +
				(2 * $rvi[$key - 1]) +
				(2 * $rvi[$key - 2]) +
				$rvi[$key - 3]
			) / 6;
		}

		return [
			array_slice($rvi, -1)[0],
			array_slice($signal, -1)[0]
		];
	}

	private function isValidValue($values) : bool
	{
		return is_array($values) &&
			count($values) === 4 &&
			is_numeric($values[0]) &&
			is_numeric($values[1]) &&
			is_numeric($values[2]) &&
			is_numeric($values[3]);
	}
}
