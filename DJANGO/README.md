# Flask Framework 

This project is the **DJANGO** implementation of a basic CRUD application for the all-frameworks-crud collection. In addition to CRUD operations, the project also includes a basic authentication system (login/register) and file upload functionality, offering a complete foundation for typical web applications.

Since HTML forms support only `GET` and `POST`, actions like **update** and **delete** are handled by posting additional hidden fields (`_method`) within the same POST endpoint.

## Requirements

- Python 3.12+
- Django
- SQLite
- virtualenv

## Installation

### 1. Clone the Main Repository and Navigate to the Flask Subproject

```bash
git clone https://github.com/TaraDesk/all-frameworks-crud.git
```

### 2. Create and Activate a Virtual Environment

```bash
python -m venv venv
source venv/bin/activate
```

### 3. Install Dependencies

```bash
pip install -r requirements.txt
```

### 4. Set Up the Environment

Create a `.env` file to store environment variables, or set them manually. To create the `.env` file, run:

```bash
cd all-frameworks-crud/DJANGO
touch .env
```

Then, open the `.env` file and add your environment variables.

```bash
SECRET_KEY=your-generated-secret-key
DEBUG=True
ALLOWED_HOSTS=127.0.0.1,localhost
CSRF_TRUSTED_ORIGINS=http://127.0.0.1:8000
```
#### Generate a Secure Secret Key
To generate a new Django SECRET_KEY, run the following command:

```bash
python -c "from django.core.management.utils import get_random_secret_key; print(get_random_secret_key())"
```

Copy the output and paste it in place of your-generated-secret-key above.

### 5. Apply Migrations and Create Superuser

```bash
python manage.py makemigrations
python manage.py migrate
python manage.py createsuperuser
```

### 6. Run the Application

```bash
python manage.py runserver
```
Once the server starts, **click the link shown in your terminal** (usually `http://127.0.0.1:8000`) to open the app in your browser.

## Project Structure

| Path               | Description                                                          |
| ------------------ | -------------------------------------------------------------------- |
| `crud/`            | Main Django project folder containing settings and URL configuration |
| `core/`            | Django app for authentication and user management                    |
| `tools/`           | Django app for tools management (CRUD operations)                    |
| `templates/`       | Shared Django templates for UI rendering                             |
| `static/`          | Static files such as CSS and JavaScript                              |
| `storage/`         | Directory for uploaded files                                         |
| `core/middleware/` | Custom middleware definitions                                        |
| `tools/signals.py` | Custom observer logic using Django signals                           |

## Features & Concepts Implemented

| Concept             | Description                                                                      |
| ------------------- | -------------------------------------------------------------------------------- |
| **Routing**         | Uses Django’s `urls.py` with function-based views for handling HTTP requests     |
| **Middleware**      | Custom middleware for request/response processing, aligned with other frameworks |
| **Observer**        | Uses Django signals to observe and respond to model events                       |
| **Validation**      | Input validation using Django Forms and ModelForms                               |
| **Error Handling**  | Form errors and system messages displayed using Django’s messages framework      |
| **Database Access** | Data managed via Django ORM                                                      |
| **Authentication**  | Built-in session-based authentication with custom user model                     |
| **File Upload**     | Handled via `ImageField`, with files stored in `MEDIA_ROOT`        |

## Available Routes

| Method  | URI               | Description                                        |
|---------|-------------------|----------------------------------------------------|
| GET     | `/`               | Entrance page (login/register)                    |
| POST    | `/login`          | Process login                                     |
| POST    | `/register`       | Process registration                              |
| GET     | `/tools`          | List all tools created by the authenticated user  |
| POST    | `/tools`          | Create a new tool                                 |
| GET     | `/tools/{slug}`   | View a specific tool                              |
| POST    | `/tools/{slug}`   | Update the specified tool                         |
| POST  | `/tools/{slug}`   | Delete the specified tool                         |
| GET     | `/profile`        | Show the user's profile                           |
| POST    | `/profile`        | Update the user's profile                         |
| POST  | `/profile`        | Delete the user's account                         |
| POST    | `/logout`         | Log out the authenticated user                   |

> ⚠️ Note: Since HTML forms support only `GET` and `POST`, `PUT` and `DELETE` actions are handled by posting a hidden `_method` field in POST handlers.

## License

This project is licensed under the MIT License.

## Part of

**[`all-frameworks-crud`](https://github.com/TaraDesk/all-frameworks-crud)** – a multi-framework learning project showing how CRUD patterns work across languages.
