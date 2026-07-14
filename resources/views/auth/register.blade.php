<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #111;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow p-4">

                <h3 class="text-center mb-4">Create Account</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="">nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for>prenom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label for>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label for>Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <label for="">confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <!-- ROLE -->
                    <div class="mb-3">
                        <label for="">Role</label>
                        <select name="role" class="form-control" required>
                            <option value="client">Client</option>
                            {{-- <option value="admin">Admin</option> --}}
                        </select>
                    </div>

                    <button class="btn btn-success w-100">Register</button>

                </form>

                <p class="text-center mt-3">
                    Already have account?
                    <a href="{{ route('showLogin') }}">Login</a>
                </p>

            </div>

        </div>

    </div>

</div>

</body>
</html>