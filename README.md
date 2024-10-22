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

## BASICs

Selecting and using 'AS' as SQL querie to renaming column. 
```
$posts = DB::table('posts')
             ->select('excerpt AS summary', 'description')
             ->get();
```

Using **distinct**
```
$posts = DB::table('posts')
            ->select('is_published')
            ->distinct()
            ->get();
```

Continue with retrieving. Use get() method at the end of the query builder.
```
$posts = DB::table('posts')
            ->select('is_published');
        
$added = $posts->addSelect('title')->get();
```




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

insertar esos valores y se retorna tipo booleana.
```
$posts = DB::table('posts')
                     ->insert([
                        'user_id' => 1,
                        'title' => 'Inserted through Query Builder',
                        'slug' => 'query-builder',
                        'excerpt' => 'excerpt',
                        'description' => 'Laboris eiusmod ipsum cupidatat et et nisi eiusmod nisi.',
                        'is_published' => true,
                        'min_to_read' => 2
                     ]);
$posts
```

Insert multiples values inside of nestged arrays
```
$posts = DB::table('posts')
            ->insert([
                        [
                        'user_id' => 2,
                        'title' => 'Reprehenderit quis',
                        'slug' => 'reprehenderit-quis',
                        'excerpt' => 'excerpt',
                        'description' => 'Nulla ex id ex deserunt nulla deserunt laborum mollit.',
                        'is_published' => true,
                        'min_to_read' => 5
                        ],
                        [
                        'user_id' => 4,
                        'title' => 'Lorem do qui',
                        'slug' => 'lorem-do-qui',
                        'excerpt' => 'excerpt',
                        'description' => 'Veniam eiusmod incididunt non nostrud tempor occaecat proident aliquip occaecat.',
                        'is_published' => false,
                        'min_to_read' => 1
                        ]
            ]);
```

### insertOrIgnore()

This method allows you to insert data into a database table ONLY IF THE DATA DOESN'T ALREADY EXISTS IN THE TABLE. If there is a conflict with a primary key or unique key constraints, the insertOrIgnore() method will simply ignore the insert operation and move on to the next one.
**It is useful when you need to ensure that there are no duplicates records in your table**.
Returns boolean value.
```
$posts = DB::table('posts')
            ->insertOrIgnore([
                        [
                        'user_id' => 2,
                        'title' => 'Reprehenderit quis',
                        'slug' => 'reprehenderit-quis',
                        'excerpt' => 'excerpt',
                        'description' => 'Nulla ex id ex deserunt nulla deserunt laborum mollit.',
                        'is_published' => true,
                        'min_to_read' => 5
                        ],
                        [
                        'user_id' => 4,
                        'title' => 'Lorem do qui',
                        'slug' => 'lorem-do-qui',
                        'excerpt' => 'excerpt',
                        'description' => 'Veniam eiusmod incididunt non nostrud tempor occaecat proident aliquip occaecat.',
                        'is_published' => false,
                        'min_to_read' => 1
                        ]
            ]);
```

### upsert()

This method on the query builder in laravel is a powerful tool for performing insert or update operations on LARGE DATASETS.

Has two arguments, one the data and the other is which consist of an array of column names to use for *matching*. That means that if a row with a matching 'title' or 'slug' already exists in the table, it will be *updated* with a new name and value. If no such row exists, a new row will be inserted. 

```
$posts = DB::table('posts')
                     ->upsert([
                       
                        'user_id' => 4,
                        'title' => 'Cupidatat duis',
                        'slug' => 'cupidatat-duis',
                        'excerpt' => 'excerpt',
                        'description' => 'Consequat magna duis irure commodo.',
                        'is_published' => true,
                        'min_to_read' => 2
                       
                     ], ['title', 'slug']);
```

## insertGetId()

Not used. 

It allows you to insert a new record into a table and RETRIEVE its ID in a single query.
**Returns an ID only**.
```
$posts = DB::table('posts')
            ->insertGetId([
                'user_id' => 3,
                'title' => 'Occaecat ea',
                'slug' => 'occaecat-ea',
                'excerpt' => 'excerpt',
                'description' => 'Pariatur consectetur occaecat enim cupidatat ut.',
                'is_published' => false,
                'min_to_read' => 4
            ]);
```

## update()



```
$posts = DB::table('posts')
            ->where('id',2)
            ->update([
                'excerpt' => 'Nostrud anim dolor anim ipsum adipisicing in anim quis dolore ea.'
                'description' => 'Laravel 10'
            ]);
```

