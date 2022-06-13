

<div class="overflow-x-auto mt-6">
  

    


    <table class="table-auto border-collapse w-full">
      <thead>
        <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
          <th class="px-4 py-2 bg-gray-200 " style="background-color:#f8f8f8">Titre</th>
          <th class="px-4 py-2 " style="background-color:#f8f8f8">Image</th>
          <th class="px-4 py-2 " style="background-color:#f8f8f8">Author</th>
          <th class="px-4 py-2 " style="background-color:#f8f8f8">Categories</th>
          <th class="px-4 py-2 " style="background-color:#f8f8f8">NbPages</th>
          <th class="px-4 py-2 " style="background-color:#f8f8f8">Actions</th>
        </tr>
      </thead>
      <tbody class="text-sm font-normal text-gray-700">
        @foreach ($livres as $livre)
        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
          <td class="px-4 py-4"> <a href="/livres/{{$livre->id}}">{{$livre['title']}}</a></td>
          <td class="px-4 py-4">{!! $livre['image'] ? "<img width='80px'  src=' ".$livre->image."' >": "<img width='80px' src=\"/images/livres/default-placeholder.png\" >"  !!}</td>
          <td class="px-4 py-4"><a href="/authors/{{$livre->author->id}}">{{$livre->author->firstname}} {{$livre->author->lastname}}</a></td>
          <td class="px-4 py-4">
            @foreach ($livre->categories as $category)  
            <span class="m-1 bg-gray-200 hover:bg-gray-300 rounded-full px-2 py-1 font-bold text-sm leading-loose cursor-pointer" >
              <a href="/categories/{{$category->id}}"> {{$category->label}}</a>
            </span> 
            @endforeach
          </td>
          <td class="px-4 py-4">{{$livre->pages}}</td>
          <td class="px-4 py-4">
            @if(session()->has('user') and session()->get('user')->hasRole('ROLE_ADMIN'))
            <a href="/livres/{{$livre->id}}" class="text-gray-400 hover:text-gray-300  mx-2">
              <i class="material-icons-outlined text-base">edit</i>
            </a>
            <a href="/livres/del/{{$livre->id}}" class="text-gray-400 hover:text-gray-300  ml-2">
              <i class="material-icons-round text-base">delete_outline</i>
            </a>
            @endif
          </td>
        </tr>
       @endforeach
      </tbody>
    </table>
  </div>
     <div id="pagination" class="w-full flex justify-center border-t border-gray-100 pt-4 items-center">
      


{{ $livres->links() }}

 

      </div>
    </div>
  
  <style>
  
  thead tr th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px;}
  thead tr th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px;}
  
  tbody tr td:first-child { border-top-left-radius: 5px; border-bottom-left-radius: 0px;}
  tbody tr td:last-child { border-top-right-radius: 5px; border-bottom-right-radius: 0px;}
  
  
  </style>