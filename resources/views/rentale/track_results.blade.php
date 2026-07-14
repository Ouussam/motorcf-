<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mes Demandes Rental</title>

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

.rental-card{
    background:#1f2937;
    border:1px solid #374151;
    border-radius:15px;
    padding:20px;
    margin-bottom:25px;
    box-shadow:0 4px 15px rgba(0,0,0,0.4);
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
    color:#000;
}

.progress{
    background:#38bdf8;
    color:#000;
}

.completed{
    background:#22c55e;
    color:white;
}

.info{
    margin:10px 0;
    font-size:16px;
}

.date{
    color:#9ca3af;
    font-size:14px;
    margin-top:10px;
}

.price{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-top:1px solid #374151;
    padding-top:15px;
}

.price strong{
    color:#22c55e;
    font-size:24px;
}

.barcode{
    margin-top:20px;
    text-align:center;
}

hr{
    border:none;
    border-top:1px solid #374151;
    margin:25px 0;
}

.btn{
    display:inline-block;
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

    <h3>Mes Demandes de Rental</h3>

    @if($rent->isEmpty())

        <div class="alert">
            Aucune demande trouvée pour ce NOM.
        </div>

    @else

        @foreach($rent as $r)

        <div class="rental-card">

            <div class="header">

                @if($r->status === 'pending')
                    <span class="badge pending">
                        En attente d'acceptation
                    </span>
                @elseif($r->status === 'in_progress')
                    <span class="badge progress">
                        Acceptée / En cours
                    </span>
                @elseif($r->status === 'completed')
                    <span class="badge completed">
                        Terminée
                    </span>
                @endif

            </div>

            <div class="info">
                <strong>Nom Guest :</strong>
                {{ $r->nom_guets }} {{ $r->prenom_guets }}
            </div>

            <div class="date">

                @if($r->start_date)
                    <p>🚀 Débutée le : {{ $r->start_date }}</p>
                @endif

                @if($r->end_date)
                    <p>✅ Terminée le : {{ $r->end_date }}</p>
                @endif

            </div>

            <div class="price">
                <span>Prix Total :</span>
                <strong>
                    {{ $r->total_price > 0 ? $r->total_price . ' DH' : 'Calcul en cours...' }}
                </strong>
            </div>

            <div class="barcode">
                {!! DNS1D::getBarcodeHTML((string)$r->id, 'C128', 2, 50) !!}
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