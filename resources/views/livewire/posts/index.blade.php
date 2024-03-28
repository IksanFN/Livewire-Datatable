<div class="card shadow">
    <div class="card-body">

        <div class="row mb-4">
            <div class="col-md-3">
                <label for="search" class="visually-hidden">Search...</label>
                <input type="search"
                       wire:model.live.debounce.500ms="query"
                       class="form-control"
                       placeholder="Search..."
                       id="search"/>
            </div>
            <div class="col-md-1">
                <select
                    wire:model.live="limit"
                    class="form-select" aria-label="Default select example">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="col-md-2">
                <select
                    wire:model.live.debounce.500ms="user"
                    class="form-select" aria-label="Default select example">
                    <option value="">Pilih Author</option>
                    <option value="Lind">Lind</option>
                    <option value="Arturo">Arturo</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select>
            </div>     
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Author</th>
                    {{-- <th scope="col">Created At</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $user)
                    <tr scope="row" wire:key="{{ $user->id }}">
                        <td>{{ $loop->index + $posts->firstItem() }}</td>
                        <td>{{ $user->title }}</td>
                        <td>{{ $user->body }}</td>
                        <td>{{ $user->user->name }}</td>
                        {{-- <td>{{ $user->created_at->format('d F, Y') }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <x-pagination :items="$posts"/>
    </div>
</div>
