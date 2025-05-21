<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/formateur/addChapter.css')}}">
      
        <h1 class="text-3xl p-6 mt-5 font-bold text-gray-800">Add Chapter</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form class="space-y-6" id="chapterForm" action="{{route('formateur.chapters.store',$id)}}" method="POST" class="space-y-6" enctype="multipart/form-data">
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
                        <label class="block text-sm font-medium text-gray-700">Duree</label>
                        <input type="number" name="duree"
                                class="mt-1 block w-full border @error('duree') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                                value="{{ old('duree') }}">
                            @error('duree')
                                <p class="text-red-600 text-sm mt-1"> {{ $message }}</p>
                                @enderror
                            </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Video</label>
                            <input type="file" id="uploadVideo" name="video"
                            class="mt-1 block w-full border @error('video') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                            placeholder="Titre du cours" value="{{ old('video') }}">
                            @error('video')
                            <p class="text-red-600 text-sm mt-1"> {{ $message }}</p>
                            @enderror
                            <input type="hidden" name="video" id="uploadedVideoName">
                            <div id="upload-progress"></div>
                        </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Resume</label>
                        <input type="file" name="resume"
                            class="mt-1 block w-full border @error('resume') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm"
                            value="{{ old('resume') }}">
                        @error('resume')
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
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
        <script src="{{ asset('assets/js/formateur/chapterUpload.js') }}"></script>
    @endpush

</x-app-layout>
