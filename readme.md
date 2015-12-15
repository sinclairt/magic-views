# Magic Views

Magic views are a quick and simple way to implement crud views with as little or as much customisation as you want.

### Installation
Add the following repository to your ``` composer.json ```. You will have access as long as you belong to the Sterling team on Bitbucket.
  ``` sh
  "repositories": [
    {
      "type": "composer",
      "url": "http://satis.sterling-design.co.uk"
    }
  ]
```
``` composer require sterling/magic-views ```
``` composer install ```

Add the service provider to your ``` app/config ```
```sh
Sterling\MagicViews\MagicViewsServiceProvider::class
```
``` composer dump-autoload ```

### Usage
Use the trait in your controller ``` use HasMagicViews; ```. As it stands, there are four views: index, create, edit, and show. The edit and update views require a ``` $model ``` variable, the index view requires a ``` $rows ``` variable which should be an instance of ``` Illuminate\Pagination\Paginator ```. You can get a paginated object by using ``` paginate() ``` on the end of your query instead of ``` get() ``` i.e.
``` sh
$users = User::where('votes', '>', 100)->paginate(15);
```
So an index method might look something like this:
``` sh
public function index()
{
    $rows = User::where('votes', '>', 100)->paginate(15);

    return $this->indexView(compact('rows'));
}
```

Create like this...
``` sh
public function create()
{
    return $this->createView();
}
```
Edit...
``` sh
public function edit($model)
{
    return $this->editView(compact('model'));
}
```
Show...
``` sh
public function show($model)
{
    return $this->showView(compact('model'));
}
```
### Assumptions
Magic  Views makes a few assumptions to ensure your views are rendered with as little configuration as possible:
  - You are using resourceful routing where your route names are the same as the model i.e. ``` User ``` model means ``` Route::resource('user', 'UserController'); ```
  - You are following a naming convention with your models and controllers i.e. a ``` User ``` model has a controller of ``` UserController ```
  - You have registered the model in the IoC container by its short name i.e. ``` App\Models\User ``` is registered in the IoC container as ``` User ```
  ``` sh
    $this->app->bind('User', 'App\Models\User'); // or an interface if you are following the SOLID principles
  ```


### Settings
The index view will use the ``` $fillable ``` array and the ``` $hidden ``` array to decide which columns to show, but you can over ride this by setting the ``` $indexColumns ``` variable on your model:
``` sh
public $indexColumns = [ 'username', 'email', 'created_at'];
```
The create and edit views use the ``` $fillable ``` array to display fields on the forms, these will default to text but you can over ride this by setting the ``` $fields ``` variable on your model:
``` sh
public $fields = [
    'username'              => 'text',
    'password'              => 'password',
    'email'                 => 'email',
    'password_confirmation' => 'password'
];
```
The key is the field name, the value is the field type.

##### Available field types:
   - text
   - email
   - password
   - radio
   - select
   - checkbox
   - text-area
   - select

##### Field Notes

A select requires options, set the options by passing in a variable with the naming convention of *fieldname*Options i.e. role would be ``` $roleOptions ```. This variable should an associative array with the key as the value to submit from the form i.e. the id, and the value as the display value for the option i.e. the name.
``` sh
$roleOptions = [
    3   => 'admin',
    5   => 'standard',
    10  => 'supervisor'
];
```

#####  Buttons
On the index view are some buttons: show, edit, delete, and where your model uses soft deletes restore. By default all buttons are on ( when an object is trashed only restore and show are visible, and when its not restore is hidden, and edit and delete are added. You can configure the buttons you want to show by passing in a ``` $buttons ``` variable with the buttons you wish to show:
``` sh
// this will enable the show and edit buttons only
$buttons = ['show', 'edit'];

return $this->indexView(compact('rows', 'buttons'));
```

##### Display Values
There are three ways to approach this, as the value is, using Laravel's mutators, or using a presenter. If your happy using the first two, then there is nothing more to do, then to read up on Eloquent Mutators if neccessary. If you would like to use a presenter, Magic Views will look for this so that it can be used in the view, it will assume the method on the presenter is the field name camel cased i.e. ``` user_id ``` becomes  ``` userId ```. If you would like to overide the name of the presenter method to use tthen pass in a variable with the naming convention of present*FieldName* i.e ``` user_id ``` would become ``` $presentUserId ```; you would then pass this a string of the method name you would like to use e.g. let's say you want to present the username instead of the user_id, and your method on your presenter is ``` userName ``` you would do the following:
``` sh
$presentUserId = 'userName';

return $this->indexView(compact('model', 'presentUserId'));
```
Now Magic Views will load the userName method instead.

##### Other Variables
Magic views creates the following variables to put into the view, you can overide them by passing in the variable(s) yourself:
  - breadcrumbs
  - action (this is the action on forms)
  - pageTitle
  - pageSubTitle
  - panelTitle

##### Additional Content
Magic Views allows you to add additional content to both the forms and the pages. To do this, create a view and pass the view name to one of the following variables and inject to the view:
  - ``` $additionalFormContentBefore ``` Adds content before the form fields but inside the form
  - ``` $additionalFormContentAfter ``` Adds content after the form field but inside the form
  - ``` $additionalContentBefore ``` Adds content before the panel of content
  - ``` $additionalContentAfter ``` Adds content after the panel of content

``` sh
$additionalContentAfter = 'partials.product.options';

return $this->indexView(compact('rows', 'additionalContentAfter'));
```

##### Further Customisation
You can further customise the views by changing the config values, the language values, or the editing the views themselves. To do this publish the assets of the package by running  ``` php artisan vendor:publish ```. All values displayed outside of model and presenter values, are passed through a language file first, there is an example for users in the language file already. The term ``` user ``` sits on the top level of the array, but for the fields of the ``` user ``` including the column names in the index view, sit inside the fields array. Placeholders can also be set here where applicable just add ``` _placeholder ``` onto the end of the column/field name.

If you would like to swap out any of the partials for your own, you can change the value in the config file. You can also change the title tag, brand image, nav-links, form-action assumptions, and any breadcrumb prefix you may want i.e. home or dashboard.

Beyond this, you can edit the views themselves.

### Finally
You can extend the Magic Views so long as you create them. For example, lets take a stats page for a user, create a ``` stats.blade.php ```, which might extend the ``` magic-views::layout.master ``` and add a section ``` content ``` with your content inside. Now you can call ``` return $this->myView(['blade' => 'path.to.stats']); ``` in your controller. Or, if you publish the assets (``` php artisan vendor:publish ``` ), and put your view inside ``` resources/views/vendor/magic-views/crud ``` you can call ``` $this->statsView(); ```

There are two yield methods in the layout for code to go into the ``` head ``` and the ``` foot ``` should you need it.