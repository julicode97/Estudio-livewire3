<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Rule;

class Formulario extends Component
{
    public $categories, $tags;

    // #[Rule('required', message: 'El campo es requerido')]
    // public $title;

    // #[Rule('required')]
    // public $content;

    // #[Rule('required|exists:categories,id', as: 'categoria')]
    // public $category_id = ''; 

    // #[Rule('required|array')]
    // public $selectedTags = [];

    // #[Rule([
    //     'postCreate.category_id' => 'required|exists:categories,id',
    //     'postCreate.content' => 'required',
    //     'postCreate.title' => 'required',
    //     'postCreate.tags' => 'required|array',
    // ], [], [
    //    'postCreate.category_id' => 'categoria' 
    // ])]

    public function rules()
    {
        return [
            'postCreate.category_id' => 'required|exists:categories,id',
            'postCreate.content' => 'required',
            'postCreate.title' => 'required',
            'postCreate.tags' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'postCreate.category_id.required' => 'El campo categoria es obligatorio'
        ];
    }
    public function validationAttributes()
    {
        return [
            'postCreate.category_id' => 'categoria'
        ];
    }
    public $postCreate = [
        'category_id' => '',
        'content' => '',
        'title' => '',
        'tags' => [],
    ];
    public $posts;
    public $open = false;
    public $postEditId;
    public $postEdit = [
        'category_id' => '',
        'content' => '',
        'title' => '',
        'tags' => [],
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function save()
    {
        $this->validate();
        // $this->validate([
        //     'title' => 'required',
        //     'content' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'selectedTags' => 'required|array'
        // ],[],[
        //     'category_id' => 'categoria',
        //     'selectedTags' => 'etiquetas'
        // ]);
        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);
        // $post = Post::create(
        //     $this->only('category_id','title','content')
        // );

        $post = Post::create([
            'category_id' => $this->postCreate['category_id'],
            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content']
        ]);

        // $post->tags()->attach($this->selectedTags);
        $post->tags()->attach($this->postCreate['tags']);
        $this->reset(['postCreate']);
        $this->posts = Post::all();
    }

    public function edit(Post $post)
    {
        $this->resetValidation();
        $this->open = true;
        $this->postEditId = $post->id;
        $this->postEdit['category_id'] = $post->category_id;
        $this->postEdit['content'] = $post->content;
        $this->postEdit['title'] = $post->title;
        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();

    }

    public function update()
    {
        $post = Post::find($this->postEditId);
        $post->update([
            'category_id' => $this->postEdit['category_id'],
            'content' => $this->postEdit['content'],
            'title' => $this->postEdit['title'],
        ]);
        $post->tags()->sync($this->postEdit['tags']);
        $this->reset(['category_id','title','content','selectedTags', 'open']);
        $this->posts = Post::all();

    }

    public function destroy(Post $post)
    {
        $post->delete();
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
