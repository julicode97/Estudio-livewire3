<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class CreatePost extends Component
{
    //Arrays, string, integer, float, boolean, null
    //collection, modelos, datatime, carbon, etc

    public $title, $user;
    public $name, $email;

    public function mount(User $user){
        // $this->user = $user;
        // $this->name = $user->name;
        // $this->email = $user->email;
        //para extraer los campos
        $this->fill(
            $user->only('name', 'email')
        );

    }

    public function save()
    {
        // dd($this->name);
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
