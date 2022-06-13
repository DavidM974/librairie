<script>
  function imageViewer(src='') {
  return {
    imageUrl: src,

    fileChosen(event) {
      this.fileToDataUrl(event, src => this.imageUrl = src)
    },

    fileToDataUrl(event, callback) {
      if (! event.target.files.length) return

      let file = event.target.files[0],
          reader = new FileReader()

      reader.readAsDataURL(file)
      reader.onload = e => callback(e.target.result)
    },
  }
}
</script>

 @if ($errors->any()) <div x-data="{ modelOpen: true }"> @else  <div x-data="{ modelOpen: false }"> @endif
    <button @click="modelOpen =!modelOpen" class=" flex items-center justify-center form-button">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>

        <span>Ajouter un livre</span>
    </button>

    <div x-show="modelOpen"  class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" 
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
            ></div>

            <div x-cloak x-show="modelOpen" 
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
            >
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium text-gray-800 ">Ajouter un livre</h1>

                    <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </button>
                </div>

                <p class="mt-2 text-sm text-gray-500 ">
                    Ajouter un livre à votre bibliothèque
                </p>
               
                <form class="mt-5" method="POST" action="/livres" enctype="multipart/form-data">
                    @csrf
                    <div>
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <label for="title" class="label">Titre du livre</label>
                        @error('title') 
                            <p class=" text-sm text-red-500 mt-0 py-0">
                                Veuillez entrer un titre :
                            </p>
                            @enderror
                        <input placeholder="Votre titre" name="title" type="text" value="{{ old('title')}}" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                    </div>

                    <div class="mt-4">
                        <div>
                            <label for="description" class="label">Description</label>
                            @error('description') 
                            <p class=" text-sm text-red-500 mt-0 py-0">
                                Veuillez entrer une description
                            </p>
                            @enderror
                            <textarea  class="label" class="" name="description" id="description" cols="30" rows="10">{{ old('description')}}</textarea>
                        </div>
                        <div>
                        <label class="block text-sm font-medium text-gray-700"> Image du llivre </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <div x-data="imageViewer('/images/livres/default-placeholder.png')">
                                    <div class="mb-2">
                                      <!-- Show the image -->
                                      <template x-if="imageUrl">
                                        <img :src="imageUrl" 
                                             class="object-cover rounded border border-gray-200" 
                                             style="width: 100px; height: 100px;"
                                        >
                                      </template>
                                      
                                      <!-- Show the gray box when image is not available -->
                                      <template x-if="!imageUrl">
                                        <div 
                                             class="border rounded border-gray-200 bg-gray-100" 
                                             style="width: 100px; height: 100px;"
                                        ></div>
                                      </template>
                                      
                            
                                      
                                    </div>
                                  </div>
                            </div>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                
                                    @error('image') 
                                    <p class=" text-sm text-red-500 mt-0 py-0">
                                        Veuillez entrer une image
                                    </p>
                                    @enderror    
                                    <span>Uploader un fichier</span>
                                <input id="image" name="image" type="file" class="sr-only"  @change="fileChosen">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                        </div>
                        
                        <div>
                            <label for="description" class="label">Pages</label>
                            @error('pages') 
                            <p class=" text-sm text-red-500 mt-0 py-0">
                                Veuillez entrer le nombre de pages
                            </p>
                            @enderror
                            <input type="text" class="" name="pages" id="pages" placeholder="Entrer le nombre de page" value="{{ old('pages') }}">
                        </div>
                        <div>
                            <label for="author" class="label">Choix de l'auteur</label>
                            @error('authors') 
                            <p class=" text-sm text-red-500 mt-0 py-0">
                                Veuillez choisir un auteur
                            </p>
                            @enderror
                            <select name="authors" id="authors" class="form-select  " aria-label="Default select example">
                             @foreach ($authors as $author)
                             <option value="{{$author->id}}" {{ (old("authors") ==  $author->id  ? " selected":"") }}>{{$author->firstname}} {{$author->lastname}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                           
                        <div>
                        <label for="author" class="label">Choix des categories</label>
                        @error('categories') 
                        <p class=" text-sm text-red-500 mt-0 py-0">
                            Veuillez choisir au moins une categories
                        </p>
                        @enderror
                        <select name="categories[]" id="categories"  class="form-select" multiple>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{ $category->label }}</option>
                            @endforeach
                        </select>
                        
                              </div>
                            
                        </div>
       
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







