<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form wire:submit.prevent="save">
                <label>Nombre producto</label>
                <input type="text" wire:model="name" class="form-control mb-2">
                @error('name') <p class="error mb-2">{{ $message }}</p> @enderror

                <label>Descripción</label>
                <textarea cols="20" rows="5" wire:model="description" class="form-control mb-2"></textarea>
                @error('description') <p class="error mb-2">{{ $message }}</p> @enderror

                <label>Price</label>
                <input type="text" wire:model="price" class="form-control mb-2">
                @error('price') <p class="error mb-2">{{ $message }}</p> @enderror

                <label>Thumbnail</label>
                <input type="file" wire:model="thumbnail" class="form-control mb-2">
                @if ($thumbnail)
                    <img src="{{ $thumbnail->temporaryUrl() }}" class="img-fluid mb-2">
                @endif

                @error('thumbnail') <p class="error mb-2">{{ $message }}</p> @enderror
                <button type="submit" class="btn btn-outline-primary btn-block">Save Photo</button>
            </form>
        </div>
    </div>
</div>