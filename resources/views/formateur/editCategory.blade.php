<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/edittCour.css') }}">
    <h2 class="header">
      {{ __('📚 Informations du categorie') }}
    </h2>
  </x-slot>

  <div class="container">
    <form action="{{ route('formateur.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
      @method('PATCH')
      @csrf
      <div class="form-container">
        <div class="left-column">
          <div class="form-group">
            <div class="flex justify-between ">
            <label for="title-input"><strong>Title :</strong></label>
            <button type="button" onclick="enableEdit('title-input')" class=" text-sm edit-button">✏️Edit Title</button>
            </div>
            <div class="input-group">
              <input id="title-input" type="text" name="title" class="input" value="{{ $category->title }}" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="flex justify-between ">
            <label for="description-input"><strong>Description :</strong></label>
            <button type="button" onclick="enableEdit('description-input')" class="text-sm edit-button">✏️ Edit Description</button>
            </div>
            <div class="input-group">
              <textarea id="description-input" name="description" class="textarea" rows="3" readonly>{{ $category->description }}</textarea>
            </div>
          </div>

          <div class="form-group">
            <div class="flex justify-between ">
            <label for="image-input"><strong>Image :</strong></label>
            <button type="button" onclick="enableEdit('image-input')" class="text-sm edit-button">✏️edit Image</button>
        </div>
        <input type="file" name="image" class="file-input" readonly>
            <img class="image" src="{{ asset('Categories/'.$category->id.'/'.$category->image) ?: asset('category/default-image.jpg') }}" alt="categorye Image">
          </div>

        </div>
        <div class="right-column">
          <div class="form-group">
            <div class="flex justify-between ">
            <label><strong>Slug :</strong></label>
            <button type="button" onclick="enableEdit('slug-input')" class="text-sm edit-button">✏️Edit Slug</button>
            </div>
            <div class="input-group">
              <input id="slug-input" type="text" name="slug" class="input" value="{{ $category->slug }}" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="flex justify-between ">
            <label ><strong>Status :</strong></label>
            <button type="button" onclick="enableEdit('status-input')" class="text-sm edit-button">✏️Edit Status</button>
            </div>
            <div class="input-group">
             <select name="status" id="" aria-readonly="true">
                <option value="active" {{$category->status == 'active'?'selected':''}} >Active</option>
                <option value="desactive" {{$category->status == 'desactive'?'selected':''}}>Desactive</option>
             </select>
            </div>
          </div>

          <div class="form-group">
            <label for="formateur"><strong>Formateur :</strong></label>
            <input type="text" class="input" value="{{ $category->user->name }}" readonly>
          </div>
        </div>
      </div>    
      <div class="save-button-container">
        <button type="submit" class="save-button">
          💾 Enregistrer
        </button>
      </div>
    </form>
  </div>
</x-app-layout>

<script>
  function enableEdit(id) {
    const input = document.getElementById(id);
    input.removeAttribute('readonly');
    input.focus();
    input.classList.add('editable');
  }

 
</script>
