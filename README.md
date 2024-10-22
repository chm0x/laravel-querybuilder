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

## first() method

Returns an object(json). Only 1 row and which use an arrow notation. 

```
$posts = DB::table('posts')
             ->where('id', 1)
             ->first();

$posts->columnName;
```

## value() method

Returns row's values only from any column(s) and returns as object(json).

```
$posts = DB::table('posts')
             ->where('id', 2)
             ->value('description')

$posts
```

## find() method

Returns a single row by PRIMARY KEY id. And returns as object(json).

```
$posts = DB::table('posts')
             ->find(3);

$posts
```

The **first(), value() and find()** are important methods of the query builder, these methods are essential for retrieving data from the database.

## toSql() & toRawSql

Show queries
```
$posts = DB::table('posts')
             ->where('id', 4)
             ->toSql();

$posts # This show queries.
```

## pluck() 

It is used to retrieve a SINGLE COLUMNS VALUE from the first result of a query.
Solo nada más recibe los valores de una(s) columna(s). 

```
$posts = DB::table('posts')
             ->pluck('title');

$posts
```

## Insert