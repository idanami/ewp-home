<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/app.css"/>
        <title>Laravel</title>
    </head>
    <body class="antialiased">
        <table>
            <thead>
                <tr>
                    <th class="th-id">
                        <div>
                            <div>id</div>
                            <div>title</div>
                        </div>
                    </th>
                    <th class="th-price">Price</th>
                    <th class="th-Attributes">Attributes</th>
                    <th class="th-Categories">Categories</th>
                </tr>
            </thead>
            <tbody class="product-container"></tbody>
        </table>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
