<x-app-layout>
    
    <x-slot name="header">
        <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/createCourse.css') }}">
        <h1 class="course-form-title">Add Course</h1>
    </x-slot>

    <div class="py-12">
        <div class="course-form-container">
            <div class="course-form-card">
                @if(session('success'))
                    <div class="course-form-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('formateur.courses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="course-form-group">
                        <label class="course-form-label">Image</label>
                        <input type="file" name="image" class="course-form-input @error('image') course-form-input-error @enderror" value="{{ old('image') }}">
                        @error('image')
                            <span class="course-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="course-form-group">
                        <label class="course-form-label">Title</label>
                        <div class="flex items-center">
                            <input type="text" name="title" class="course-form-input @error('title') course-form-input-error @enderror" placeholder="Course title" value="{{ old('title') }}">
                            @error('title')
                                <svg class="course-form-error-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @enderror
                        </div>
                        @error('title')
                            <span class="course-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="course-form-group">
                        <label class="course-form-label">Description</label>
                        <textarea name="description" class="course-form-input @error('description') course-form-input-error @enderror" placeholder="Course description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="course-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="course-form-group">
                        <label class="course-form-label">Price (MAD)</label>
                        <input type="number" name="prix" class="course-form-input @error('prix') course-form-input-error @enderror" placeholder="Price in MAD" value="{{ old('prix') }}">
                        @error('prix')
                            <span class="course-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="course-form-group">
                        <label class="course-form-label">Creation Date</label>
                        <input type="date" name="date_creation" class="course-form-input @error('date_creation') course-form-input-error @enderror" value="{{ old('date_creation') }}">
                        @error('date_creation')
                            <span class="course-form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="course-form-group">
                        <label class="course-form-label">Category</label>
                        <select name="categorie_id" class="course-form-input course-form-select @error('categorie_id') course-form-input-error @enderror">
                            <option value="">Select a category</option>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->title }}</option>
                            @endforeach
                        </select>
                        @error('categorie_id')
                            <span class="course-form-error">{{ $message }}</span>
                        @enderror
                        
                        <a href="{{ route('formateur.categories.create', ['from' => 'cours']) }}" class="course-form-add-category">
                            + Add New Category
                        </a>
                        <input type="hidden" name="from" value="{{ $from }}">
                    </div>

                    <button type="submit" class="course-form-submit">
                        Save Course
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>