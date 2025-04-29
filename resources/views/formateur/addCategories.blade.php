<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
        <h1 class="text-3xl font-bold text-gray-800">Add Categorie</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{route('formateur.categories.store')}}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title"
                                class="mt-1 block w-full border @error('title') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                                placeholder="Titre du cours" value="{{ old('title') }}">
                            @error('title')
                                <p class="text-red-600 text-sm mt-1"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="description"
                                class="mt-1 block w-full border @error('description') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                                placeholder="Titre du cours" value="{{ old('description') }}">
                            @error('description')
                                <p class="text-red-600 text-sm mt-1"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image"
                                class="mt-1 block w-full border @error('image') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                                placeholder="Titre du cours" value="{{ old('image') }}">
                            @error('image')
                                <p class="text-red-600 text-sm mt-1"> {{ $message }}</p>
                            @enderror
                        </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" name="slug"
                            class="mt-1 block w-full border @error('slug') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                            value="{{ old('slug') }}">
                        @error('slug')
                            <p class="text-red-600 text-sm mt-1"> {{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full border @error('status') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm">
                        <option value="active" {{old('status')=="active"?"selected":''}}>active</option>
                            <option value="desactive"{{old('status')=="desactive"?"selected":''}}>desactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-sm mt-1">⚠ {{ $message }}</p>
                        @enderror
                    </div>
                    
                    
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow hover:bg-blue-600">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
