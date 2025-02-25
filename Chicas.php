<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Lista chicas</title>
</head>
<body>
    <div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <a class="navbar-brand" href="Index.php"><h2>LEY DE LOS CICLOS</h2></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="Perfil.php"><h4>Perfiles</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Registro.php"><h4>Registro</h4></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Chicas.php"><h4>Todas</h4></a>
        </li>
      </ul>
    </div>
    </div>
        </nav>
    <h1 class="container-md">Chicas Magicas Actualmente Registradas</h1>
    <table>
        <thead>
            <div class="row">
            <tr>
                <div class="col-md-2"><th>Nombre</th></div>
                <div class="col-md-2"><th>Edad</th></div>
                <div class="col-md-2"><th>Ciudad</th></div>
                <div class="col-md-2"><th>Fecha de contrato</th></div>
                <div class="col-md-2"><th>Estado</th></div>
                <div class="col-md-2"><th>opciones</th></div>
            </tr>
            </div>
        </thead>
        <tbody>
            <tr>
                <td>nnnnn</td>
                <td>25</td>
                <td>bogo</td>
                <td>hoy</td>
                <td>resca</td>
                <td><a href="perfil.php">
                            <button>ver perfil</button>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <a class="btn btn-outline-success me-2" type="button" href="Registro.php">Regresar</a>
    </div>
</body>
</html>