
<?php
    if(isset($_COOKIE['logged'])){
        return header('Location: /boutique-en-ligne/index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    h1{
        font-family: 'WonkaFonts', sans-serif;
        text-align: center!important;
    } 
        @font-face {
    font-family: 'WonkaFonts';
    src: url('fonts/WillyWonka.ttf') format('truetype');
        }
    </style>
</head>
<body>
    
    <h1>Just a few more steps and you'll <br>find yourself in chocolate madness</h1>
    <form id="registerForm">
        <div class="container">
            <div class="kid1">
                <p>email:</p><input type="email" name="email" /><br><br>
                <p>password:</p><input type="password" name="password" /><br><br>
                <p>repeat password:</p><input type="password" name="repeat_password" /><br>
            </div>
            <div class="img" id="errorContainer">

            </div>
            <div class="kid2">
                <p>nick:</p><input type="text" name="nick" /><br><br>
                <p>name:</p><input type="text" name="name" /><br><br>
                <p>address:</p><input type="text" name="address" /><br><br>
                <p>phone number:</p><input type="text" name="phone" /><br><br>
                <div class="checkbox-container">
                    <input type="checkbox" id="terms" name="terms" required><br>
                    <label for="terms"><p>I have read and agree to the terms and conditions</p></label>
                    <button type="submit">Register me</button>
                </div>
            </div>
        </div>
        
    </form>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(event) {
            event.preventDefault(); 

            const formData = new FormData(this);
            const formProps = Object.fromEntries(formData);

            const response = await fetch('/boutique-en-ligne/api/register-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formProps)
            }).then(response => response.json());

            const errorContainer = document.getElementById('errorContainer');

         

            if (response.errors && response.errors.length) {
                response.errors.forEach(error => {
                    const errorElement = document.createElement('p');
                    errorElement.style.color = 'red';
                    errorElement.textContent = error;
                    errorContainer.appendChild(errorElement);
                });
            } else {
                alert('You have been logged!');
                window.location = '/boutique-en-ligne/login.php';
            }
        });
        async function searchProducts() {
            const query = document.getElementById('search').value;
            const response = await fetch(`search.php?query=${query}`);
            const results = await response.json();
            
            const resultsContainer = document.getElementById('results');
            resultsContainer.innerHTML = '';

            results.forEach(product => {
                const li = document.createElement('li');
                li.textContent = `${product.name} - ${product.description}`;
                resultsContainer.appendChild(li);
            });
        }
    </script>
</body>
</html>
<?php
include 'includes/footer.php'
?>