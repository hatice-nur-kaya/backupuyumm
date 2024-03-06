<?php

namespace App\Services;

use App\Core\ServiceResponse;
use App\Interfaces\ICompanyService;
use App\Interfaces\IModuleService;
use App\Interfaces\ITicketService;
use App\Models\Ticket;

class TicketService implements ITicketService
{

    public function getAll(): ServiceResponse
    {
        $tickets = Ticket::latest()->get();
        $tickets->load('user');
        $tickets->load('company');
        $tickets->load('module');
        $tickets->load('ticketPerson');
        $tickets->filter(function ($ticket) {
            $ticket->unread = $ticket->messages()->where('viewed', 0)->where('user_id', '!=', auth()->user()->id)->count();
        });
        return new ServiceResponse(true, 'Tickets found', $tickets, 200);
    }

    public function getById(int $id): ServiceResponse
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return new ServiceResponse(false, 'Ticket not found', null, 404);
        }
        if ($ticket->ticket_person_id != null && $ticket->ticket_person_id != auth()->user()->id) {
            return new ServiceResponse(false, 'This ticket was assigned to someone else', null, 400);
        }
        $ticket->ticket_person_id = auth()->user()->id;
        $ticket->status = 'pending';
        $ticket->save();
        $ticket->load('messages');
        $ticket->messages->map(function ($message) {
            if($message->user_id != auth()->user()->id){
                $message->viewed = 1;
                $message->save();
            }
            $message->user = $message->user()->first()->name;
        });

        return new ServiceResponse(true, 'Ticket found', $ticket, 200);
    }

    public function ticketStatusUpdate(int $id, string $status): ServiceResponse
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return new ServiceResponse(false, 'Ticket not found', null, 404);
        }
        $ticket->status = $status;
        $ticket->save();
        return new ServiceResponse(true, 'Ticket status updated', $ticket, 200);
    }

    public function sendMessage(int $id, string $message): ServiceResponse
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return new ServiceResponse(false, 'Ticket not found', null, 404);
        }
        if ($ticket->ticket_person_id != auth()->user()->id) {
            return new ServiceResponse(false, 'This ticket was assigned to someone else', null, 400);
        }
        if ($ticket->status == 'closed') {
            return new ServiceResponse(false, 'This ticket is closed', null, 400);
        }
        $ticket->messages()->create([
            'message' => $message,
            'user_id' => auth()->user()->id
        ]);
        return new ServiceResponse(true, 'Message sent', $ticket->messages(), 200);
    }

    public function delete(int $id): ServiceResponse
    {
        // TODO: Implement delete() method.
    }

    public function create(string $title, string $description, int $userId, int $companyId, int $moduleId): ServiceResponse
    {
        $companyService = app(ICompanyService::class);
        $company = $companyService->getById($companyId);
        if (!$company->isSuccess()) {
            return $company;
        }

        $userCompanyCheck = $company->getData()->users()->where('user_id', $userId)->first();
        if (!$userCompanyCheck) {
            return new ServiceResponse(false, 'User not found in company', null, 404);
        }

        $moduleService = app(IModuleService::class);
        $module = $moduleService->getById($moduleId);
        if (!$module->isSuccess()) {
            return $module;
        }
        $companyModuleCheck = $company->getData()->modules()->where('module_id', $moduleId)->first();
        if (!$companyModuleCheck) {
            return new ServiceResponse(false, 'Module not found in company', null, 404);
        }

        $ticketCheck = $company->getData()->tickets()
            ->where('user_id', $userId)
            ->where('company_id', $companyId)
            ->where('module_id', $moduleId)
            ->where('status', 'open')->first();

        if ($ticketCheck) {
            return new ServiceResponse(false, 'Ticket already open', null, 400);
        }

        $ticket = $company->getData()->tickets()->create([
            'title' => $title,
            'description' => $description,
            'status' => 'open',
            'user_id' => $userId,
            'module_id' => $moduleId,
            'ticket_person_id' => null
        ]);
        return new ServiceResponse(true, 'Ticket created', $ticket, 201);
    }



    public function getAllTicketsByUserId($userId): ServiceResponse
    {
        $tickets = Ticket::where('user_id', $userId)->get();
        $tickets->load('user');
        $tickets->load('company');
        $tickets->filter(function ($ticket) {
            $ticket->unread = $ticket->messages()->where('viewed', 0)->where('user_id', '!=', auth()->user()->id)->count();
            $ticket->user = $ticket->user()->first()->name;
            $ticket->ticket_person = $ticket->ticketPerson()->first()->name ?? null;

        });
        return new ServiceResponse(true, 'Tickets found', $tickets, 200);
    }

    public function sendMessageUser(int $id, string $message): ServiceResponse
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return new ServiceResponse(false, 'Ticket not found', null, 404);
        }
        $userTicketCheck = $ticket->user_id == auth()->user()->id;
        if (!$userTicketCheck) {
            return new ServiceResponse(false, 'This ticket is not yours', null, 400);
        }
        if ($ticket->status == 'closed') {
            return new ServiceResponse(false, 'This ticket is closed', null, 400);
        }
        $ticket->messages()->create([
            'message' => $message,
            'user_id' => auth()->user()->id
        ]);
        return new ServiceResponse(true, 'Message sent', $ticket->messages(), 200);
    }

    public function getByIdUser(int $id): ServiceResponse
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return new ServiceResponse(false, 'Ticket not found', null, 404);
        }
        $ticket->load('messages');
        $ticket->messages->map(function ($message) {
            if($message->user_id != auth()->user()->id){
                $message->viewed = 1;
                $message->save();
            }
            $message->user = $message->user()->first()->name;
        });

        return new ServiceResponse(true, 'Ticket found', $ticket, 200);
    }
}
