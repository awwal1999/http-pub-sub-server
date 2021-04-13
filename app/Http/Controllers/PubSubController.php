<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Service\PubSubService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PubSubController extends BaseController
{
    /**
     * @var PubSubService
     */
    private $pubSubService;

    public function __construct(PubSubService $pubSubService)
    {
        $this->pubSubService = $pubSubService;
    }

    public function publish(Request $request, $topic)
    {
        $request->validate(['data' => 'array']);

        try {
            $event = Event::where('topic', $topic)->firstOrFail();

            $response = $this->pubSubService->publish($event, $request->get('data'));

            return $this->successResponse(200, $response);
        } catch (Exception $e) {
            Log::error($e);
            return $this->errorResponse();
        }
    }

    public function subscribe(Request $request, $topic)
    {
        $request->validate(['webhook' => 'string|required']);

        try {
            $event = Event::where('topic', $topic)->firstOrFail();

            $response = $this->pubSubService->subscribe($event, $request->get('webhook'));

            return $this->successResponse(200, $response);
        } catch (\Exception $e) {
            Log::error($e);
            return $this->errorResponse();
        }
    }
}
