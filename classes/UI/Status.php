<?php

namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\Datum;
use KateMorley\Grid\State\Emissions;
use KateMorley\Grid\State\Price;

/** Outputs the status. */
class Status {
  /**
   * Outputs the status.
   *
   * @param Datum  $datum The datum
   * @param string $time  The time
   * @param bool   $help  Whether to show the help
   */
  public static function output(
    Datum $datum,
    string $time,
    bool $help = false
  ): void {
?>
          <dl>
            <dt>Time<?php if ($help) { ?> <span data-help="<p>Data for power generation (except for solar power) is updated every five minutes. Data for solar power and energy transfers is updated every thirty minutes.</p>"></span><?php } ?></dt>
            <dd><?= $time ?></dd>
            <dt>Price<?php if ($help) { ?>  <span data-help="<p>As a market-traded commodity, electricity doesn’t have just one price: buyers and sellers can enter into contracts hours, days, weeks, or months in advance. This site shows the price on the APX spot market, which reflects the real-time wholesale price of electricity in Great Britain.</p><p>Higher prices encourage additional generation and discourage consumption, while lower prices have the opposite effect. Many forms of renewable power generation are subsidised through the <a href='https://www.gov.uk/government/publications/contracts-for-difference/contract-for-difference'>Contracts For Difference scheme</a>, and can continue to profitably generate power even if the price is below zero.</p>"></span><?php } ?></dt>
            <dd><?= Value::formatPrice($datum->price->get(Price::PRICE)) ?><abbr>/MWh</abbr></dd>
            <dt>Emissions<?php if ($help) { ?> <span data-help="<p>The burning of coal, gas, and biomass produces carbon dioxide. The increase in atmospheric carbon dioxide from around 280 parts per million before the industrial revolution to over 400 parts per million today has resulted in a climate crisis, as increased global average temperatures cause progressively more extreme weather.</p><p>The National Oceanic And Atmospheric Administration has been tracking <a href='https://gml.noaa.gov/ccgg/trends/mlo.html'>levels of atmospheric carbon dioxide</a> since 1958.</p>"></span><?php } ?></dt>
            <dd><?= (int)$datum->emissions->get(Emissions::EMISSIONS) ?><abbr>g/kWh</abbr></dd>
          </dl>
<?php
  }

  /**
   * Formats a time as HTML and returns it.
   *
   * @param int $time The time
   */
  public static function time(int $time): string {
    return (
      '<time datetime="'
      . gmdate('Y-m-d\TH:i:s\Z', $time)
      . '">'
      . date('g:i', $time)
      . '<abbr>'
      . date('a', $time)
      . '</abbr></time>'
    );
  }
}
