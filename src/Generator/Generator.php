<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Generator;

use Malios\Ast2Zephir\Generator\Exception\WrongGeneratorException;
use PhpParser\Node;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

abstract class Generator implements LoggerAwareInterface
{
    const INDENTATION = '    ';

    protected $finder;

    /** @var LoggerInterface */
    protected $logger;

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * Generate code from AST node
     *
     * @param Node $node
     * @return string
     * @throws WrongGeneratorException
     */
    public function generateCode(Node $node) : string
    {
        if (!$this->canGenerateCode($node)) {
            throw new WrongGeneratorException(sprintf(
                'Generator %s cannot generate code for node of type %s',
                __CLASS__,
                $node->getType()
            ));
        }

        return $this->doGenerateCode($node);
    }

    /**
     * {@inheritdoc}
     * @see LoggerAwareInterface::setLogger()
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Indent a block of code
     *
     * @param string $code
     * @return string
     */
    protected function indent(string $code) : string
    {
        $indented = self::INDENTATION . str_replace(PHP_EOL, (PHP_EOL . self::INDENTATION), $code);
        $indentLen = strlen(self::INDENTATION);
        $tail = substr($indented, ((-1) * $indentLen));
        if ($tail === self::INDENTATION) {
            $indented = substr($indented, 0, ((-1) * $indentLen));
        }

        return $indented;
    }

    /**
     * Get type of the node that the generator can generate code for
     *
     * @param Node $node
     * @return bool
     */
    abstract protected function canGenerateCode(Node $node) : bool;

    /**
     * Concrete implementation for different generators
     *
     * @param $node
     * @return string
     */
    abstract protected function doGenerateCode($node): string;
}
