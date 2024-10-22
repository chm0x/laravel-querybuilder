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

## WHAT IS A QUERY BUILDER?

Laravel Query Builder is a set of classes and methods that provide a simple and elegant way to interact with Databases. 

**It is an alternative to writing raw SQL queries.**

