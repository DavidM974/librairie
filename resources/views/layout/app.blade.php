<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link
	href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
	rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer>
  

  </script>
  <style>
    [x-cloak] { display: none }
  </style>
</head>
<body class="">
   @include('layout.header')
   <main>

    <x-form.input/>
     <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
       <!-- Replace with your content -->
       @include('component.messageFlash')
       @yield('main')
       <!-- /End replace -->
     </div>
   </main>
 </div> 
 @include('layout.footer')

   
</body>
</html>
    
