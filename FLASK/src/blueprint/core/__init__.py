from flask import Blueprint

core = Blueprint(
    'core', 
    __name__, 
    template_folder='templates'
)

from .routes import register_routes

register_routes(core)