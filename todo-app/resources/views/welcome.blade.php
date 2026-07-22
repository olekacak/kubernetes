<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            padding: 2rem;
        }
        .container {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            text-align: center;
        }
        h1 { font-size: 2rem; font-weight: bold; margin-bottom: 1.5rem; }
        img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .caption { color: #555; margin-bottom: 1.5rem; }
        form { display: flex; flex-direction: column; gap: 0.75rem; }
        input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            width: 100%;
        }
        button {
            background: #444;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            cursor: pointer;
        }
        button:hover { background: #222; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo App</h1>
        <img src="/image" alt="Daily image">
        <p class="caption">DevOps with Kubernetes 2026</p>
        <form method="POST" action="/todos">
            @csrf
            <input type="text" name="todo" placeholder="Add a new todo...">
            <button type="submit">Add</button>
        </form>
    </div>
</body>
</html>
