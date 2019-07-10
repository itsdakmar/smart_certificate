<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Pinyon+Script&display=swap" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'broken-planewing';
            src: url("{{ asset('argon').'/fonts/broken-planewing/broken-planewing.regular-webfont.woff' }}") format('woff'), /* Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
            url("{{ asset('argon').'/fonts/broken-planewing/broken-planewing.regular-webfont.ttf' }}") format('truetype'); /* Chrome 4+, Firefox 3.5, Opera 10+, Safari 3—5 */
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .mt-6 {
            margin-top: 4rem;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <img class="pull-right" id="logo_1" width="280px" src="{{ asset('argon').'/img/brand/logo1.png' }}">
        </div>
        <div class="col-md-4 col-md-offset-4">
            <img src="{{ asset('argon').'/img/brand/logo_kkm.png' }}" id="logo_1" width="160px">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h1 class="text-center"
                style="font-family: 'broken-planewing';
                font-size: 90px;">
                Sijil Kehadiran</h1>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <p class="text-center" style="font-family: 'Pinyon Script'; font-size: 24px;">Dengan ini disahkan bahawa</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h5 class="text-center"> " NAMA PESERTA "</h5>
            <h5 class="text-center"> " NO KAD PENGENALAN PESERTA "</h5>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <p class="text-center" style="font-family: 'Pinyon Script'; font-size: 24px;">telah mengikuti / menghadiri</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h5 class="text-center"> " NAMA PROGRAM "</h5>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <p class="text-center" style="font-family: 'Pinyon Script'; font-size: 24px;">pada</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h5 class="text-center"> " TARIKH PROGRAM "</h5>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <p class="text-center" style="font-family: 'Pinyon Script'; font-size: 24px;">bertempat di</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h5 class="text-center"> " LOKASI PROGRAM "</h5>
        </div>
    </div>

    <div class="row mt-6">
        <div class="col-xs-4 col-md-4">
            <img src="{{ asset('argon').'/img/template/layout/Red_Seals.jpg' }}" width="150px">
        </div>

        <div class="col-xs-4 col-md-4">
            <table>
                <tr>
                    <td>
                        <img src="{{ asset('argon').'/img/template/signature.jpg' }}"
                             class="float-right mr--4" id="signature" width="150px">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="text-center m--1" style="font-size: 13px">"NAMA PENGARAH"</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="text-center m--1" style="font-size: 13px">"JAWATAN"</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="col-xs-4 col-md-4">
            <img style="width: 200px" src="{{ asset('argon').'/img/qrcode/qrcode.png' }}">
        </div>
    </div>
</div>
</body>
</html>