<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostEditForm extends Form
{
    public $open = false;
    public $postId = '';

    #[Rule('required', message: 'El campo es requerido')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required')]
    public $category_id = ''; 

    #[Rule('required|array')]
    public $tags = [];

    public function edit($post)
    {
        $this->open = true;
        $this->postId = $post;
        $post = Post::find($this->postId);
        $this->category_id = $post->category_id;
        $this->content = $post->content;
        $this->title = $post->title;
        $this->tags = $post->tags->pluck('id')->toArray();
    }

    public function update()
    {
        dd('dsffasf');
        $this->validate();
        $post = Post::find($this->postId);
        
        $post->update([
            $this->only('title', 'content', 'category_id')
        ]);
        
        $post->tags()->sync($this->tags);
        $this->reset(['category_id','title','content','selectedTags', 'open']);
        
    }
}
