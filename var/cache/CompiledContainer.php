<?php
/**
 * This class has been auto-generated by PHP-DI.
 */
class CompiledContainer extends DI\CompiledContainer{
    const METHOD_MAPPING = array (
  'Psr\\Log\\LoggerInterface' => 'get1',
  'app\\settings\\SettingsInterface' => 'get2',
);

    protected function get1()
    {
        return $this->resolveFactory(static function (\Psr\Container\ContainerInterface $c) {
            $settings = $c->get(\app\settings\SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new \Monolog\Logger($loggerSettings['name']);

            $processor = new \Monolog\Processor\UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new \Monolog\Handler\StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        }, 'Psr\\Log\\LoggerInterface');
    }

    protected function get2()
    {
        return $this->resolveFactory(static function () {
            return new \app\settings\Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : 'C:\\Users\\utente\\lavoro\\locale\\slim\\adminDev\\app' . '/logs/app.log',
                    'level' => \Monolog\Logger::DEBUG,
                ]
            ]);
        }, 'app\\settings\\SettingsInterface');
    }

}
