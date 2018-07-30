<?php

namespace BruteForceDetector;

use Cake\Core\BasePlugin;

/**
 * Plugin for BruteForceDetector
 */
class Plugin extends BasePlugin
{
    public function middleware($middleware)
    {
        return $middleware;
    }
}
