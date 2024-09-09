<!DOCTYPE html>
<html>
<head>
    <title>Special Page</title>
</head>
<body>
<h1>Special Page</h1>
<a href="{{ route('imfeelinglucky') }}">Imfeelinglucky</a>
<a href="{{ route('history') }}">History</a>
<a href="{{ route('generate_link', ['link' => $link->link]) }}">Generate New Link</a>
<a href="{{ route('deactivate_link', ['link' => $link->link]) }}">Deactivate Link</a>
</body>
</html>
