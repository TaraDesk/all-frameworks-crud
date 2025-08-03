import os
from flask import Flask
from dotenv import load_dotenv

from .extensions import login_manager, db, bcrypt, migrate
from .commands import register_commands
from .observer import register_observer
from .middleware import register_middleware

from src.blueprint.core import core
from src.blueprint.tools import tools

def create_app():
    basedir = os.path.abspath(os.path.join(os.path.dirname(__file__), '..'))
    load_dotenv(os.path.join(basedir, '.env'))

    db_path = os.path.join(basedir, 'src', 'database', 'db.sqlite')
    
    app = Flask(
        __name__, 
        template_folder=os.path.join(basedir, 'templates'), 
        static_folder=os.path.join(basedir, 'static'), 
        static_url_path='/static'
    )

    # Config
    app.secret_key = os.getenv('SECRET_KEY', 'SECRET_KEY')
    app.jinja_env.add_extension('jinja2.ext.do')
    app.config['SQLALCHEMY_DATABASE_URI'] = f'sqlite:///{db_path}'
    app.config['UPLOAD_FOLDER'] = os.path.join(basedir, 'static/uploads')

    # Init
    login_manager.init_app(app)
    db.init_app(app)
    bcrypt.init_app(app)
    migrate.init_app(app, db)
    
    # Register
    register_commands(app)    
    register_observer()
    register_middleware(app)

    app.register_blueprint(core, url_prefix='/')
    app.register_blueprint(tools, url_prefix='/tools')

    return app
