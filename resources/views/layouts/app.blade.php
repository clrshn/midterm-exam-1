<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales System - @yield('title')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            color: #333;
        }
        header {
            background: #d80572ff;
            color: #141488ff;
            padding: 15px 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        header h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        header h2 {
            margin: 5px 0 0;
            font-size: 1.2rem;
            font-weight: normal;
            color: #ffdd57; /* yellow subtitle */
        }
        nav {
            margin-top: 10px;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #ffdd57;
        }
        main {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }
        .content-wrapper {
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 900px;
        }
        table {
            border-collapse: collapse;
            margin-top: 15px;
            width: 100%;
            background: #ef5dbcff;
        }
        th {
            background: #d80572ff;
            background: ;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        tr:nth-child(even) {
            background: #8c9cebff;
        }
        tr:hover {
            background: #eb94a8ff;
        }
        button, .btn {
            background: #d80572ff;
            border: none;
            color: #fff;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover, .btn:hover {
            background: #b72504ff;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #a71d2a;
        }
        .btn-success {
            background: #28a745;
        }
        .btn-success:hover {
            background: #1e7e34;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sales Transaction Processing System</h1>
        <h2>@yield('title')</h2> <!-- 🔹 Dynamic subtitle -->
        <nav>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('sales.index') }}">Sales</a>
        </nav>
    </header>

    <main>
        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>
</body>
</html>
