<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
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

    // public function rules()
    // {
    //     return [
    //         'postCreate.category_id' => 'required|exists:categories,id',
    //         'postCreate.content' => 'required',
    //         'postCreate.title' => 'required',
    //         'postCreate.tags' => 'required|array',
    //     ];
    // }

    // public function messages()
    // {
    //     return [
    //         'postCreate.category_id.required' => 'El campo categoria es obligatorio'
    //     ];
    // }
    // public function validationAttributes()
    // {
    //     return [
    //         'postCreate.category_id' => 'categoria'
    //     ];
    // }
    public PostCreateForm $postCreate;
    public $posts;
    
    public PostEditForm $postEdit;

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function save()
    {
        $this->postCreate->save();
        $this->posts = Post::all();
    }

    public function edit($post)
    {
        $this->resetValidation();
        $this->postEdit->edit($post);

    }

    public function update()
    {
        dd('sdfasff');
        $this->postEdit->update();
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
