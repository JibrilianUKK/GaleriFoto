<x-layout>
    <div class="flex justify-center">
        <h1 class="text-black text-xs underline font-normal font-['Poppins']">Edit post</h1>
    </div>

    <form id="myform" class="mt-12 mx-2" action="/posts/update/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input class="filepond" type="file" name='image[]' multiple credits='false'>

        <h1 class="text-black font-normal font-['Poppins'] mt-9">Title</h1>
        <div class="flex">
            <textarea class="flex-grow w-full rounded-md border border-zinc-200" name="title">{{null == old('title')? $post->title : old('title')}}</textarea>
        </div>

        <h1 class="text-black font-normal font-['Poppins'] mt-4">Description</h1>
        <div class="flex">
            <textarea class="flex-grow w-full rounded-md border border-zinc-200" name="description">{{null == old('description')? $post->description : old('description')}}</textarea>
        </div>

        <h1 class="text-black font-normal font-['Poppins'] mt-4">Tags</h1>
        <div class="flex">
            <textarea class="flex-grow w-full rounded-md border border-zinc-200" name="tags">@if(old('tags') != null){{old('tags')}}@else @foreach ($post->tags as $tag){{$tag->name}}@endforeach @endif</textarea>
        </div>

    </form>

    <div class="flex justify-end mt-6 mx-2 items-center mb-28">
        <form action="/posts/delete/{{$post->id}}" method="POST">
            @csrf
            <button type="submit" class="mr-4 w-24 h-9 bg-red-500 text-white text-xs rounded-3xl font-normal font-['Poppins']">Delete post</button>
        </form>
        <button type="submit" form="myform" class="w-24 h-9 bg-gray-800 text-white text-xs rounded-3xl font-normal font-['Poppins']">Submit</button>
    </div>

    {{-- {{dd($post->images->map(function ($image) {
        return asset("storage/images/postImage/") . $image->image;
    })->all())}} --}}

    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImagePreview);
        
        // ... FilePond initialisation code here
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');
        

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                load: '/',
                process: '/tmp-image/create',
                revert: '/tmp-image/delete',
                headers: {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                allowMultiple: true,
            },
            files: [
                {
                source:  'folder-65b84d3679fdd3.64021550/image-65b84d3679fd94.44546420',
                options: {
                    type: 'local',
                    encodeFilename: false
                    }
                }
            ],
        });

        let images = @json($post->images);
        let url = @json(asset("storage/images/postImage/"));

        images.forEach(image => {
            pond.addFile(url + '/' + image.image)
        });

    </script>
</x-layout>