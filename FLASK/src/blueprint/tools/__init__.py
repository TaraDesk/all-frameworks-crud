from flask import Blueprint

tools = Blueprint(
    'tools', 
    __name__, 
    template_folder='templates'
)

from .routes import register_routes

register_routes(tools)