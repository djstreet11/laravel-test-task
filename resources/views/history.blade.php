<!DOCTYPE html>
<html>
<head>
    <title>History</title>
</head>
<body>
<a onclick="history.back()" style="cursor:pointer;">go back</a>
<h1>History</h1>
<ul>
    @foreach ($results as $result)
        <li>
            Random Number: {{ $result->random_number }} -
            Result: {{ $result->result }} -
            Win Amount: {{ $result->win_amount }}
        </li>
    @endforeach
</ul>
</body>
</html>
