# ast2zephir
Generate Zephir code from PHP Abstract Syntax Tree (AST).

## On hold
For now there isn't much benefit in transpiling PHP code into Zephi. Also Zephir is pretty unstable in this stage. Will wait until stable release.

## Getting Started
### Prerequisites

- PHP >= 7

### Installation

TODO

## Usage

```php
<?php

$code = <<<'EOT'
<?php declare(strict_types=1);

namespace Malios;

abstract class Math
{
    const PI = 3.14, EUL = 2.71;
}

EOT;

use PhpParser\ParserFactory;
$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$astNode = $parser->parse($code);

$finder =  (new \Malios\Ast2Zephir\Generator\FinderFactory())->create();
$transformer = new \Malios\Ast2Zephir\Transformer($finder);

// zephir code
$zep = $transformer->transform(...$astNode);

```

## Testing

##### PHPUnit

    composer phpunit


## Contributing

All contributors are welcome. You can open a new issue or submit a pull request.
See [CONTRIBUTING.md](docs/CONTRIBUTING.md) for details.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.
