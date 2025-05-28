@extends('layoutsAdmin.adminApp')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-bell mr-2 text-blue-500"></i> Notifications
        </h1>
        <div class="flex space-x-2">
            <button class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                <i class="fas fa-check-circle mr-1"></i> Tout marquer comme lu
            </button>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                <i class="fas fa-trash-alt mr-1"></i> Supprimer tout
            </button>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
       
        <div class="divide-y divide-gray-200">
            @forelse($notifications as $notification)
            <div class="p-4 hover:bg-gray-50 transition-colors duration-150 {{ $notification->is_read ? 'bg-white' : 'bg-blue-50' }}">
                <div class="flex items-start">
                    <div class="flex-shrink-0 pt-1">
                        @if($notification->type === 'new_course')
                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-book text-blue-500"></i>
                        </div>
                        @elseif($notification->type === 'new_categorie')
                        <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-tags text-purple-500"></i>
                        </div>
                        @else
                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-gray-500"></i>
                        </div>
                        @endif
                    </div>

                    <div class="ml-3 flex-1">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $notification->message }}
                                @if(!$notification->is_read)
                                <span class="ml-2 inline-block h-2 w-2 rounded-full bg-blue-500"></span>
                                @endif
                            </p>
                            <span class="text-xs text-gray-500">
                                {{ $notification->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-user mr-1"></i> Crée par :{{ $notification->user->name }}
                        </p>
                        <div class="mt-2 flex space-x-3">
                            @if($notification->type === 'new_course')
                            <a href="{{ route('admin.cours.show', $notification->user_id) }}" 
                               class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                                <i class="fas fa-eye mr-1"></i> Voir le cours
                            </a>
                            @endif
                            <button class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-trash-alt mr-1"></i> Supprimer
                            </button>
                            @if(!$notification->is_read)
                            <button class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-green-600 hover:bg-green-700">
                                <i class="fas fa-check mr-1"></i> Marquer comme lu
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <i class="fas fa-bell-slash text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">Aucune notification</h3>
                <p class="mt-1 text-sm text-gray-500">Vous n'avez aucune notification pour le moment.</p>
            </div>
            @endforelse
        </div>

   
    </div>
</div>
@endsection