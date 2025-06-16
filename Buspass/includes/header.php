<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bus Pass System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { display: flex; min-height: 100vh; margin: 0; }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            flex-shrink: 0;
        }
        .sidebar h4 {
            padding: 15px;
            text-align: center;
            background-color: #23272b;
            margin: 0;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            color: #ccc;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        html, body {
            height: 100%;
            margin: 0;
            box-sizing: border-box;
        }
        
    </style>
</head>
<body>
