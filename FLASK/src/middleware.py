from flask import request, redirect, url_for, flash
from flask_login import current_user

def register_middleware(app):

    @app.before_request
    def guest_middleware():
        guest_only_routes = ['core.index', 'core.login', 'core.register']
        if current_user.is_authenticated and request.endpoint in guest_only_routes:
            flash("Please logout your account first", "danger")
            return redirect(url_for('tools.index'))