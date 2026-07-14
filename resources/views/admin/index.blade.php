<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 1100px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
        border-radius: 10px;
    }

    thead {
        background: #2c3e50;
        color: white;
    }

    th, td {
        padding: 12px;
        text-align: center;
    }

    tbody tr {
        border-bottom: 1px solid #ddd;
        transition: 0.3s;
    }

    tbody tr:hover {
        background: #f1f1f1;
    }

    .status {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        color: white;
        display: inline-block;
    }

    .pending {
        background: orange;
    }

    .accepted {
        background: green;
    }

    .refused {
        background: red;
    }

    button {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        opacity: 0.8;
    }

    .delete-btn {
        background: #e74c3c;
        color: white;
    }

</style>
<script>

function showTable(tableId)
{
    document.getElementById('maintenanceTable').style.display = 'none';
    document.getElementById('motorcycleTable').style.display = 'none';

    document.getElementById(tableId).style.display = 'block';
}

</script>
</head>
<body>
     <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
                Logout
            </button>
        </form>

<div class="container">
    <h2>DAshboard</h2>

 <form action="{{ route('moto.create') }}"><button style="background:rgb(19, 6, 6);color:white;">
                        ajouter
                    </button></form><br>
    
<div style="text-align:center; margin-bottom:20px;">
    <button onclick="showTable('maintenanceTable')">
        Maintenance
    </button>

    <button onclick="showTable('motorcycleTable')">
        Motorcycles
    </button>
</div>
    <div id="maintenanceTable">

  <table border="1" width="100%" cellpadding="10">

        <thead>
            <tr>
                <th>ID</th>
                <th>nom</th>
                <th>description</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($maintenances as $m)

        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->nom_guets }}</td>
            <td>{{ $m->description }}</td>
            <td>{{ $m->status }}</td>
            <td>{{ $m->cost ?? '-' }}</td>

           

            <td>
               
                <form action="{{ route('admin.delete', $m->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this maintenance?')">
                    @csrf
                    @method('DELETE')

                    <button style="background:red;color:white;">
                        Delete
                    </button>

                </form>

            </td>
        </tr>

        @endforeach

        </tbody>

    </table>

</div>
    <br>
    <br>
    <br>
    
    
    
    
    
    <div id="motorcycleTable" style="display:none;">
    <table border="1" width="100%" cellpadding="10">

        <thead>
            <tr>
                <th>ID</th>
                <th>brand</th>
                <th>model</th>
                <th>year</th>
                <th>stock</th>
                <th>categorie</th>
                <th>price_buy</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

        @foreach($motorcycles as $m)

        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->brand }}</td>
            <td>{{ $m->model }}</td>
            <td>{{ $m->yesr }}</td>
            <td>{{ $m->stock }}</td>
            <td>{{ $m->categorie }}</td>
            <td>{{ $m->price_buy ?? '-' }}</td>

           

            <td>

                <form action="{{ route('admin.delete', $m->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this maintenance?')">

                    @csrf
                    @method('DELETE')

                    <button style="background:red;color:white;">
                        Delete
                    </button>

                </form>

            </td>
        </tr>

        @endforeach

        </tbody>

    </table>
    </div>

</div>
</body>
</html>