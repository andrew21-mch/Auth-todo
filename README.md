# Simple Todo API with Authentication

This is a simple todo API with authentication. It is built with Node.js, Express, MongoDB and Mongoose.

## Installation

1. Clone the repo
2. Run `npm install`
3. Run `php artisan migrate`
4. Run `php artisan db:seed`
5. Run `php artisan serve`
6. Visit `http://localhost:8000`



## Usage

<!-- use table -->

| Method | Endpoint | Description |
| ------ | -------- | ----------- |
| POST | `api/register` | Register a new user |
| POST | `api/login` | Login a user |
| GET | `api/todo/get` | Get all todos |
| POST | `api/todo/create` | Create a new todo |
| GET | `/api/todo/:id` | Get a single todo |
| PUT | `/api/todo/edit/:id` | Update a todo |
| DELETE | `/api/todo/delete/:id` | Delete a todo |


## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

###  How to Contribute

1. Fork it
2. clone it using `git clone <repo url>`
3. Create your feature branch (`git checkout -b my-new-feature`)
4. Commit your changes (`git commit -am 'Add some feature`)
5. Push to the branch (`git push origin my-new-feature`)
6. Create new Pull Request

## License

[MIT](https://choosealicense.com/licenses/mit/)

## Author

<a href="https://twitter.com/nfonandrew73">Nfon Andrew</a>

## Acknowledgements


