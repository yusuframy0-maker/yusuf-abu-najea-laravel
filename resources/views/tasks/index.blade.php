<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        .container {
            max-width: 850px;
            margin: auto;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 25px;
        }

        input {
            width: 75%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button, .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .add { background: #337ab7; }
        .edit { background: #f0ad4e; }
        .delete { background: #d9534f; }

        .task {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        h2 {
            font-size: 22px;
            margin-top: 0;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Task List</h1>

    <div class="card">
        <h2>Add New Task</h2>

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <input type="text" name="name"
                   placeholder="Enter task name..." required>

            <button type="submit" class="add">Add Task</button>
        </form>

        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="card">
        <h2>Current Tasks</h2>

        @forelse($states as $state)

            <div class="task">
                <span>
    <strong>{{ $state->id }}</strong>
    - {{ $state->name }}
</span>
                <div class="actions">

                    <a href="{{ route('tasks.edit', $state->id) }}"
                       class="btn edit">Edit</a>

                    <form action="{{ route('tasks.destroy', $state->id) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete
                        </button>
                    </form>

                </div>
            </div>

        @empty
            <p>No tasks found.</p>
        @endforelse

    </div>

</div>
</body>
</html>
