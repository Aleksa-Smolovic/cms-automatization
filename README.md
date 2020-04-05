# cms-automatization overview

Tool to automatize CMS development. Created models, migrations, controllers, routes, blade files(index, delete) which contains basic CRUD functions.
Download whole project, setup enviroment and follow instructions.

## Process
Run: 

```
php artisan entity:generate
```

Don't delete necessery markers within the files

## Limitations

- Limited datatypes, front and database
- CMS based, all entities belong to user

## Perks

- Date, datetime format
- Image and file transfer
- Default validation for supported datatypes

## Example:

Basic:

    Model name: News
    Table name: news

    Table field name: title
    or
    Table field name: cover_image
    Field display name: Cover image

    data type -> database data type (image is saved as text)
    input type -> front (html) input type

    Display field -> display field on front

Relationships:

    Other entity model name: Championship
    Foreign key name: championship_id
    Foreign key display name: Lol championship

    Other entity display field -> field name of other entity to display (default id)
    
    Entity must exist in order to create relationship with it

## Example for multiple tables (not tested with new version)

Example is given in `AutomatizationInputController`. Through Postman run `GET` request for route `/test`