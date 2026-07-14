<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Maintenance</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #34495e;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Create Maintenance Request</h2>

    <form method="POST" action="{{ route('main.store') }}">
        @csrf

        <label for="">Motorcycle</label>

<select name="motor_id" required>
    <option value="">-- Select Motorcycle --</option>

    @foreach($motors as $m)
        <option value="{{ $m->id }}">
            {{ $m->brand }} - {{ $m->model }} ({{ $m->year }})
        </option>
    @endforeach
</select>

        <textarea name="description" placeholder="Describe the problem"></textarea>

        @guest
            <input type="text" name="nom_guets" placeholder="First Name">
            <input type="date" name="start_date" placeholder="First Name">
            <input type="text" name="prenom_guets" placeholder="Last Name">
            <input type="text" name="phone" placeholder="Phone Number">
        @endguest

        <label>Select Pieces</label>

        <select name="pieces[]" multiple>
            @foreach($pieces as $p)
                <option value="{{ $p->id }}">
                    {{ $p->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Submit Request</button>

    </form>

</div>

</body>
</html>
