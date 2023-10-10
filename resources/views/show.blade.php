<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    {{-- <img class="blog-image" src="{{ $url ?? asset("image/logo/img_avatar1.png") }}" alt="Image from S3"> --}}

    <img class="blog-image" src="{{ $presignedUrl }}" alt="Image from S3">

</body>

</html>
