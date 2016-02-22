<?php
namespace App\Http\Controllers;

use App\Http\Requests\CallingRequest;
use Psr\Log\LoggerInterface;

class TwilioCallingController extends Controller
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * TwilioCallingController constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param CallingRequest $request
     */
    public function post(CallingRequest $request)
    {
        $this->logger->debug('POST HEADERS:' . print_r($request->header(), true));
        $this->logger->debug('POST VALUES:' . print_r($request->all(), true));
    }
}