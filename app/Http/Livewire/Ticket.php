<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;

class Ticket extends Component
{
    public $selectTicketId;
    protected $listeners = [
        'ticketSelected'
    ];

    public function mount()
    {
        $this->selectTicketId = SupportTicket::query()->latest()->first()->id;
    }

    public function ticketSelected($ticketId)
    {
        $this->selectTicketId = $ticketId;
    }
    public function render()
    {
        $tickets = SupportTicket::latest()->paginate(5);
        return view('livewire.ticket', compact('tickets'));
    }

}
