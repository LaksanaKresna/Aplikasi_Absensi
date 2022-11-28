<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
  
    <style>
        body {
            background: #4B49AC !important;
            color: #fff;
        margin: 0;
        padding: 0;
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        }
        canvas{
        position: absolute;
        }
    </style>
</head>

<body>
<label for="detect"><input type="checkbox" id="detect"> Scan Now</label>
<video id="videoInput" width="720" height="550" controls></video>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/plugin/faceapi/face-api.min.js"></script>
    <script src="/plugin/faceapi/script.js"></script>
</body>

</html>