#Validatorjs API for Laravel 7+

### This package is created to handle the frontend form validation by just writing one set of rules for both Laravel and apply them for frontend also

**This library generates the frontend validation rules for a form and displaying the errors for respected input/options all of this is done by just defining your Laravel Form Requests, and it also supports laravel's custom attributes names and error message customization**


### \*\* This library is far from being perfect and currently dosen't suit all the use cases, but still it will work ifor most requirements \*\*

## TODO
- [ ] Generate the validation rules which are **only supported** by both **Laravel** and **Validatorjs**
- [ ] Add **support** for** Tailwind CSS** errors (Currently only supports auto error display for** Bootstrap 5**)
- [ ] Support for adding** custom validation rules**


## Quick Installation
```bash
$ composer require onemoreblock/laravel-validatorjs
```

## Requirements
- [PHP >= 7.0](http://php.net/)
- [Laravel 7|8](https://github.com/laravel/framework)


#### Configuration
```bash
$ php artisan vendor:publish --provider="OneMoreBlock\Validatorjs\ValidatorJsServiceProvider"
```

### Usage
Currently this package only supports validator js rules generation by using only laravel form requests.
So start by creating a laravel Form Request eg: PostRequest
```bash
$ php artisan make:request PostRequest
```
Now open the generated PostRequest file and add make sure to do trhe following
- Replace the default extends class from **FormRequest**  with **Validatorjs**
- Add a **protected** variable **$tableID ** ( ID of the table for which to apply the validation on)
- Add a **protected** variable **$successCallback ** (function name that is to be called on successful validation)
- Now define you validation rules just like before 😃
Here is the sample example for PostRequest

```php
<?php

namespace App\Http\Requests;

use OneMoreBlock\Validatorjs\Validatorjs;

class PostRequest extends Validatorjs
{
    protected $tableID = 'entries';

    protected $successCallback = 'successCallback';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'f_name' => 'required|min:20|max:30',
            'l_name' => 'required|min:20|max:30',
            'email'  => 'required|email',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'f_name' => 'First name',
            'l_name' => 'Last Name',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'f_name.required' => 'A :attribute is required',
            'l_name.required' => 'A :attribute is required',
        ];
    }
}
```
### Now define your controller in the following manner
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        return (new PostRequest)->render('validatorjs.index'); // blade file
    }
}
```
### Update the view blade file to have following
- Assign form a ID
- Import all the requiered js scripts
- import/define the success callback with the same name as defined earlier

view file example
```blade
<form method="post" id="{{ $table_id }}">
    @csrf
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">First name</label>
        <input type="text" class="form-control" id="validationCustom01" name="f_name" value="Mark">
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Last name</label>
        <input type="text" class="form-control" id="validationCustom02" name="l_name" value="Otto" >
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Email</label>
        <input type="email" class="form-control" id="validationCustom02" name="email" >
    </div>
    <input type="submit" value="Sumit" class="btn btn-sm btn-primary">
</form>
{!! $scripts !!}

<script type="text/javascript">
    function successCallback(data) { // same name as $successCallback defined in the PostRequest
        // Stuff to do after the validation is passed
    }
</script>
```


## License

The Laravel-Validatorjs is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
