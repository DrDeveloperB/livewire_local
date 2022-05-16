<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        </head>

<body>

<script src="{{ mix('js/app.js') }}" defer></script>

<script>
    window.onload = function () {
        console.log(axios);

        async function getUserTest() {
            try {
                const response = await axios.get('/test2')
                console.log(response)
            } catch (error) {
                console.error(error)
            }
        }
        getUserTest();

        // axios.get('/test2')
        //     .then(function (response) {
        //         // handle success
        //         console.log(response);
        //     })
        //     .catch(function (error) {
        //         // handle error
        //         console.log(error);
        //     })
        //     .then(function () {
        //         // always executed
        //     });

        // axios.post('/oauth/personal-access-tokens', data)
        //     .then(response => {
        //         console.log(response);
        //     })
        //     .catch (response => {
        //         // List errors on response...
        //     });

        // axios.get('/oauth/clients')
        //     .then(response => {
        //         console.log(response.data);
        //     })
        //     .catch(function (error) {
        //         // handle error
        //         console.log(error);
        //     })
        // ;
    };
</script>

</body>
</html>
