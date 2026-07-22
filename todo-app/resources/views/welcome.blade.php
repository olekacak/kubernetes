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
            max-width: 520px;
            width: 100%;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            text-align: center;
        }
        h1 { font-size: 2rem; font-weight: bold; margin-bottom: 1.5rem; }
        img {
            width: 60%;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        .input-row {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        input[type="text"] {
            flex: 1;
            border: 2px solid #4caf50;
            border-radius: 6px;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
        }
        button {
            background: #4caf50;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 0.6rem 1.2rem;
            font-size: 0.95rem;
            cursor: pointer;
        }
        button:hover { background: #388e3c; }
        h2 { font-size: 1.3rem; font-weight: bold; margin-bottom: 1rem; }
        .todo-list { text-align: left; }
        .todo-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #eee;
            border-left: 4px solid #4caf50;
            background: #fafafa;
            margin-bottom: 0.4rem;
            border-radius: 0 4px 4px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Todo App</h1>
        <img src="/image" alt="Daily image">

        <form class="input-row" method="POST" action="/todos">
            @csrf
            <input
                type="text"
                name="todo"
                maxlength="140"
                placeholder="Enter a new todo (max 140 characters)"
                required
            >
            <button type="submit">Send</button>
        </form>

        <h2>Todos</h2>
        <div class="todo-list">
            <div class="todo-item">Learn Kubernetes basics</div>
            <div class="todo-item">Deploy application to cluster</div>
            <div class="todo-item">Configure persistent volumes</div>
        </div>
    </div>
</body>
</html>
