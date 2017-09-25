<?php

namespace Malios\Ast2Zephir\Test;

use Malios\Ast2Zephir\Generator\FinderFactory;
use Malios\Ast2Zephir\Transformer;
use PhpParser\Parser;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use PhpParser\ParserFactory;

class GeneratorTest extends TestCase
{
    /**
     * @var Parser
     */
    private $astParser;

    /**
     * @var Transformer
     */
    private $transformer;

    public function setUp()
    {
        parent::setUp();
        $this->astParser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $finder =  (new FinderFactory())->create();
        $this->transformer = new Transformer($finder);
    }

    /**
     * @dataProvider codeProvider
     */
    public function testGenerator($php, $zephir)
    {
        $phpCode = file_get_contents($php);
        $expectedZephirCode = file_get_contents($zephir);

        $ast = $this->astParser->parse($phpCode);
        $generatedZephirCode = $this->transformer->transform(...$ast);

        $this->assertEquals($expectedZephirCode, $generatedZephirCode);
    }

    public function codeProvider()
    {
        return $this->getTestCode(__DIR__ . '/data');
    }

    private function getTestCode(string $dir)
    {
        $files = [];
        $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        /** @var \SplFileInfo $file */
        foreach ($rii as $file) {
            if ($file->getExtension() !== 'php'){
                continue;
            }

            $phpFilePath = $file->getPathname();
            $zepFilePath = str_replace('.php', '.zep', $phpFilePath);
            $files[$file->getFilename()] = [$phpFilePath, $zepFilePath];
        }

        return $files;
    }
}
