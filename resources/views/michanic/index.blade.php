<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>michnaic</title>
</head>
<body>
    

<div class="container">

    <h2>Maintenance Requests</h2>

    <table border="1" cellpadding="10" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Motor</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach($maintenances as $m)
            <tr>
                <td>{{ $m->id }}</td>
                <td>{{ $m->description }}</td>
                <td>{{ $m->status }}</td>
                <td>{{ $m->cost ?? '-' }}</td>

                <td>

                    {{-- ACCEPT FORM --}}
                    @if($m->status == 'pending')

                    <form action="{{ route('mechanic.accept', $m->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="number" name="cost" placeholder="Cost" required>

                        <button type="submit">Accept</button>
                    </form>

                    {{-- REFUSE --}}
                    <form action="{{ route('mechanic.refuse', $m->id) }}" method="POST" style="margin-top:5px;">
                        @csrf
                        @method('PUT')

                        <button type="submit" style="background:red;color:white;">
                            Refuse
                        </button>
                    </form>

                    @else
                        Done
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>

<form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                Logout
            </button>
        </form>
</body>
</html>