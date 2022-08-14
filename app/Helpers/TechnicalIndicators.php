<?php 

namespace App\Helpers;

class TechnicalIndicators {

    public function getMovingAverage() {
        // SELECT SUM(close) /20 FROM(
        //     SELECT close FROM `prices` WHERE symbol = 'SCC' ORDER BY date DESC LIMIT 20
        // ) as ma20 
    }

    public function getAverageVolume() {
        // SELECT * FROM prices
        // LEFT JOIN ( 
        //     SELECT AVG(volume) as avgVolume, symbol FROM prices 
        //     WHERE date <= '2022-08-04' AND date >= '2022-07-24'
        //     GROUP BY symbol 
        //     ORDER BY date DESC
        // ) price2 
        //     ON price2.symbol = prices.symbol 
        // WHERE prices.date = '2022-08-05' AND prices.volume > (price2.avgVolume * 8) ORDER BY prices.date DESC;
    }
} 



    