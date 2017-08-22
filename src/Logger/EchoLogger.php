<?php declare(strict_types=1);

namespace Malios\Ast2Zephir\Logger;

use PhpParser\Node;
use Psr\Log\AbstractLogger;

final class EchoLogger extends AbstractLogger
{
    /**
     * {@inheritdoc}
     * @see AbstractLogger::log()
     */
    public function log($level, $message, array $context = [])
    {
        /** @var Node $node */
        $node = $context['node'];
        $line = $node->getAttribute('startLine');
        echo ucfirst($level) . ': "' . $message . '" on line ' . $line;
    }
}
