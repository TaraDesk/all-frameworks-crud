from werkzeug.utils import secure_filename
import re, os, uuid
from datetime import datetime
from flask import request, render_template, redirect, url_for, session, flash, current_app
from flask_login import login_required, current_user

from src.extensions import db
from .models import Tool
from .validations import CreateTool, UpdateTool

def slugify(text):
    slug = re.sub(r'[^\w\s-]', '', text).strip().lower()
    slug = re.sub(r'[\s_-]+', '-', slug)
    unique_id = str(uuid.uuid4())[:8]
    slug = f"{slug}-{unique_id}"
    return slug

def generate_unique_filename(original_filename):
    _, ext = os.path.splitext(original_filename)
    unique_name = str(uuid.uuid4())
    new_filename = unique_name + ext
    return new_filename


def register_routes(tools):
    @tools.route('/', methods=['GET', 'POST'])
    @login_required
    def index():
        form = CreateTool()
        tools = Tool.query.filter_by(user_id=current_user.id).all()

        if request.method == 'POST':
            if form.validate_on_submit():
                f = form.image.data
                filename = secure_filename(generate_unique_filename(f.filename))
                file_path = os.path.join(current_app.config['UPLOAD_FOLDER'], filename)
                f.save(file_path)

                tool = Tool(user_id=current_user.id,
                    name=form.name.data, slug=slugify(form.name.data),
                    link=form.link.data, description=form.description.data, image=file_path)

                db.session.add(tool)                
                db.session.commit()
                
                flash(f'{tool.name} has been created!', "success")
                return redirect(url_for('tools.index'))
            else:
                for field, errors in form.errors.items():
                    for error in errors:
                        flash(f"{field.capitalize()}: {error}", "danger")

        return render_template('tools/index.html', form=form, tools=tools, user=current_user)

    @tools.route('/<string:slug>', methods=['GET', 'POST'])
    @login_required
    def show(slug):
        form = UpdateTool()

        tool = db.one_or_404(db.select(Tool).filter_by(slug=slug, user_id=current_user.id))
        url = tool.image
        relative_image_path = url.split('static/')[1]

        if request.method == 'POST':
            if request.form.get('_method') == 'PUT':
                if form.validate_on_submit():
                    if tool.name != form.name.data:
                        tool.slug = slugify(form.name.data)

                    if form.image.data:
                        f = form.image.data
                        filename = secure_filename(generate_unique_filename(f.filename))
                        file_path = os.path.join(current_app.config['UPLOAD_FOLDER'], filename)
                        f.save(file_path)
                        
                        tool.image = file_path

                    tool.name = form.name.data
                    tool.link = form.link.data
                    tool.description = form.description.data

                    db.session.commit()

                    flash(f'{tool.name} has been updated!', "success")
                    return redirect(url_for('tools.show', slug=tool.slug))
                else:
                    for field, errors in form.errors.items():
                        for error in errors:
                            flash(f"{field.capitalize()}: {error}", "danger")
                             
            elif request.form.get('_method') == 'DELETE':
                name = tool.name

                db.session.delete(tool)
                db.session.commit()
                
                flash(f'{name} has been deleted!', "success")
                return redirect(url_for('tools.index'))

        return render_template('tools/show.html', form=form, tool=tool, user=current_user, image_path=relative_image_path)