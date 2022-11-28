<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attandance Reports</title>
    <style>
        tr,td{
            padding: 5px;
        }
    </style>
</head>
<body>
    <table border='1' style="border-collapse: collapse;width:100%">
        <thead style="background: #ccc;">
            <tr>
                <th>
                    No
                </th>
                <th>
                    NIK
                </th>
                <th>
                    Name
                </th>
                <th>
                    In
                </th>
                <th>
                    Out
                </th>
    
                <th>
                    Date
                </th>
                
                <th>
                    Distance(m)
                </th>
                <th>
                    Desc
                </th>
    
            </tr>
        </thead>
        <tbody>
            @foreach ($attandances as $att)
    
    
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
    
                <td>
                    {{ $att->employee->nik }}
                </td>
                <td>
                    {{ $att->employee->name }}
                </td>
                <td>
                    {{ date('H:i:s',strtotime($att->att_in)) }}
                </td>
                <td>
                    {{ date('H:i:s',strtotime($att->att_out)) }}
                </td>
                <td>
                    {{ $att->att_date }}
                </td>
    
                
                <td>
                    {{ $att->distance }}
                </td>
                <td>
                    {{ $att->attandancestatus->name }}
                </td>
    
            </tr>
            @endforeach
    
        </tbody>
    </table>
</body>
</html>