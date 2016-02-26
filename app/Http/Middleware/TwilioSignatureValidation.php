<?php

namespace App\Http\Middleware;

use Closure;
use Psr\Log\LoggerInterface;
use Services_Twilio_RequestValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TwilioSignatureValidation
{
    /**
     * @var Services_Twilio_RequestValidator
     */
    private $validator;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Services_Twilio_RequestValidator $validator
     */
    public function __construct(Services_Twilio_RequestValidator $validator, LoggerInterface $logger)
    {
        $this->validator = $validator;
        $this->logger = $logger;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $signature = $request->header('X-Twilio-Signature');

        Request::setTrustedProxies([$request->getClientIp()]);
        $url = $request->getUri();

        $postParameters = $request->input();

        if (!$this->validator->validate($signature, $url, $postParameters)) {
            $this->logger->debug('signature:' . $signature);
            $this->logger->debug('computedSignature:' . $this->validator->computeSignature($url, $postParameters));
            $this->logger->debug('url:' . $url);
            $this->logger->debug('post' . print_r($request->all(), true));
            throw new BadRequestHttpException('X-Twilio-Signature validation was fault');
        }

        return $next($request);
    }

}