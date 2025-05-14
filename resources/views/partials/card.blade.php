<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($cours as $cour)
        <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
            <div class="p-4">
                <a href="{{route('formateur.courses.info',$cour->id)}}">
                <img style="width: 100%; height: 220px;" src="{{asset('Cours/'.$cour->id.'/'.$cour->image) ?: asset('Cours/default-image.jpg')}}" alt="Course Image"></a>
                <h2 class="text-xl font-bold mb-2">{{ $cour->title }}</h2>
                <div class="product-cell category text-gray-500">{{$cour->categorie->title}}</div>
                <div class="row">
                <img class="col-sm-6" src="" alt="img">{{$cour->user->profile}}
                <div class=" col-sm-6 product-cell stock">{{$cour->user->name}}</div>
                </div>
                <div class="product-cell price">$ {{$cour->prix}}</div>
                @if($cour->chapitres->count()>0)
                    <div class="product-cell price">{{$cour->chapitres->count()}} Chapters</div>
                @endif

            </div>
        </div>
        @empty
                <p>No courses available at the moment.</p>
            @endforelse
</div>