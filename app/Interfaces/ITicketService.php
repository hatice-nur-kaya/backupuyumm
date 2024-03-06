<?php

namespace App\Interfaces;

use App\Core\ServiceResponse;
use App\Interfaces\Eloquent\IEloquentService;

interface ITicketService extends IEloquentService
{


    public function create(string $title, string $description, int $userId, int $companyId,int $moduleId): ServiceResponse;

    public function getAllTicketsByUserId($userId): ServiceResponse;

    public function sendMessage(int $id, string $message): ServiceResponse;

    public function sendMessageUser(int $id, string $message): ServiceResponse;

    public function getByIdUser(int $id): ServiceResponse;

}
