<?php

namespace App\Http\Controllers\Api;

use App\Core\HttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketController\CreateRequest;
use App\Http\Requests\TicketController\GetByIdRequest;
use App\Http\Requests\TicketController\SendMessageRequest;
use App\Interfaces\ITicketService;

class UserTicketController extends Controller
{
    use HttpResponse;
    protected ITicketService $ticketService;

    public function __construct(ITicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function getAll(){
        $response = $this->ticketService->getAllTicketsByUserId(auth()->user()->id);
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function create(CreateRequest $request){
        $response = $this->ticketService->create(
            $request->title,
            $request->description,
            auth()->user()->id,
            $request->company_id,
            $request->module_id
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function sendMessage(SendMessageRequest $request){
        $response = $this->ticketService->sendMessageUser(
            $request->id,
            $request->message
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }

    public function getById(GetByIdRequest $request){
        $response = $this->ticketService->getByIdUser(
            $request->id
        );
        return $this->httpResponse(
            $response->isSuccess(),
            $response->getMessage(),
            $response->getData(),
            $response->getStatusCode()
        );
    }
}
