<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOTOCF</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{
            margin:0;
            padding:0;
            background:url('/images/images.jpeg') no-repeat center center/cover;
            min-height:100vh;
        }

        .overlay{
            background:rgba(0,0,0,0.65);
            min-height:100vh;
            padding-bottom:50px;
        }

        .navbar{
            background:rgba(0,0,0,0.8);
        }

        .hero-title{
            color:white;
            margin-bottom:40px;
        }

        .hero-title h1{
            font-size:48px;
            font-weight:bold;
        }

        .hero-title p{
            font-size:20px;
            opacity:0.9;
        }

        .card{
            border:none;
            transition:0.3s;
            overflow:hidden;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .motor-img{
            height:220px;
            object-fit:cover;
        }

        .category-menu .card{
            border:none;
            overflow:hidden;
        }

        .category-menu .card-header{
            padding:18px;
            font-size:20px;
        }

        .category-menu .list-group-item{
            padding:16px 20px;
            font-size:17px;
            border:none;
            transition:0.2s;
            background:white;
        }

        .category-menu .list-group-item:hover{
            background:#f1f1f1;
            padding-left:28px;
        }

        .category-menu .list-group-item.active{
            background:#ffc107 !important;
            color:black !important;
            font-weight:bold;
        }

        .filter-box{
            background:rgba(255,255,255,0.12);
            padding:25px;
            border-radius:15px;
            backdrop-filter:blur(5px);
        }

        .pagination{
            --bs-pagination-bg: rgba(255,255,255,0.1);
            --bs-pagination-color: white;
            --bs-pagination-border-color: rgba(255,255,255,0.2);
        }

        .pagination .active .page-link{
            background:#ffc107;
            border-color:#ffc107;
            color:black;
        }

    </style>
</head>

<body>
     

<div class="overlay">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark px-4 py-3">

        <a class="navbar-brand fw-bold fs-3" href="/">
            MOTOCF
        </a>

        <div class="ms-3">
            @auth
            @if (auth()->user()->role === 'admin'&& auth()->user()->role === 'mechanic')
                 <a href="/" class="btn btn-outline-light btn-sm">
                Home
            </a>
              @endif
              @endauth
            <a href="/" class="btn btn-outline-light btn-sm">
                Home
            </a>
                 <a href="{{ route('main.create') }}" class="btn btn-outline-warning btn-sm ms-2">
                Maintenance
            </a>
            
             <a href="{{ route('maintenance.track.form') }}" class="btn btn-outline-light btn-sm me-2">
                    Mes Demandes
                </a>
                <a href="{{ route('rentale.track.form') }}" class="btn btn-outline-light btn-sm me-2">
                    Mes rentale
                </a>
                            

              
           
        </div>
        <div  class="ms-auto">
            <h4 class="m-0 fw-bold text-dark" style="letter-spacing: -0.5px;">
               @auth
        <span class="text-light me-3">
            Welcome, <strong>{{ auth()->user()->name }}</strong>
        </span>
        
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.index') }}" class="btn btn-warning btn-sm me-2">
                    Admin Dashboard
                </a>
            @elseif(auth()->user()->role === 'michanic')
                <a href="{{ route('mecanicien.maintenance.index') }}" class="btn btn-info btn-sm me-2">
                    Mécanicien Dashboard
                </a>
            
            @endif
         @endauth
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                Logout
            </button>
        </form>
    @endauth
            </h4>
           
        </div>
@guest
    <div class="ms-auto">
        <a href="{{ route('showLogin') }}" class="btn btn-warning btn-sm">
            Login
        </a>

        <a href="{{ route('rego.create') }}" class="btn btn-success btn-sm ms-2">
            Register
        </a>
    </div>
@endguest

    </nav>

    <!-- FILTER -->
    <div class="container mt-4">

        <div class="filter-box">

            <form method="GET" class="row g-3">

                <!-- SEARCH -->
                <div class="col-md-4">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search brand or model"
                    >
                </div>

                <!-- BRAND -->
                <div class="col-md-3">
                    <select name="brand" class="form-control">

                        <option value="">All Brands</option>

                        @foreach(['Honda', 'Yamaha', 'KTM', 'Beker', 'Cfmoto', 'BMW'] as $b)

                            <option
                                value="{{ $b }}"
                                {{ request('brand') == $b ? 'selected' : '' }}
                            >
                                {{ $b }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <!-- PRICE -->
                <div class="col-md-3">
                    <select name="price" class="form-control">

                        <option value="">Sort by price</option>

                        <option
                            value="low"
                            {{ request('price') == 'low' ? 'selected' : '' }}
                        >
                            Low → High
                        </option>

                        <option
                            value="high"
                            {{ request('price') == 'high' ? 'selected' : '' }}
                        >
                            High → Low
                        </option>

                    </select>
                </div>

                <!-- BTN -->
                <div class="col-md-2">
                    <button type="submit" class="btn btn-warning w-100">
                        Search
                    </button>
                </div>

            </form>

        </div>

    </div>

    <!-- MAIN -->
    <div class="container mt-5">

        <div class="row">

            <!-- LEFT MENU -->
            <div class="col-lg-3 mb-4 category-menu">

    <div class="card shadow-lg sticky-top" style="top:20px;">

        <div class="card-header bg-dark text-white fw-bold">
            <i class="bi bi-tags-fill text-warning me-2"></i>
            Categories
        </div>

        <div class="list-group list-group-flush">

            <a href="{{ url('/') }}" class="list-group-item list-group-item-action {{ !request('category') ? 'active' : '' }}">
                Tous les moteurs
            </a>

            @foreach($brand as $cat)
                @if(!empty($cat))
                    <a href="?category={{ urlencode($cat) }}"
                       class="list-group-item list-group-item-action {{ request('category') == $cat ? 'active' : '' }}">
                        {{ ucfirst($cat) }} </a>
                @endif
            @endforeach

        </div>

    </div>

</div>

            <!-- RIGHT CONTENT -->
            <div class="col-lg-9">

                <!-- TITLE -->
                <div class="hero-title text-center">

                    <h1>
                        Discover Our Motorcycles
                    </h1>

                    <p>
                        Buy or Rent your favorite motorcycle بسهولة
                    </p>

                </div>
                <div class="row">

                    @forelse($motorcycle as $motor)

                        <div class="col-lg-4 col-md-6 mb-4">

                            <div class="card shadow h-100">

                                <img
                                    src="{{ asset('storage/motos/'.$motor->photo) }}"
                                    class="card-img-top motor-img"
                                    alt="{{ $motor->model }}"
                                >

                                <div class="card-body d-flex flex-column justify-content-between">

                                    <div>

                                        <h5 class="fw-bold text-center">
                                            {{ $motor->brand }} {{ $motor->model }}
                                        </h5>

                                        <p class="text-muted mb-1">
                                            Year: {{ $motor->year }}
                                        </p>

                                        <p class="text-primary fw-bold mb-1">
                                            Buy: {{ $motor->price_buy }} MAD
                                        </p>

                                        <p class="text-success fw-bold mb-1">
                                            Rent: {{ $motor->price_rent_day }} MAD/day
                                        </p>

                                        <small class="text-muted d-block mb-3">
                                            Category: {{ $motor->categorie }}
                                        </small>

                                    </div>

                                    <div>

                                        <span class="badge bg-info w-100 mb-3">
                                            {{ $motor->status }}
                                        </span>
                                        <div class="d-flex gap-2">
                                           <a href="{{ route('sales.create', $motor->id) }}" class="btn btn-primary">Buy Now</a>
                                            <a href="{{ route('rentale.create', $motor->id) }}"class="btn btn-success flex-fill">
                                                Rent Now
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @empty
                        <div class="col-12 text-center text-white">
                            <h4>
                                Aucune moto trouvée.
                            </h4>
                        </div>
                    @endforelse
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $motorcycle->appends(request()->query())->links() }}
                </div>

            </div>

        </div>

    </div>

</div>
</body>
</html>
