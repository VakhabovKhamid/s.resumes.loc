<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 27.07.18
 * Time: 11:13
 */

namespace BruteForceDetector\Middleware;


use BruteForceDetector\Detector\BruteForceByActionDetector;
use Cake\Http\ServerRequest;

class TrackingRequestAttemptsMiddleware
{

    public function __invoke(ServerRequest $request, $response, $next)
    {
        $bruteForceDetector = new BruteForceByActionDetector($request);
        $request = $request->withParam('bruteForce', $bruteForceDetector->isBruteForce());

        return $next($request, $response);
    }
}