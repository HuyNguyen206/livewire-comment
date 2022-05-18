<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;
    public $newComment;
    public $image;
    public $selectTicketId;
    protected $rules = [
        'newComment' => 'required|min:3|max:500'
    ];
    protected $listeners = [
        'uploadFile' => 'handleFileUpload',
        'ticketSelected'
    ];

    public function mount()
    {
        $this->selectTicketId = SupportTicket::latest()->first(['id'])->id;
    }

    public function ticketSelected($ticketId)
    {
        $this->selectTicketId = $ticketId;
    }


    public function render()
    {
        return view('livewire.comment', [
            'comments' =>  \App\Models\Comment::where('support_ticket_id', $this->selectTicketId)->latest()->paginate(5)
        ]);
    }

    public function handleFileUpload($image)
    {
        $this->image = $image;
    }
    public function addComment()
    {
        $this->validate();
        $request = request();
        $comment = $request->user()->comments()->create([
            'body' => $this->newComment,
            'support_ticket_id' => $this->selectTicketId
        ]);
        if ($image = $this->image){
            $comment->addMediaFromBase64($image)->usingFileName(Str::uuid().'.png')->toMediaCollection('comment');
        }
        $this->image = null;
        $this->newComment = null;
        session()->flash('success', 'Comment successfully added');
    }


    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function remove($commentId)
    {
        $comment = \App\Models\Comment::query()->find($commentId);
        if ($comment->delete()) {
            $comment->clearMediaCollection('comment');
        }

        session()->flash('success', 'Comment successfully removed');
    }
}
