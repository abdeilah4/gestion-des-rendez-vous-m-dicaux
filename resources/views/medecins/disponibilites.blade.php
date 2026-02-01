<div class="container">
    <h1>Gérer mes disponibilités</h1>

    <!-- Ajouter une disponibilité -->
    <form action="{{ route('disponibilites.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="jour">Jour</label>
            <input type="date" class="form-control" id="jour" name="jour" required>
        </div>
        <div class="form-group">
            <label for="heure_debut">Heure Début</label>
            <input type="time" class="form-control" id="heure_debut" name="heure_debut" required>
        </div>
        <div class="form-group">
            <label for="heure_fin">Heure Fin</label>
            <input type="time" class="form-control" id="heure_fin" name="heure_fin" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    <hr>

    <!-- Liste des disponibilités -->
    <h2>Mes disponibilités</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Heure Début</th>
                <th>Heure Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disponibilites as $item)
                <tr>
                    <td>{{ $item->jour }}</td>
                    <td>{{ $item->heure_debut }}</td>
                    <td>{{ $item->heure_fin }}</td>
                    <td>
                        <a href="{{ route('disponibilites.edit', $item->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('disponibilites.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>