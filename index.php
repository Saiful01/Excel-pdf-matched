<?php

// Include Composer autoloader if not already done.
include 'vendor/autoload.php';

// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf = $parser->parseFile('number.pdf');

$text = $pdf->getText();
$numbers = explode(" ", $text);

foreach ($numbers as $number) {

    if ($xlsx = SimpleXLSX::parse('company.xlsx')) {
        foreach ($xlsx->rows() as $item) {

            if ($number == $item[0]) {
                echo "Created";
                $dir = $item[1];
                if (is_dir($dir) === false) {
                    mkdir($dir);
                }
                $myfile = fopen($dir . "/" ."number.txt", "w") or die("Unable to open file!");
                fwrite($myfile, $number);
                fclose($myfile);
            }

        }
    }


}


?>

