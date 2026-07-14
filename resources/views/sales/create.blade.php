<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Buy Motor</title>
    <link href="https://cdn.jsdelivr.net/npu ym/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body class="bg-dark text-white d-flex align-items-center justify-content-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <div class="card bg-secondary text-white shadow p-4 border-0 rounded-3">
                <h2 class="mb-3 text-center text-warning">Finalize Your Purchase</h2>
                <p class="text-center text-light small mb-4">You are buying: <strong>{{ $motor->brand }} - {{ $motor->model }}</strong></p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 border-0 small">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('sales.store') }}">
                    @csrf

                    <input type="hidden" name="motor_id" value="{{ $motor->id }}">

                    <div class="mb-3">
                        <label for class="form-label fw-bold text-light">Motor Price</label>
                        <input type="text" name='price' class="form-control bg-dark text-warning border-secondary fw-bold" value="{{ $motor->price_buy }} DH" readonly>
                    </div>

                    <div class="mb-3">
                        <label for class="form-label fw-bold">Purchase Date</label>
                        <input type="date" name="sale_date" class="form-control bg-dark text-white border-secondary" value="{{ date('Y-m-2026') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for class="form-label fw-bold">First Name (Prénom)</label>
                            <input type="text" name="prenom_guest" class="form-control bg-dark text-white border-secondary" placeholder="John" value="{{ old('prenom_guest') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for class="form-label fw-bold">Last Name (Nom)</label>
                            <input type="text" name="nom_guest" class="form-control bg-dark text-white border-secondary" placeholder="Doe" value="{{ old('nom_guest') }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for class="form-label fw-bold">Delivery Address</label>
                        <textarea name="adress" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Your full address..." required>{{ old('adress') }}</textarea>
                    </div>

                    <button class="btn btn-warning w-100 fw-bold py-2 shadow-sm fs-5">
                        Confirm Purchase — {{ $motor->price_buy }} DH
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>

</body>
</html>
