<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;
    public $category_id = '', $title, $content;
    public $selectedTags = [];
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
        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);
        $post = Post::create(
            $this->only('category_id','title','content')
        );

        $post->tags()->attach($this->selectedTags);
        $this->reset(['category_id','title','content','selectedTags']);
        $this->posts = Post::all();
    }

    public function edit(Post $post)
    {
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
