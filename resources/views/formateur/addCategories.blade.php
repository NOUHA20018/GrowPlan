<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/addCategorie.css') }}">
        
    </x-slot>

    <div class="py-12">
        <div class="form-container">
            <div class="form-card">
                <h1 class="form-title">Crée nouveau categorie</h1>
                
                <form action="{{ route('formateur.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="title" class="form-label">Titre de Categorie</label>
                        <input type="text" id="title" name="title" 
                               class="form-input @error('title') form-input-error @enderror" 
                               placeholder="Enter category title" 
                               value="{{ old('title') }}">
                        @error('title')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="3"
                                  class="form-input @error('description') form-input-error @enderror"
                                  placeholder="Enter category description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"> Image de Categorie</label>
                        <div class="file-input-container">
                            <label for="image" class="file-input-label">
                                <svg class="file-input-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="file-input-text">Choisir une image</span>
                            </label>
                            <input type="file" id="image" name="image" 
                                   class="file-input @error('image') form-input-error @enderror"
                                   onchange="previewImage(this)">
                            @error('image')
                                <p class="error-message">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="image-preview" id="imagePreview">
                            <img id="previewImage" src="#" alt="Preview" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" id="slug" name="slug" 
                               class="form-input @error('slug') form-input-error @enderror" 
                               placeholder="auto-generated-slug" 
                               value="{{ old('slug') }}">
                        @error('slug')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" 
                                class="form-input form-select @error('status') form-input-error @enderror">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="desactive" {{ old('status') == 'desactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        Crée categorie
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('previewImage');
            const previewContainer = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = '';
                previewContainer.style.display = 'none';
            }
        }
        
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special chars
                .replace(/[\s_-]+/g, '-')  // Replace spaces and underscores with -
                .replace(/^-+|-+$/g, '');  // Trim - from start and end
            
            document.getElementById('slug').value = slug;
        });
    </script>
</x-app-layout>