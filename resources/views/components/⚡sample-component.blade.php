<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\User;

new class extends Component
{
    use WithPagination;
    public $per_page=10;
    public $query = '';

    #[Computed]
    public function users()
    {
        return User::where('name', 'like', '%'.$this->query.'%')->paginate($this->per_page);
    }

    public function search()
    {
        $this->resetPage();
    }
};
?>

<div>
    <flux:input wire:model.live="query" placeholder="Search" />

    <h1>Table</h1>
    <flux:select wire:model.live="per_page" placeholder="Choose industry...">
        <flux:select.option value="10">10</flux:select.option>
        <flux:select.option value="50">50</flux:select.option>
        <flux:select.option value="75">75</flux:select.option>
        <flux:select.option value="100">100</flux:select.option>
    </flux:select>
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($this->users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">
                        {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('F d, Y') : 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $this->users->links() }}
</div>