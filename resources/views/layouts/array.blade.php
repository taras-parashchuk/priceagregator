@php
    $letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N',
                'O','P','Q','R','S','T','U','V','W','X','Y','Z' ,'AA',
    'AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO',
           'AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'];

@endphp
<html>
<body>
<head>
<title>Hello</title>
</head>
<h1>I'm array</h1>
<div>






    @isset($pricedata)

        <table class="table table-bordered">
            <thead>
            <tr>
                @for ($i = 0; $i < count($pricedata[0]); $i++)
                    <th scope="col">{{ $letters[$i] }}</th>
                @endfor
            </tr>
            </thead>

            <tbody>
            @for ($i = 1; $i < $rownum; $i++)
                <tr>
                    @for ($y = 0; $y < count($pricedata[0]); $y++)
                        <td>{{$pricedata[$i][$y] }}</td>
                    @endfor
                </tr>
            @endfor


            </tbody>
        </table>
    @endisset

</div>
</body>
</html>
