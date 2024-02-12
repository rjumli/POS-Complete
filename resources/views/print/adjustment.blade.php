<!doctype html>
<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        table,
        td,
        th {
            border: .5px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 5px;
            vertical-align: top;
        }

        td {
            padding: 5px;
            vertical-align: top;
            /* text-align: center; */
        }
        input[type=checkbox] {
            transform: scale(.7);
        }
         .a {
            width: 55px; 
            height: 55px;
         }
         label {
        display: block;
        padding-left: 15px;
        text-indent: -15px;
        }
        input {
        width: 13px;
        height: 13px;
        padding: 0;
        margin:0;
        vertical-align: bottom;
        position: relative;
        top: -5px;
        left: 7px;
        *overflow: hidden;
        
        }
        .spec_table td {
margin-left: -20px;
font-size: .9em;
line-height: 1.1em;
border-top: none !important;
}
.val {
    font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;
    text-align: center;
    text-transform: uppercase;
    /* font-weight: bold; */
}
.nor {
    font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;
    text-transform: uppercase;
    /* font-weight: bold; */
}
.tex {
    font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace;
    text-transform: uppercase;
    font-size: 11px;
    margin-left: 20px;
    /* font-weight: bold; */
}

    </style>
</head>

<body>
    <?php 
        $sessions = json_encode($sessions); 
        $sessions = json_decode($sessions, true); 
    
        $week = json_encode($week); 
        $week = json_decode($week, true); 
    ?>
    <img src="{{ asset('images/logo.png') }}" style="position: absolute; top: -5; left: 250; width: 60px; height: 60px;">
    <div style="font-family:Calibri;">
        <center style="font-size: 13px; margin-bottom: 3px;"">POST INVENTORY SYSTEM</center>
        <center style="font-size: 8px; margin-bottom: 10px; font-family:Arial, Helvetica, sans-serif;">STOCK ADJUSTMENT REPORT</center>
        <center style="font-size: 10px; font-weight: bold; margin-bottom: 10px; font-family:Arial, Helvetica, sans-serif;">{{strtoupper($week)}}</center>

        <table style="width:100%; font-size: 10px; padding: 20px; font-family:Arial, Helvetica, sans-serif">
            <thead>
                <tr style="background-color: #a7dceb;">
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Reason</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $key=>$session)
                <tr>
                    <td class="nor"><center>{{$session['product']}}</center></td>
                    <td class="nor"><center>{{$session['quantity']}}</center></td>
                    <td class="nor"><center>{{$session['reason']}}</center></td>
                    <td class="nor"><center>{{$session['date']}}</center></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table style="font-size: 10px; font-family:Arial, Helvetica, sans-serif; width: 100%; border:none;  left: 0; bottom: 0; position:absolute; margin-left: auto; margin-right: auto;">
            <tr>
                <td style="width: 50%; text-align: left; font-style: bold; border-left: none; border-right: none; padding: 5px;">Printed By: {{ auth()->user()->name }}</td>
                <td style="width: 50%; text-align: right; font-style: bold; border-left: none; border-right: none; padding: 5px;">Date: {{ now()}}</td>
            </tr>
        </table>
    </div>
</body>

</html>
