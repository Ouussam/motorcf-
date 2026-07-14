<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mes Demandes Maintenance</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:#111827;
    min-height:100vh;
    padding:40px 20px;
    color:white;
}

.container{
    max-width:1000px;
    margin:auto;
}

h3{
    text-align:center;
    margin-bottom:30px;
    font-size:30px;
}

.alert{
    background:#dc3545;
    padding:15px;
    border-radius:10px;
    text-align:center;
    font-weight:bold;
}

.maintenance-card{
    background:#1f2937;
    border:1px solid #374151;
    border-radius:15px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,.4);
}

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.badge{
    padding:8px 15px;
    border-radius:20px;
    font-size:14px;
    font-weight:bold;
}

.pending{
    background:#facc15;
    color:black;
}

.progress{
    background:#38bdf8;
    color:black;
}

.completed{
    background:#22c55e;
    color:white;
}

.info{
    margin-bottom:10px;
    line-height:1.8;
}

.date{
    color:#9ca3af;
    margin-top:15px;
}

.price{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:20px;
    padding-top:15px;
    border-top:1px solid #374151;
}

.price strong{
    color:#22c55e;
    font-size:24px;
}

.barcode{
    text-align:center;
    margin-top:20px;
}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:12px 25px;
    background:#2563eb;
    color:white;
    text-decoration:none;
    border-radius:8px;
    transition:.3s;
}

.btn:hover{
    background:#1d4ed8;
}

.text-center{
    text-align:center;
}
</style>

</head>
<body>

<div class="container">

<h3>Mes Demandes de Maintenance</h3>

@if($maintenances->isEmpty())

    <div class="alert">
        Aucune demande trouvée pour ce numéro.
    </div>

@else

    @foreach($maintenances as $maintenance)

    <div class="maintenance-card">

        <div class="header">

            @if($maintenance->status === 'pending')
                <span class="badge pending">
                    En attente d'acceptation
                </span>

            @elseif($maintenance->status === 'in_progress')
                <span class="badge progress">
                    Acceptée / En cours
                </span>

            @elseif($maintenance->status === 'completed')
                <span class="badge completed">
                    Terminée
                </span>
            @endif

        </div>

        <div class="info">
            <strong>Description :</strong>
            {{ $maintenance->description }}
        </div>

        <div class="info">
            <strong>Nom utilisateur :</strong>
            {{ $maintenance->nom_guets }}
        </div>

        <div class="date">

            @if($maintenance->start_date)
                <p>🔧 Débutée le : {{ $maintenance->start_date }}</p>
            @endif

            @if($maintenance->end_date)
                <p>✅ Terminée le : {{ $maintenance->end_date }}</p>
            @endif

        </div>

        <div class="price">
            <span>Coût Total :</span>
            <strong>
                {{ $maintenance->cost > 0 ? $maintenance->cost . ' DH' : 'Calcul en cours...' }}
            </strong>
        </div>

        <div class="barcode">
            {!! DNS1D::getBarcodeHTML((string)$maintenance->id, 'C128', 2, 50) !!}
        </div>

    </div>

    @endforeach

@endif

<div class="text-center">
    <a href="{{ route('maintenance.track.form') }}" class="btn">
        Retour
    </a>
</div>

</div>

</body>
</html>