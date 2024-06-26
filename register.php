<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul id="errors_list"></ul>
    <form>
        <input type="email" name="email" />
        <input type="password" name="password" />
        <input type="password" name="repeat_password" />

        <input type="text" name="nick" />
        <input type="text" name="name" />
        <input type="text" name="address" />
        <input type="text" name="phone" />

        <button type="submit">Zarejestruj sie</button>
    </form>

    <script>
        const registerUser = async (e) => {
            e.preventDefault();

            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            const repeat_password = document.querySelector('input[name="repeat_password"]').value;
            const nick = document.querySelector('input[name="nick"]').value;
            const name = document.querySelector('input[name="name"]').value;
            const address = document.querySelector('input[name="address"]').value;
            const phone = document.querySelector('input[name="phone"]').value;

            document.querySelector('#errors_list').innerHTML = '';

            const request = await fetch('/boutique-en-ligne/api/register-user', {
                method: 'post',
                body: JSON.stringify({
                    email, password, repeat_password, nick, name, address, phone
                })
            });

            const response = await request.json();

            if(response.errors.length){
                document.querySelector('#errors_list').innerHTML = response.errors.map(error => `<li>${error}</li>`).join('')
            }
            else{
                alert('Zostales zarejestrowany!');
                window.location = '/boutique-en-ligne/login.php';
            }

            console.log(response);
        }

        document.querySelector('form').addEventListener('submit', registerUser);
    </script>
</body>
</html>