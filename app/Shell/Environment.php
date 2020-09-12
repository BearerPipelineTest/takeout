<?php

namespace App\Shell;

class Environment
{
    protected $shell;

    public function __construct(Shell $shell)
    {
        $this->shell = $shell;
    }

    public function portIsAvailable($port): bool
    {
        // Check to see if the system is running a service with the desired port
        $process = $this->shell->execQuietly("netstat -vanp tcp | grep '\.{$port}\s' | grep -v 'TIME_WAIT' | grep -v 'CLOSE_WAIT' | grep -v 'FIN_WAIT'");

        // A successful netstat command means a port in use was found
        return ! $process->isSuccessful();
    }
}
