
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>

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

        .add { background: #007bff; }
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

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">
        <h1>User List</h1>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <h2>Add New User</h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <input type="text" name="name"
                   placeholder="Enter user name"
                   value="{{ old('name') }}" required>

            <input type="email" name="email"
                   placeholder="Enter email"
                   value="{{ old('email') }}" required>

            <input type="password" name="password"
                   placeholder="Enter password" required>

            <button type="submit" class="add">Add User</button>
        </form>
    </div>

    <div class="card">
        <h2>Current Users</h2>

        @forelse($users as $user)

            <div class="user">

                <div>
                    <strong>{{ $user->name }}</strong>
                    <br>
                    <small>{{ $user->email }}</small>
                </div>

                <div class="actions">

                    <a href="{{ route('users.edit', $user->id) }}"
                       class="btn edit">Edit</a>

                    <form action="{{ route('users.destroy', $user->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete"
                            onclick="return confirm('Are you sure you want to delete this user?')">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @empty
            <p>No users found.</p>
        @endforelse

    </div>

    <a href="{{ route('tasks.index') }}">Back to Tasks</a>

</div>

</body>
</html>
