#!/usr/bin/env php
<?php
    $optind = null;
    $options = getopt("t", [], $optind);
    $pos_args = array_slice($argv, $optind);

    $size = count($pos_args);

    if ($size === 0) {
        fwrite(STDERR, "Required at least 1 argument!\n");
        exit(1);
    }

    $file = new SplFileObject('china_domains.txt');
    while (!$file->eof()) {
        $domain = trim($file->fgets());

        if (strpos($domain, '.') === false) continue;

        for ($i = 0; $i < $size; ++$i) {
?>
server=/<?php echo $domain; ?>/<?php echo $pos_args[$i], "\n" ?>
<?php
        }
    }
?>

