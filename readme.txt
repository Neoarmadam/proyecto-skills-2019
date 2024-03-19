//Tablas E/R
Genero(Nombre, Descripcion)
Roles_Usuario(Nombre, Descripcion)
Juegos(Nombre, -Generos, Descripcion, Votos Positivos, Votos Negativos, Imagen)
Usuario (Nombre, Contraseña, -Rol)


php bin/console doctrine:fixtures:load