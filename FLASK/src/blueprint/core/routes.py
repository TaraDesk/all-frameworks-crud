import os
from flask import request, render_template, redirect, url_for, session, flash
from flask_login import login_user, logout_user, current_user, login_required

from src.extensions import db, bcrypt, login_manager

from .models import User
from src.blueprint.tools.models import Tool

from .validations import LoginForm, RegisterForm, UpdateForm

def register_routes(core):
    # Login Manager
    @login_manager.user_loader
    def load_user(user_id):
        return User.query.get(int(user_id))

    @login_manager.unauthorized_handler
    def unauthorized_callback():
        flash("Please login first!", "danger")
        return redirect(url_for('core.index'))


    # Route
    @core.route('/')
    def index():
        session_form_data = {
            'login_form_data': session.pop('login_form_data', {}),
            'register_form_data': session.pop('register_form_data', {})
        }

        login_form = LoginForm()
        register_form = RegisterForm()        

        return render_template('core/index.html', session_data=session_form_data,
            login_form=login_form, register_form=register_form)

    @core.route('/login', methods=['POST'])
    def login():
        login_form = LoginForm()

        if login_form.validate_on_submit():
            email = login_form.email.data
            password = login_form.password.data          
            user = User.query.filter(User.email == email).first()

            if user and bcrypt.check_password_hash(user.password, password):
                login_user(user)
                flash("Logged in successfully!", "success")
                return redirect(url_for('tools.index'))
            else:
                flash("Invalid email or password", "danger")
                return redirect(url_for('core.index'))
        else:
            for field, errors in login_form.errors.items():
                for error in errors:
                    flash(f"{field.capitalize()}: {error}", "danger")

            session['login_form_data'] = login_form.data
            return redirect(url_for('core.index'))

    @core.route('/register', methods=['POST'])
    def register():
        register_form = RegisterForm() 

        if register_form.validate_on_submit():
            name = register_form.name.data
            email = register_form.email.data
            password = register_form.password.data
            hashed_password = bcrypt.generate_password_hash(password).decode('utf-8')

            user = User(name=name, email=email, password=hashed_password)
            db.session.add(user)
            db.session.commit()

            flash("Registered successfully!, You can now login with your credentials.", "success")
            return redirect(url_for('core.index'))
        else:
            for field, errors in register_form.errors.items():
                for error in errors:
                    flash(f"{field.capitalize()}: {error}", "danger")

            session['register_form_data'] = register_form.data
            return redirect(url_for('core.index'))

    @core.route('/profile', methods=['GET', 'POST'])
    @login_required
    def profile():
        form = UpdateForm()
        user = current_user

        if request.method == 'POST':
            if request.form.get('_method') == 'PUT':
                if form.validate_on_submit():
                    user.name = form.name.data
                    user.email = form.email.data
                    db.session.commit()

                    flash("Update data successful!", "success")
                else:
                    for field, errors in form.errors.items():
                        for error in errors:
                            flash(f"{field.capitalize()}: {error}", "danger")
            elif request.form.get('_method') == 'DELETE':
                db.session.delete(user)
                db.session.commit()
                logout_user()
                
                flash("Your account has been deleted!", "success")
                return redirect(url_for('core.index'))

        return render_template('core/profile.html', form=form, user=user)

    @core.route('/logout', methods=['POST'])
    @login_required
    def logout():
        logout_user()
        flash("Logged out successfully!", "success")
        return redirect(url_for('core.index'))

