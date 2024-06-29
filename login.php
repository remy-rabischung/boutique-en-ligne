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
        <button type="submit">Zaloguj sie</button>
    </form>

    <script src="/boutique-en-ligne/assets/js/utils.js"></script>

    <script>
        const loginUser = async (e) => {
            e.preventDefault();

            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            document.querySelector('#errors_list').innerHTML = '';

            const request = await fetch('/boutique-en-ligne/api/login-user', {
                method: 'post',
                body: JSON.stringify({
                    email, password
                })
            });

            const response = await request.json();

            if(response.errors.length){
                document.querySelector('#errors_list').innerHTML = response.errors.map(error => `<li>${error}</li>`).join('')
            }
            else{
                setCookie('logged', 'true', 1);
                if(response.user.admin === 1){
                    setCookie('admin', 'true', 1);
                }

                alert('Zostales zalgowany!');
                window.location = '/boutique-en-ligne/index.php';
            }
        }

        document.querySelector('form').addEventListener('submit', loginUser);
    </script>
</body>
</html>