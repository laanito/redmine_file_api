<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Acceso</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <form method="POST" action="">
        <div class="message">{message}</div>
        <header>Acceso</header>
        <label>Nombre de Usuario </label><span>*</span>
        <input type="text" name="user" placeholder="Usuario"/>
        <div class="help">At least 6 character</div>
        <label>Password </label><span>*</span>
        <input type="password" name="pass" placeholder="Contraseña"/>
        <div class="help">Use upper and lowercase lettes as well</div>
        <button type="submit">Iniciar Sesion</button>
    </form>
</body>
</html>