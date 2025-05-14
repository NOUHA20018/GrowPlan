<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
        <h1 class="text-3xl mt-4 p-6 font-bold text-gray-800">Add Courses</h1>

    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md shadow">
                    {{ session('success') }}
                </div>
                 @endif

                <form action="{{route('formateur.courses.store')}}" method="POST" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" name="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('image') border-red-500 @enderror" value="{{ old('image') }}">
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Titre</label>
                        <div class="flex items-center">
                            <input type="text" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('title') border-red-500 @enderror" placeholder="Titre du cours" value="{{ old('title') }}">
                            @error('title')
                                <svg class="w-5 h-5 text-red-500 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @enderror
                        </div>
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('description') border-red-500 @enderror" placeholder="Description du cours">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prix</label>
                        <input type="number" name="prix" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('prix') border-red-500 @enderror" placeholder="Prix en MAD" value="{{ old('prix') }}">
                        @error('prix')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date de Création</label>
                        <input type="date" name="date_creation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('date_creation') border-red-500 @enderror" value="{{ old('date_creation') }}">
                        @error('date_creation')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select name="categorie_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('categorie_id') border-red-500 @enderror">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach ($categories as $categorie )
                                <option value="{{$categorie->id}}" {{old('categorie_id')==$categorie->id ?"selected":''}}>{{$categorie->title}}</option>
                            @endforeach
                        </select>
                        @error('categorie')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror

                        <a href="{{ route('formateur.categories.create',['from' => 'cours']) }}" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow hover:bg-blue-600 mt-2 inline-block">Ajouter Catégorie</a>
                        {{-- Champ caché donnant l'origine de l'appel --}}
                         <input type="hidden" name="from" value="{{ $from }}">
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-black rounded-md shadow hover:bg-blue-600">Enregistrer</button>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
