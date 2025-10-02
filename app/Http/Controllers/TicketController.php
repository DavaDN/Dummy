<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TicketController extends BaseController
{
    public function __construct(Ticket $ticket)
    {
        $this->model = $ticket;
    }
}
