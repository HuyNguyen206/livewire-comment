<div>
    <div class="flex justify-center">
        <div class="w-6/12">
            <h1 class="my-10 text-3x1">Support tickets</h1>
            @if (session('success'))
                <div class="text-white text-sm bg-green-500 rounded p-3 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
{{--            <form action="" wire:submit.prevent="addComment">--}}
{{--                <div class="my-4 flex">--}}
{{--                    <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" wire:model.lazy="newComment" placeholder="What's in your mind.">--}}
{{--                </div>--}}
{{--                @error('newComment')<div><span class="text-red-500 text-xs">{{ $message }}</span></div>   @enderror--}}
{{--                <div class="py-2">--}}
{{--                    <button class="p-2 bg-blue-500 w-20 rouded shadow text-white" >Add</button>--}}
{{--                </div>--}}
{{--            </form>--}}

            @foreach($tickets as $ticket)
                <div class="rounded border shadow p-3 my-2 @if($selectTicketId===$ticket->id) bg-blue-500 @endif" wire:click="$emit('ticketSelected', {{$ticket->id}})">
                    <div class="flex justify-between my-2">
                        <div class="flex justify-start">
{{--                            <p class="font-bold text-lg">{{$ticket->user->name}}</p>--}}
                            <p class="mx-3 py-1 text-xd text-gray-500 font-semibold">{{$ticket->created_at->diffForHumans()}}</p>
                        </div>
                        <i class="fa-solid fa-xmark text-red-500" wire:click="remove({{$ticket->id}})"></i>
                    </div>
                    <p class="text-gray-800">{{$ticket->question}}</p>
                </div>
            @endforeach
            {{ $tickets->links() }}
        </div>
    </div>
</div>
