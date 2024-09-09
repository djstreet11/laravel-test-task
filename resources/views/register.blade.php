<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="phonenumber">Phone Number:</label>
    <input type="text" id="phonenumber" name="phonenumber" required>
    <br>
    <button type="submit">Register</button>
</form>
</body>
</html>
