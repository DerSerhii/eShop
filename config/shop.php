<?php


return [
    /*
    |--------------------------------------------------------------------------
    | Bonus Threshold
    |--------------------------------------------------------------------------
    |
    | This value is necessary to calculate the bonus in the order.
    | Rule: If the order amount is greater than 'bonus_threshold' then the bonus
    | is 5% of the difference between the amount and 'bonus_threshold'.
    |
    */
    'bonus_threshold' => 100,
];
