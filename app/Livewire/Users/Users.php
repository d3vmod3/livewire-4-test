<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Attributes\Computed;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $per_page = 10;

    // Reset page when search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $query = '';

    #[Computed]
    public function users()
    {
        return User::where('name', 'like', '%'.$this->query.'%')->paginate($this->per_page);
    }

    public function render()
    {
        return view('livewire.users.users');
    }
}