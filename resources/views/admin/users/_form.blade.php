@csrf

<div class="mb-4">
    <label for="nom" class="block text-gray-700">Nom</label>
    <input type="text" id="nom" name="nom" value="{{ old('nom', $user->nom ?? '') }}" class="border rounded w-full py-2 px-3">
</div>

<div class="mb-4">
    <label for="prenom" class="block text-gray-700">Prénom</label>
    <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom ?? '') }}" class="border rounded w-full py-2 px-3">
</div>

<div class="mb-4">
    <label for="email" class="block text-gray-700">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="border rounded w-full py-2 px-3">
</div>

<div class="mb-4">
    <label for="pseudo" class="block text-gray-700">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="{{ old('pseudo', $user->pseudo ?? '') }}" class="border rounded w-full py-2 px-3">
</div>

<div class="mb-4">
    <label for="date_naissance" class="block text-gray-700">Date de naissance</label>
    <input type="date" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance ?? '') }}" class="border rounded w-full py-2 px-3">
</div>

@if (!isset($user)) <!-- Mot de passe seulement lors de la création -->
    <div class="mb-4">
        <label for="password" class="block text-gray-700">Mot de passe</label>
        <input type="password" id="password" name="password" class="border rounded w-full py-2 px-3">
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block text-gray-700">Confirmer le mot de passe</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="border rounded w-full py-2 px-3">
    </div>
@endif

<div class="mb-4">
    <label for="role" class="block text-gray-700">Rôle</label>
    <select id="role" name="role" class="border rounded w-full py-2 px-3">
        <option value="user" {{ old('role', $user->role ?? 'user') == 'user' ? 'selected' : '' }}>Utilisateur</option>
        <option value="admin" {{ old('role', $user->role ?? 'user') == 'admin' ? 'selected' : '' }}>Administrateur</option>
    </select>
</div>
