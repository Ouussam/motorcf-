<!DOCTYPE html>
<html>
<head>
    <title>Gestion Livres</title>
    <link rel="icon" href="/images/images.png" type="image/x-icon">

    <style>
        body {
            font-family: Arial;
            background: #f4f7fb;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 500px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #0a1f44;
        }

        h3 {
            color: #1e4ed8;
            margin-top: 25px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0a1f44;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1e4ed8;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .errors {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        hr {
            margin: 20px 0;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Gestion des motos</h2>
    <h3>Ajouter un motor</h3>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

  <label for>brand</label>
<input type="text" name="brand" value="{{ old('brand') }}">
@error('brand')
    <div class="errors">{{ $message }}</div>
@enderror


<label for="">model</label>
<input type="text" name="model" value="{{ old('model') }}">
@error('model')
    <div class="errors">{{ $message }}</div>
@enderror


<label for>year</label>
<input type="number" name="year" value="{{ old('year') }}">
@error('year')
    <div class="errors">{{ $message }}</div>
@enderror
<label>price_buy</label>
<input type="number" name="price_buy" value="{{ old('price_buy') }}">
@error('price_buy')
    <div class="errors">{{ $message }}</div>
@enderror
<label>price_rent_day</label>
<input type="number" name="price_rent_day" value="{{ old('price_rent_day') }}">
@error('price_rent_day')
    <div class="errors">{{ $message }}</div>
@enderror


<label>Photo</label>
<input type="file" name="photo">
@error('photo')
    <div class="errors">{{ $message }}</div>
@enderror
<label>stock</label>
<input type="number" name="stock">
@error('stock')
    <div class="errors">{{ $message }}</div>
@enderror
<label>categorie</label>
<input type="number" name="categorie">
@error('categorie')
    <div class="errors">{{ $message }}</div>
@enderror


<label>status</label>
<select name="status">
    <option value="disponible">Disponible</option>
</select>
@error('status')
    <div class="errors">{{ $message }}</div>
@enderror

        <button type="submit">Ajouter</button>
    </form>
     <a href="{{ route('index') }}">⬅ Back</a>

</div>

</body>
</html>