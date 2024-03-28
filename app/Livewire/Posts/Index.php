<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Posts List')]
class Index extends Component
{
    use WithPagination;

    public string $user = '';

    public string $query = '';


    public int $limit = 10;

    public function updated($property): void
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function clear()
    {
        $this->resetPage();
    }

    public function render()
    {
        $posts = Post::query()
        ->with('user')
        ->withCount('user')
        ->when($this->query, function ($query) {
            $query->where(function ($query) {
                $query->where('title', 'like', '%'.$this->query.'%')
                    ->orWhere('body', 'like', '%'.$this->query.'%')
                    ->orWhereHas('user', function ($query) {
                    $query->where('name', 'like', '%'.$this->query.'%');
                });
            });
            
        })
        ->when($this->user, function($query) {
            $query->whereHas('user', function($query) {
                $query->where('name', 'like', '%'.$this->user.'%');
            });
        })
        ->latest()
        ->paginate($this->limit);
        return view('livewire.posts.index', compact('posts'));
    }
}
