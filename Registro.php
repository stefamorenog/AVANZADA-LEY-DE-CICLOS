<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro de chicas</title>
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
        <h1>Registro de chicas magicas</h1>
        <form action="">
            <div class="form-floating">
            <input class="form-control" type="text" id="nombre" placeholder="Nombre">
            <label class="form-label" for="nombre">Nombre Chica Magica</label>
            </div>

            <div class="form-floating">
            <input class="form-control" type="text" id="edad" placeholder="Edad">
            <label class="form-label" for="edad">Edad Chica Magica</label>
            </div>
            
            <label class="form-label" for="ciudad">Ciudad Chica Magica</label>
            <input class="form-control" type="text" id="ciudad" placeholder="Ciudad origen">
            
            <label class="form-label" for="estado">Estados</label>
            <select class="form-select" name="estado" id="estado">
                <option value="1">Activa</option>
                <option value="2">Desaparecida</option>
                <option value="3">Rescatada por la ley de los ciclos</option>
            </select>
           
            <label class="form-label" for="contrato">Fecha de contrato Chica Magica</label>
            <input class="form-control" type="date" id="contrato" min="2025-02-23">
            <a class="btn btn-outline-success me-2" type="button" href="Registro.php">Registrar chica magica!</a>
        </form> 
   
       
       
    </div>
</body>
</html>