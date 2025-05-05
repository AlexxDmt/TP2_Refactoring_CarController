<!DOCTYPE html>
<html>
<head>
    <title>Voiture {{ $car->id ?? 'defaut'}}</title>
</head>
<body>
<h1>Voiture {{ $car->id ?? 'defaut'}}</h1>
<ul>
    <li>Marque: {{ $car->brand?? 'defaut'}}</li>
    <li>Modèle: {{ $car->model ?? 'defaut'}}</li>
    <li>Produit: {{ $car->product ?? 'defaut'}}</li>
</ul>
</body>
</html>
