<?php 

function format_currency($amount, $decimals = 2) {
    return number_format($amount, $decimals, '.', '');
}


//Currency to words conversion

function numberToWords($num) {
    $units = [
        '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine',
        'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen',
        'seventeen', 'eighteen', 'nineteen'
    ];

    $tens = [
        '', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'
    ];

    $thousands = [
        '', 'thousand', 'million', 'billion'
    ];

    if ($num == 0) {
        return 'zero';
    }

    $words = [];
    $chunks = splitNumber($num);
    
    foreach ($chunks as $i => $chunk) {
        if ($chunk) {
            $words[] = chunkToWords($chunk) . ' ' . $thousands[$i];
        }
    }

    return trim(implode(' ', array_reverse($words)));
}