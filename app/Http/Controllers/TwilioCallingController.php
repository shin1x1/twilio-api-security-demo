<?php
namespace App\Http\Controllers;

use App\Domain\Repository\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param Request $request
     * @param UserRepository $repository
     * @return Response
     */
    public function post(Request $request, UserRepository $repository)
    {
        $this->logger->debug('POST HEADERS:' . print_r($request->header(), true));
        $this->logger->debug('POST VALUES:' . print_r($request->all(), true));

        $this->validate($request, [
            'From' => 'regex:/^\+81[0-9]+$/',
        ]);

        try {
            $message = $repository->resolveByTelNo($request->input('From'))->getMessage();
        } catch (ModelNotFoundException $e) {
            $message = '会員ではありません。';
        }

        return response()->view('twiml', compact('message'))->header('Content-Type', 'text/xml');
    }
}