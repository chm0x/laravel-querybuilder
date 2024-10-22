# QUERY BUILDER 

Show table_name info (requires to install DOCTRINE DBAL):

```
> php artisan db:table table_name
```

Generar las tablas con llave primaria, usar en el Tinker:
```
> php artisan tinker

# use App\Models\User;
# User::factory(10)->create();

# use App\Models\Post;
# Post::factory(5)->create();
```