The update() method can also be used with the orWhere() method to update multiple records at once.
**The order matters the where() and orWhere() methods**.

```
$posts = DB::table('posts')
            ->where('id', 2)
            ->orWhere('id', 3)
            ->update([
            'excerpt' => 'Laravel 10.*',
            'description' => 'probando los metodos where y orWhere ',
            ]);
```

### increment() & decrement()

Those methods are used to increment or decrement the value of a column by given amount.

**increase**
By default, 1. 
```
$posts = DB::table('posts')
             ->where('id', 1)
             ->increment('min_to_read');
```
With a specific amount to increase/decrease.
```
$posts = DB::table('posts')
             ->where('id', 1)
             ->increment('min_to_read', 5); # Mean, the current value plus 5.
```

**decrement**
```
$posts = DB::table('posts')
             ->where('id', 1)
             ->decrement('min_to_read');
```

### incrementEach() & decrementEach()
Not used
```
$posts = DB::table('posts')
             ->where('id', '>',1)
             ->incrementEach(['min_to_read', 'lines'], [5]);
```

### updateOrInsert()

This method is used to update an existing record or insert a new record if it does not exists.

```
$posts = DB::table('posts')
             ->updateOrInsert([
                'excerpt' => 'Laravel 11',
                'description' => 'Laravel 11 a toda madre'
            ], [ 'id' => 1 ]);
```

## delete()

Borrar un registro o todos. Recuerda usar el where() antes de borra todo.
```
 $posts = DB::table('posts')
             ->where('id', 4)
             ->delete();
```

And it can multiple chains.
```
$posts = DB::table('posts')
             ->where('id', 4)
             ->where('title', 'Reprehenderit quis')
             ->delete();
```
```
$posts = DB::table('posts')
             ->where('id', 4)
             ->orWhere('title', 'Reprehenderit quis')
             ->delete();
```

## truncate()

It will wipe out the entire table. 

```
$posts = DB::table('posts')
             ->truncate();
```

## AGGREGATES METHODS 

### count()
```
$posts = DB::table('posts')
             ->count();
```

```
$posts = DB::table('posts')
             ->where('is_published', true)
             ->count();
```

### sum()
```
$posts = DB::table('posts')
            ->sum('min_to_read');
```

### avg()
```
$posts = DB::table('posts')
            ->avg('min_to_read');
```

```
$posts = DB::table('posts')
            ->where('is_published', true)
            ->avg('min_to_read');
```

### max()

```
$posts = DB::table('posts')
            ->max('min_to_read')

$posts = DB::table('posts')
            ->where('is_published', true)
            ->max('min_to_read');
```

### min()
```
$posts = DB::table('posts')
            ->min('min_to_read')

$posts = DB::table('posts')
            ->where('is_published', true)
            ->min('min_to_read');
```

## whereNot() and orWhereNot()

**whereNot**

They used to exclude certain data from the query result.

```
$posts = DB::table('posts')
            ->whereNot('min_to_read', '=', 3)
            ->get();

$posts = DB::table('posts')
            ->whereNot('min_to_read', '>', 5)
            ->get();
```

**orWhereNot**
```
$posts = DB::table('posts')
            ->where('min_to_read', '>', 3)
            ->orWhereNot('is_published', true)
            ->get();

$posts = DB::table('posts')
            ->where('min_to_read', '>', 3)
            ->orWhereNot('is_published', true)
            ->toSql();
```

## exists()

Its used to check if a value exists. Returns boolean type.

Context: the id doesnt exists. So to check if the data exists.
```
$posts = DB::table('posts')
                ->where('id', 35235)
                ->exists();
```

### doesntExist()

It is used to check if a query result doesn't exist.
En otras palabras, ese metodo checa si el dato no existe, regresa como verdadero. 

```
$posts = DB::table('posts')
            ->where('id', 35235)
            ->doesntExist();
```

## whereBetween() and whereNotBetween()

**whereBetween()**
```
$posts = DB::table('posts')
            ->whereBetween('min_to_read', [1,3])
            ->get();

$posts = DB::table('posts')
            ->whereBetween('min_to_read', [1,3])
            ->toSql();
```

**whereNotBetween()**
```
$posts = DB::table('posts')
            ->whereNotBetween('min_to_read', [1,3])
            ->get();

$posts = DB::table('posts')
            ->whereNotBetween('min_to_read', [1,3])
            ->toSql();
```
