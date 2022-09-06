<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		{{-- Boostrap CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        {{-- Bootstrap Icons --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
        {{-- Favicon --}}
        <link rel="shortcut icon" href="/img/favicon.png" type="image/png">
        
        {{-- Swiper --}}
        <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>

        {{-- Trix Editor --}}
        <link rel="stylesheet" type="text/css" href="/css/trix.css">
        <script type="text/javascript" src="/js/trix.js"></script>
    
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet" />

		<!-- Custom CSS -->
		<link rel="stylesheet" href="/css/dashboard.css" />

        <style>
            /* Menghilangkan Fitur Upload File di Trix Editor */
            trix-toolbar [data-trix-button-group="file-tools"]{
                display: none;
            }
        </style>
        
		<title>Studify | {{ $title }}</title>
	</head>
	<body>
		<div class="container-fluid p-3" style="background-color: #dedede">
			<div class="row mx-5" style="background-color: white; border-radius: 20px">

            {{-- Menambahkan Sidebar dari dashboard/layouts/sidebar --}}
            @include('dashboard.layouts.sidebar')

            {{-- Container (Isi) Keseluruhan Content View CRUD --}}
            <div class="col-sm-8 col-md-9 col-lg-10 border-start border-end border-1 p-5 min-vh-100">
              @yield('container')
            </div>
      </div>
    </div>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('trix-file-accept', function (e){
            e.preventDefault();
        })

		feather.replace()

        const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },
        });
    </script>
  </body>
</html>
