# cms-automatization overview

Tool to automatize CMS development. Created models, migrations, controllers, routes, blade files(index, delete) which contains basic CRUD functions.
Download whole project, setup enviroment and follow instructions.

## Process
Inside controller import `TableContent` class which contains information about table attribute:

`use App\TableContent;`

Create function and route. Inside function create empty array ie. `$automateArray = [];`. This array will containe all the tables.
Create instance of the class.

```
$author = new TableContent('string', 'author', 'Autor', 'text', null);
$title = new TableContent('string', 'title', 'Naslov', 'text', null);
```
Create array and insert all instances of the class for one table

```
$contentArray = [$author, $title...];
```

Create array which will contain information about table and previous 'attributes' array. Push the array into previously created array in our case `$automateArray`

```
$arrNews = ['model_name' => 'News', 'table_name' => 'news', 'attributes' => $contentArray];
array_push($automateArray, $arrNews);
```

Repeat the process for as many tables as needed.
At the end,loop through the mentioned array (`$automateArray`) and call function `automateGenerate()` from `GeneratorController`:

```
$testController = new GeneratorController();
for($i = 0; $i < count($automateArray); $i++){
    $testController->automateGenerate($automateArray[$i]);
}
```
## TableContent class breakdown

Required parameters:

- Database attribute data type (supported: string, text, integer, double, date, datetime, image), default(unsignedBigInteger)->avoid
- Database attribute name (directly translated to table)
- Attribute placeholder - attribute display name
- Input type - html form input type (supported: textarea, date, datetime) default: as is ie. number -> '<input type="number"/>'
- Additional data (nullable), holds data required for some fields, ie. for file type image:

```
$guestImage = new TableContent('text', 'image', 'Logo', 'file', ['type' => 'image']);
```

## Array containing all table information breakdown

Required parameters:

- Model name (Laravel model name)
- Table name (database table name)
- Attributes (database attrributes)

```
$arrNews = ['model_name' => 'News', 'table_name' => 'news', 'attributes' => $contentArray];
```

## Limitations

- Foreign keys not supproted
- Process required to use as is, no error handling
- Limited datatypes, front and database
- Required controller, function and route to run it

## Perks

- Date, datetime format
- Image and file transfer
- Default validation for supported datatypes

## Example 

Example is given in `AutomatizationInputController`. Through Postman run `GET` request for route `/test`
