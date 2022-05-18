<div>
    <div class="flex justify-center">
        <div class="w-6/12">
            <h1 class="my-10 text-3x1">Comments</h1>
            @if (session('success'))
                <div class="text-white text-sm bg-green-500 rounded p-3 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            <div>
                @if($image)
                <img src="{{$image}}" width="100" height="100" alt="">
                @endif
                    <input id="uploadFile" type="file" wire:change="$emit('fileChosen')">
            </div>
            <form action="" wire:submit.prevent="addComment">
                <div class="my-4 flex">
                    <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" wire:model.lazy="newComment" placeholder="What's in your mind.">
                </div>
                @error('newComment')<div><span class="text-red-500 text-xs">{{ $message }}</span></div>   @enderror
                <div class="py-2">
                    <button class="p-2 bg-blue-500 w-20 rouded shadow text-white" >Add</button>
                </div>
            </form>

            @foreach($comments as $comment)
            <div class="rounded border shadow p-3 my-2">
                <div class="flex justify-between my-2">
                    <div class="flex justify-start">
                        <p class="font-bold text-lg">{{$comment->user->name}}</p>
                        <p class="mx-3 py-1 text-xd text-gray-500 font-semibold">{{$comment->created_at->diffForHumans()}}</p>
                    </div>
                    <i class="fa-solid fa-xmark text-red-500" wire:click="remove({{$comment->id}})"></i>
{{--                    <i class="fa-solid fa-xmark text-red-500" x-on:click="return confirm('Are you sure?') ? @this.remove({{$comment->id}}) : false"></i>--}}
                </div>
                @if($image = $comment->getFirstMediaUrl('comment'))
                <img src="{{$image}}" width="100" height="100" alt="">
                @endif
                <p class="text-gray-800">{{$comment->body}}</p>
            </div>
            @endforeach
            {{ $comments->links() }}
        </div>
    </div>
</div>
@push('js')
    <script>
        Livewire.on('fileChosen', () => {
            var inputFile = document.getElementById('uploadFile')
            var file = inputFile.files[0]
            var reader = new FileReader()
            reader.onloadend = () => {
                Livewire.emit('uploadFile', reader.result)
            }
            reader.readAsDataURL(file)
        })
    </script>
@endpush
