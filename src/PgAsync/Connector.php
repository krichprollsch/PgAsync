<?php

namespace PgAsync;

use React\SocketClient\Connector as BaseConnector;
use React\EventLoop\LoopInterface;
use React\Dns\Resolver\Resolver;
use React\Promise;

class Connector extends BaseConnector
{
    private $options;

    public function __construct(
        LoopInterface $loop,
        Resolver $resolver,
        array $options = []
    ) {
        parent::__construct($loop, $resolver);
        $this->options = $options;
    }

    protected function resolveHostname($host)
    {
        if (false === ($this->options['dns'] ?? true)) {
            return Promise\resolve($host);
        }

        return parent::resolveHostname($host);
    }
}
