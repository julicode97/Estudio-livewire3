<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostCreateForm extends Form
{
    #[Rule('required', message: 'El campo es requerido')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required')]
    public $category_id = ''; 


    #[Rule('required|array')]
    public $tags = [];

    public function save()
    {
        $this->validate();
        // dd($this->postCreate->only('title', 'content', 'category_id'));

        $post = Post::create(
            $this->only('title', 'content', 'category_id')
        );

        $post->tags()->attach($this->tags);

        $this->reset();
    }
}
