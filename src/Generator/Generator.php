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

    protected $config = [];

    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * Generate code from AST node
     *
     * @param Node $node
     * @param bool $cleanUpPlaceholders - whether to clean up placeholders (e.g %s) which can be used to inject code
     * @return string
     * @throws WrongGeneratorException
     */
    public function generateCode(Node $node, bool $cleanUpPlaceholders = true) : string
    {
        if (!$this->canGenerateCode($node)) {
            throw new WrongGeneratorException(sprintf(
                'Generator %s cannot generate code for node of type %s',
                __CLASS__,
                $node->getType()
            ));
        }

        $code = $this->doGenerateCode($node);
        if ($cleanUpPlaceholders) {
            $code = str_replace('%s', '', $code);
            return $code;
        }

        return $code;
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
     * Add generator specific config
     *
     * @param string $key
     * @param $value
     */
    public function addConfig(string $key, $value)
    {
        $this->config[$key] = $value;
    }

    protected function getConfig(string $key)
    {
        return $this->config[$key] ?? null;
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
     * Check if the generator can generate code for this node
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
