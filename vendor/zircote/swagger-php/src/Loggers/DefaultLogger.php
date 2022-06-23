<?php declare(strict_types=1);

/**
 * @license Apache 2.0
 */

namespace OpenApi\Loggers;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Api documentation",
 *      description="Api documentation",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 *
 * @OA\Tag(
 *     name="Projects",
 *     description="API Endpoints of Projects"
 * )
 */
class DefaultLogger extends AbstractLogger implements LoggerInterface
{
    public function log($level, $message, array $context = []): void
    {
        if (LogLevel::DEBUG == $level) {
            return;
        }

        if ($message instanceof \Exception) {
            $message = $message->getMessage();
        }

        if (in_array($level, [LogLevel::NOTICE, LogLevel::INFO])) {
            $error_level = E_USER_NOTICE;
        } else {
            $error_level = E_USER_WARNING;
        }

        trigger_error($message, $error_level);
    }
}
