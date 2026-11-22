
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        input {
            padding: 10px;
            width: 65%;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button, .btn {
            padding: 9px 15px;
            border: none;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .update { background: #007bff; }
        .edit { background: #f0ad4e; }
        .delete { background: #dc3545; }

        .user {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 12px 0;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Update User</h1>

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}"
                   placeholder="User name" required>

            <input type="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   placeholder="Email" required>

            <input type="password" name="password"
                   placeholder="New password (optional)">

            <button type="submit" class="update">
                Update User
            </button>

        </form>

        <p><a href="{{ route('users.index') }}">Back to Users</a></p>

    </div>

    <div class="card">

        <h2>Current Users</h2>

        @forelse($users as $item)

            <div class="user">

                <div>
                    <strong>{{ $item->name }}</strong>
                    <br>
                    <small>{{ $item->email }}</small>
                </div>

                <div class="actions">

                    <a href="{{ route('users.edit', $item->id) }}"
                       class="btn edit">Edit</a>

                    <form action="{{ route('users.destroy', $item->id) }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </button>

                    </form>

                </div>

            </div>

        @empty
            <p>No users found.</p>
        @endforelse

    </div>

</div>

</body>
</html>
