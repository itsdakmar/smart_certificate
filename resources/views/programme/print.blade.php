<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>


<div class="container">

    <div class="row justify-content-end">
        <div class="col-xs-6">
            <img src="{{ public_path('/argon/img/brand/logo_kkm.png') }}"
                 id="logo_1" width="120px">
        </div>
        <div class="col-xs-6 pr-5">
            <img src="{{ public_path('/argon/img/brand/logo1.png') }}"
                 id="logo_1"
                 width="180px"
                 class="pull-right">
        </div>
    </div>
    <div class="row justify-content-center py-2">
        <div class="col">
            <h1 class="text-center"
                style="font-family: 'Pinyon Script', cursive; font-size: 40px">Sijil
                Kehadiran</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xs-7">
            <div class="alert alert-primary text-center"
                 style="font-size: 8px; padding: 0.5rem; border-radius: 0px; border-color: #553ca2; background-color: #553ca2;"
                 role="alert">
                Dengan rasminya dianugerahkan kepada
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xs-7">
            <h5 class="text-center"> " NAMA PESERTA "</h5>
        </div>
    </div>

    <div class="row mt-4 justify-content-center">
        <div class="col-xs-10">
            <h6 class="text-center">Atas kehadiran ke "NAMA PROGRAM" pada "TARIKH PROGRAM" di
                "LOKASI PROGRAM".</h6>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-xs-6">
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
    </div>

    <div class="row mt-5 justify-content-between">
        <div class="col-xs-4">
            <i class="fas fa-certificate" style="font-size: 4rem; color: red;"></i>
        </div>
        <div class="col-xs-4">
            <i class="fas fa-qrcode" style="font-size: 4rem;"></i>
        </div>
    </div>
</div>

</body>
</html>