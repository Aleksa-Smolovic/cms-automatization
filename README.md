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

- Foreign keys not supproted
- Process required to use as is, no error handling
- Limited datatypes, front and database

## Perks

- Date, datetime format
- Image and file transfer
- Default validation for supported datatypes

## Example for multiple tables (not tested with new version)

Example is given in `AutomatizationInputController`. Through Postman run `GET` request for route `/test`
