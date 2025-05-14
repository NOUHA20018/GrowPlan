<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $categorie)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="p-4">
                      <a href="{{route('formateur.categories.show',$categorie->id)}}"><img style="width: 100%; height: 220px;" src="{{asset('categories/'.$categorie->id.'/'.$categorie->image) ?: asset('default-image.jpg')}}" alt="categoriese Image"></a>
                      <h2 class="text-xl font-bold mb-2">{{ $categorie->title}}</h2>
                      <p>{{$categorie->description}}</p>
                      <strong>Slug: </strong><p>{{$categorie->slug}}</p>
                      <strong>Creator:</strong><p>{{$categorie->user->name}}</p>
                      <div class="flex justify-around">
                         <a href="{{ route('formateur.categories.show', $categorie->id) }}" style="background-color: cadetblue;margin-right:5px" class=" text-white text-sm px-3 py-1 rounded-lg">Détails</a>
                        {{-- <form method="POST"
                         class="delete-categorie-form" data-id="{{$categorie->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded-lg">Supprimer</button>
                        </form> --}}
                      </div>
                    </div>
                </div>
                @empty
                <p>No categories available at the moment.</p>
            @endforelse
        </div>