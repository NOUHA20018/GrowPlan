<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($cours as $cour)
        <div class="course-card bg-white">
            <a href="{{ route('formateur.courses.showCour', $cour->id) }}">
                <img class="course-image" src="{{ asset('Cours/'.$cour->id.'/'.$cour->image) ?: asset('Cours/default-image.jpg') }}" alt="Course Image">
            </a>
            <div class="course-body">
                <h3 class="course-title">{{ $cour->title }}</h3>
                <div class="course-meta">
                    <i class="fas fa-tag"></i>
                    <span>{{ $cour->categorie->title }}</span>
                </div>
                <div class="course-meta">
                    <i class="fas fa-user"></i>
                    <span>{{ $cour->user->name }}</span>
                </div>
                <div class="course-meta">
                    <i class="fas fa-list-ol"></i>
                    <span>{{ $cour->chapitres->count() }} Chapitres</span>
                </div>
                <div class="course-price">
                    ${{ number_format($cour->prix, 2) }}
                </div>
                <div class="course-actions">
                    <a href="{{ route('formateur.courses.showCour', $cour->id) }}" 
                    class="btn-show px-3 py-1 rounded text-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('formateur.courses.info', $cour->id) }}" 
                    class="btn-edit px-3 py-1 rounded text-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ route('formateur.cours.destroy', $cour->id) }}" class="delete-cours-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete px-3 py-1 rounded text-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">Aucun cours disponible pour le moment.</p>
        </div>
    @endforelse
                </div>