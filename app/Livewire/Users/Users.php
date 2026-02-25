<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

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

    public function render()
    {
        // Make sure to query User model and paginate
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate($this->per_page);

        return view('livewire.users.users', [
            'users' => $users, // pass the paginated results to Blade
        ]);
    }
}