<?php
declare(strict_types=1);
/**
 * XChess.
 * 
 * The worlds best chess playing website.
 *
 * @author XChess Contributors <https://github.com/orgs/XChess/people>
 *
 * @link <https://github.com/XChess> XChess Code.
 */

use Symfony\Component\Debug\Debug;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';

// Load the dotenv configuration file.
(new Dotenv())->load(__DIR__ . '/xchess.env');

// Determine if we should run in debug mode.
if ($_ENV['APP_DEBUG'])
{
    Debug::enable();
}

// Create a new container.
$containerBuilder = new ContainerBuilder();

// Initiate a hash manager.
$containerBuilder->register('hasher', 'XChess\Engine\Hasher');

// Initiate a encrypter.
$containerBuilder->register('encrypter', 'XChess\Engine\Encryption');

// Make the container accessable through a function.
function app(string $service)
{
    global $containerBuilder;
    return $containerBuilder[$service];
}
