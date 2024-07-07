<?php
if(isset($_COOKIE['logged'])){
    if(isset($_COOKIE['admin']) && $_COOKIE['admin'] === 'true'){
        header('Location: /boutique-en-ligne/index2.php');
    } else {
        header('Location: /boutique-en-ligne/index.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Login Page</title>
</head>
<body>
<?php include 'includes/header.php'; ?>
<ul id="errors_list"></ul>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1" class="text-white fw-bold">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-mute text-white fw-bold">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1" class="text-white fw-bold">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label text-white fw-bold" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="reg" href="register.php">inscription</a>
    </form>
</div>

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
        document.querySelector('#errors_list').innerHTML = response.errors.map(error => `<li>${error}</li>`).join('');
    }
    else{
        setCookie('logged', response.user.id, 1);
        if(email === 'b@b.pl'){
            setCookie('admin', 'true', 1);
            window.location = '/boutique-en-ligne/index2.php';
        } else {
            setCookie('admin', 'false', 1);
            window.location = '/boutique-en-ligne/index.php';
        }
    }
}

document.querySelector('form').addEventListener('submit', loginUser);
</script>
</body>
</html>

<style>
body {
    background-image: url('assets/images/wonka1.jpg');
}
.reg {
    font-weight: bold;
    padding: 7px;
    border-radius: 5px;
    background-color: orange;
    margin-left: 140px;
}
</style>
<?php include 'includes/footer.php'; ?>
