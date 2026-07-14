<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Rent Motor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <h2 class="mb-3 text-center text-warning">Finalize Your Rental</h2>
                <p class="text-center text-light small mb-4">You are renting: <strong>{{ $motor->brand }} - {{ $motor->model }}</strong></p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 border-0 small">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('rentale.store') }}">
                    @csrf

                    <input type="hidden" name="motor_id" value="{{ $motor->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-light">Price Per Day</label>
                            <input type="text" id="price_per_day" class="form-control bg-dark text-warning border-secondary fw-bold" value="{{ $motor->price_rent_day }}" readonly>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-light">Number of Days</label>
                            <input type="number" id="rent_days" name="rent_days" class="form-control bg-dark text-white border-secondary fw-bold" min="1" value="1" >
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Start Date</label>
                        <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="{{ date('Y-m-d') }}" >
                    </div>

                    @auth
                        <div class="alert alert-info py-2 text-center border-0 small mb-3">
                            Locataire : <strong>{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</strong>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">First Name (Prénom)</label>
                                <input type="text" name="prenom_guest" class="form-control bg-dark text-white border-secondary" placeholder="John" value="{{ old('prenom_guest') }}" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Last Name (Nom)</label>
                                <input type="text" name="nom_guest" class="form-control bg-dark text-white border-secondary" placeholder="Doe" value="{{ old('nom_guest') }}" >
                            </div>
                        </div>
                    @endauth

                 

                    <button type="submit" class="btn btn-warning w-100 fw-bold py-2 shadow-sm fs-5">
                        Confirm rental — <span id="total_price_display">{{ $motor->price_rent }}</span> DH
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pricePerDayInput = document.getElementById('price_per_day');
        const rentDaysInput = document.getElementById('rent_days');
        const totalPriceDisplay = document.getElementById('total_price_display');

        function calculateTotal() {
            const price = parseFloat(pricePerDayInput.value) || 0;
            const days = parseInt(rentDaysInput.value) || 1;
            const total = price * days;
            
            // تحديث الثمن اللي باين وسط الزر
            totalPriceDisplay.textContent = total;
        }

        // الحساب كيتبدل فالبلاصة فاش المستخدم يغير الأيام
        rentDaysInput.addEventListener('input', calculateTotal);
        rentDaysInput.addEventListener('change', calculateTotal);
    });
</script>

</body>
</html>