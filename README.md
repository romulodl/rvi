# Relative Vigor Index

![Relative Vigor Index](https://github.com/romulodl/rvi/workflows/Relative%20Vigor%20Index/badge.svg)

Calculate the Relative Vigor Index (RVI) of given values.

## Instalation

```
composer require romulodl/rvi
```

or add `romulodl/rvi` to your `composer.json`. Please check the latest version in releases.

## Usage

```php
$rvi = new Romulodl\Rvi();
$rvi->calculate(array $ohlc_values); // [open, high, low, close]
//returns array [rvi value, signal value]
```

Example of use:
```php
$rvi = new Romulodl\Rvi();
$rvi->calculate([
[9994.74,10045.03,9726.00,9807.49],
[9809.63,9923.98,9528.23,9550.67],
[9550.25,9580.00,7940.00,8719.53],
[8723.23,9164.00,8151.12,8561.09],
[8560.73,8981.00,8520.43,8808.71],
[8808.71,9397.00,8790.04,9305.91],
[9305.91,9950.00,9250.66,9786.80],
[9787.62,9843.50,9100.00,9310.73],
[9311.21,9585.00,9210.03,9374.99],
[9374.99,9880.00,9317.16,9678.57],
[9677.31,9958.67,9450.00,9731.10],
[9731.11,9900.00,9462.00,9773.64],
[9772.66,9838.00,9281.42,9508.11],
[9508.00,9573.00,8812.20,9060.00],
[9060.00,9259.38,8920.00,9166.40],
[9166.43,9300.00,9076.90,9176.41],
[9176.32,9294.44,8674.00,8711.37],
[8711.37,8977.00,8623.38,8895.65],
[8895.66,9011.82,8693.18,8837.05],
]);
```

## Why did you do this?

The PECL Trading extension is crap and not everyone wants to install it.
I am building a trading bot which will need the RVI value as part of the calculation.
