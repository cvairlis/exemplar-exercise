<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->notPath('src/Symfony/Component/Translation/Tests/fixtures/resources.php')
    ->in(__DIR__)
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
;

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR2' => true,
        'align_multiline_comment' => true,
        'php_unit_method_casing' => ['case' => 'snake_case'],
    ])
    ->setCacheFile(__DIR__.'/.php_cs.cache')
    ->setFinder($finder)
;
