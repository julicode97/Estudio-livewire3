<div>
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <form wire:submit="save">
            <div class="mb-4">
                <x-label>Nombre</x-label>
                <x-input class="w-full" wire:model="postCreate.title" ></x-input>
                @error('postCreate.title')
                <x-input-error for="postCreate.title"></x-input-error>
                @enderror
            </div>
            <div class="mb-4">
                <x-label>Contenido</x-label>
                <x-textarea class="w-full" wire:model="postCreate.content" ></x-textarea>
                @error('postCreate.content')
                <x-input-error for="postCreate.content"></x-input-error>
                @enderror
            </div>
            <div class="mb-4">
                <x-label>Categoria</x-label>
                <x-select class="w-full" wire:model="postCreate.category_id">
                    <option value="" disabled>
                        Seleccione una categoria
                    </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
                @error('postCreate.category_id')
                <x-input-error for="postCreate.category_id"></x-input-error>
                @enderror
            </div>
            <div class="mb-4">
                <x-label>Etiquetas</x-label>
                <ul>
                    @foreach ($tags as $tag)
                        <li>
                            <label>
                                <x-checkbox wire:model="postCreate.tags" value="{{$tag->id}}"/>
                                {{ $tag->name }}
                            </label>
                        </li>
                    @endforeach
                    @error('postCreate.tags')
                    <x-input-error for="postCreate.tags"></x-input-error>
                    @enderror
                </ul>
            </div>
            <div class="flex justify-end">
                <x-button>
                    Crear
                </x-button>
            </div>
        </form>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <ul class="list-disc list-inside">
            @foreach ($posts as $post)
                <li class="flex justify-between space-y-2 my-4" wire:key="post-{{$post->id}}">
                    {{$post->title}}
                    <div>
                        <x-button wire:click="edit({{$post->id}})">
                            Editar
                        </x-button>
                        <x-danger-button wire:click="destroy({{$post->id}})">
                            Eliminar
                        </x-danger-button>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>
    {{-- formulario de edicion --}}
    <x-dialog-modal wire:model="open">
        <form wire:submit="update">
        <x-slot name="title">
            Actualizar Post
        </x-slot>
        <x-slot name="content">

                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model="postEdit.title" required></x-input>
                </div>
                <div class="mb-4">
                    <x-label>Contenido</x-label>
                    <x-textarea class="w-full" wire:model="postEdit.content" required></x-textarea>
                </div>
                <div class="mb-4">
                    <x-label>Categoria</x-label>
                    <x-select class="w-full" wire:model="postEdit.category_id" required>
                        <option value="" disabled>
                            Seleccione una categoria
                        </option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul>
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    <x-checkbox wire:model="postEdit.tags" value="{{$tag->id}}"/>
                                    {{ $tag->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>


        </x-slot>
        <x-slot name="footer">
            <div class="flex justify-end">
                <x-danger-button
                    class="mr-2"
                    wire:click="$set('open', false)"
                >
                    Cancelar
                </x-danger-button>
                <x-button>
                    Actualizar
                </x-button>
            </div>
        </x-slot>
    </form>
    </x-dialog-modal>

</div>
