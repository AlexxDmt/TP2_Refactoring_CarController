<!DOCTYPE html>
<html>
  <head>
    <title>Voitures</title>
  </head>
  <body>
    <h1>Liste des voitures</h1>
    <table>
      <thead>
        <tr>
          <th>Marque</th>
          <th>Modèle</th>
          <th>Produit</th>
        </tr>
      </thead>
      <tbody>
        @foreach($v as $car)
        <tr>
          <td>{{ $car->brand }}</td>
          <td>{{ $car->model }}</td>
          <td>{{ $car->product }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </ul>
  </body>
</html>
