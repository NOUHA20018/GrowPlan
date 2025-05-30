
@extends('layoutsAdmin.adminApp')
@section('content')
<div class="flex h-screen bg-gray-100">
    <div class="flex-1 overflow-auto ">
    <div class="container mx-auto px-4 py-6 ">
        @if(request()->routeIs('admin.cours.attente'))
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 bg-blue-600 text-white">
                <h3 class="text-lg font-semibold"><i class="fas fa-clock mr-2"></i> Cours en attente de validation</h3>
            </div>
            <br>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Succès !</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erreur !</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($enAttenteCourses as $course)
                <div class="p-4 hover:bg-gray-50 transition-colors text-center">
                    <div class="m-3 p-4">
                        <div>
                            <img src="{{asset('Cours/'.$course->id.'/'.$course->image)}}" alt="{{$course->title}}">
                            <h4 class="font-medium">{{ $course->title }}</h4>
                            <p class="text-sm text-gray-600">Par {{ $course->user->nom .' '.$course->user->prenom }}</p>
                            <p class="text-xs text-gray-500 mt-1">Soumis le {{ $course->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div class="flex space-x-2 mt-3">
                            <a href="{{ route('admin.cours.show', $course->id) }}" 
                                class="px-3 py-1 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition-colors">
                                <i class="fas fa-eye mr-1"></i> Prévisualiser
                            </a>
                            <form action="{{ route('admin.cours.validate', $course->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition-colors">
                                    <i class="fas fa-check mr-1"></i> Valider
                                </button>
                            </form>
                            <form action="{{ route('admin.cours.refuse', $course->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-red-100 text-red-800 rounded hover:bg-red-200 transition-colors">
                                    <i class="fas fa-times mr-1"></i> Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    Aucun cours en attente de validation.
                </div>
                @endforelse
            </div>
        </div>
            @elseif(request()->routeIs('admin.cours.valides'))
            <!-- Cours validés -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 bg-green-600 text-white">
                    <h3 class="text-lg font-semibold"><i class="fas fa-check-circle mr-2"></i> Cours validés</h3>
                </div>
                    <br>
                @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Succès !</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Erreur !</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse ($validesCourses as $course)
                    <div class="p-4 hover:bg-gray-50 transition-colors text-center">
                        <div class="m-3 p-4">
                            <div>
                                <img src="{{asset('Cours/'.$course->id.'/'.$course->image)}}" alt="{{$course->title}}">
                                <h4 class="font-medium">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600">Par {{ $course->user->nom .' '.$course->user->prenom }}</p>
                                <p class="text-xs text-gray-500 mt-1">Soumis le {{ $course->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="flex space-x-2 mt-3">
                                <a href="{{ route('admin.cours.show', $course->id) }}" 
                                    class="px-3 py-1 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Prévisualiser
                                </a>
                                <form action="{{ route('admin.cours.enattente', $course->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition-colors">
                                        <i class="fas fa-check mr-1"></i> Annulé validation
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">
                        Aucun cours validé pour le moment.
                    </div>
                    @endforelse
                </div>
            </div>
            @elseif(request()->routeIs('admin.cours.refuses'))
            <!-- Cours refusés -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 bg-red-600 text-white">
                    <h3 class="text-lg font-semibold"><i class="fas fa-times-circle mr-2"></i> Cours refusés</h3>
                </div>
                <br>
                @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Succès !</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Erreur !</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif 
                
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse ($refusesCourses as $course)
                    <div class="p-4 hover:bg-gray-50 transition-colors text-center">
                        <div class="m-3 p-4">
                            <div>
                                <img src="{{asset('Cours/'.$course->id.'/'.$course->image)}}" alt="{{$course->title}}">
                                <h4 class="font-medium">{{ $course->title }}</h4>
                                <p class="text-sm text-gray-600">Par {{ $course->user->nom .' '.$course->user->prenom }}</p>
                                <p class="text-xs text-gray-500 mt-1">Soumis le {{ $course->created_at->format('d/m/Y') }}</p>
                            </div>
                            <div class="flex space-x-2 mt-3">
                                <a href="{{ route('admin.cours.show', $course->id) }}" 
                                    class="px-3 py-1 bg-blue-100 text-blue-800 rounded hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Prévisualiser
                                </a>
                                <form action="{{ route('admin.cours.enattente', $course->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-100 text-green-800 rounded hover:bg-green-200 transition-colors">
                                        <i class="fas fa-check mr-1"></i> Annulé refusion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">
                        Aucun cours refusé pour le moment.
                    </div>
                    @endforelse
                </div>
            </div>
            @elseif(request()->routeIs('admin.formateurs'))
            <div>
                <table class="min-w-full divide-y divide-gray-200 mt-6">
                    <thead class="bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N°</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Complet</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nbr Categories</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nbr Cours</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours Validés/Refusés</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nbr Inscripteur</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quizz</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gains Totaux</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300">
                        @foreach($formateurs as $index => $formateur)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $formateur->name }} {{ $formateur->prenom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formateur->categories_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formateur->cours_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formateur->cours_valides_count ?? 0 }} / {{ $formateur->cours_refuse_count ?? 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formateur->coursInscrits_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formateur->formateurQuizzes_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $formateur->total_earnings ?? 0 }} DH</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                
                        <form class=" rounded-md px-4 py-2 text-bold text-white bg-red-600 hover:bg-red-900 hover:text-white" action="{{route('admin.deleteFormateur',$formateur->id)}}" method="post">
                                @csrf 
                                @method('delete')
                                <button  type="submit">supprimer</button>
                            </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @else
            <!-- Dashboard principal -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fas fa-book-open text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500">Cours en attente</h3>
                            <p class="text-2xl font-bold">{{ $enAttenteCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fas fa-check-circle text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500">Cours validés</h3>
                            <p class="text-2xl font-bold">{{ $valideCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4">
                            <i class="fas fa-times-circle text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500">Cours refusés</h3>
                            <p class="text-2xl font-bold">{{ $refuseCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

        <div class="divide-y divide-gray-200">
                    @forelse ($lastCours as $cour)
                    <div class="p-5 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex flex-col md:flex-row md:items-center">
                            <div class="md:w-1/6 mb-4 md:mb-0 md:pr-4">
                                @if($cour->image)
                                    <img src="{{ asset('Cours/'.$cour->id.'/'.$cour->image) }}" 
                                            alt="Image du cours" 
                                            class="w-full h-32 object-cover rounded-lg shadow-sm">
                                @else
                                    <div class="w-full h-32 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-book-open text-3xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="md:w-4/6">
                                <h4 class="font-semibold text-lg text-gray-800 mb-1">{{ $cour->titre }}</h4>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($cour->description, 150) }}</p>
                                
                                <div class="flex flex-wrap items-center text-xs text-gray-500 space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-1"></i>
                                        {{ $cour->user->name ?? 'Formateur inconnu' }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        {{ $cour->created_at->format('d/m/Y') }}
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $cour->created_at->diffForHumans() }}
                                    </span>
                                    <span class="flex items-center">
                                        @if($cour->status == 'en_attente')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">
                                                En attente
                                            </span>
                                        @elseif($cour->status == 'valide')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                                Validé
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                                Refusé
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Actions -->
                            <div class="md:w-1/6 mt-4 md:mt-0 flex md:justify-end">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.cours.show', $cour->id) }}" 
                                        class="px-3 py-1 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100 transition-colors text-sm flex items-center">
                                        <i class="fas fa-eye mr-1"></i> Voir
                                    </a>
                                    @if($cour->status == 'en_attente')
                                    <form action="{{ route('admin.cours.validate', $cour->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="px-3 py-1 bg-green-50 text-green-600 rounded-md hover:bg-green-100 transition-colors text-sm flex items-center">
                                            <i class="fas fa-check mr-1"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-book-open fa-3x mb-4 text-gray-300"></i>
                        <p class="text-lg">Aucun cours récent</p>
                    </div>
                    @endforelse
                </div>

            
            @endif
        </div>
    </div>
    </div>
@endsection