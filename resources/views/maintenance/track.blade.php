<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Suivre ma Rental</title>

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
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    color:white;
}

.card{
    width:100%;
    max-width:450px;
    background:#1f2937;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.4);
}

h3{
    text-align:center;
    color:#facc15;
    margin-bottom:25px;
    font-size:28px;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #374151;
    border-radius:8px;
    background:#111827;
    color:white;
    outline:none;
}

input:focus{
    border-color:#facc15;
}

.btn{
    width:100%;
    padding:12px;
    background:#facc15;
    color:black;
    border:none;
    border-radius:8px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:.3s;
}

.btn:hover{
    background:#eab308;
}

.back-btn{
    margin-top:20px;
    text-decoration:none;
    color:white;
    border:1px solid #6b7280;
    padding:10px 20px;
    border-radius:8px;
    transition:.3s;
}

.back-btn:hover{
    background:#374151;
}
</style>

</head>
<body>

<div class="card">

    <h3>Suivre ma Rental</h3>

    <form method="POST" action="{{ route('maintenance.track.result') }}">
        @csrf

        <div class="form-group">
            <label>Entrez votre téléphone</label>
            <input
                type="text"
                name="phone"
                placeholder="Ex : 0612345678"
                required
            >
        </div>

        <button type="submit" class="btn">
            Rechercher
        </button>

    </form>

</div>

<a href="{{ route('index') }}" class="back-btn">
    Retour
</a>

</body>
</html>