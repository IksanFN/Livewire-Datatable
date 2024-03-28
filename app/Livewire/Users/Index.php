<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Users List')]

class Index extends Component
{
    use WithPagination;

    public string $query = '';

    public int $limit = 5;

    public function updated($property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $users = User::query()
        ->with('posts')
        ->withCount('posts')
        ->when($this->query, function ($query) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%'.$this->query.'%')
                    ->orWhere('email', 'like', '%'.$this->query.'%');
            });
        })
        ->latest()
        ->paginate($this->limit);
        return view('livewire.users.index', compact('users'));
    }
}
