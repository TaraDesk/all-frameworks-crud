from django.shortcuts import render, redirect
from django.contrib.auth import get_user
from django.contrib import messages
from django.views.decorators.http import require_http_methods

from .models import Tool
from .forms import CreateForm, UpdateForm

@require_http_methods(['GET', 'POST'])
def index(request):
    user = get_user(request)
    tools = Tool.objects.all().filter(user_id=user.id)
    form = CreateForm()

    if request.method == 'POST':
        form = CreateForm(request.POST, request.FILES)

        if form.is_valid():
            tool = form.save(commit=False)
            tool.user_id = user
            tool.save()

            messages.success(request, f'{tool.name} has been created!')
            return redirect('tools:index')
        else:
            for field, errors in form.errors.items():
                for err in errors:
                    messages.error(request, f"{field.capitalize()}: {err}")

    return render(request, 'tools/index.html', { 'tools': tools, 'form': form })

@require_http_methods(['GET', 'POST'])
def show(request, slug):
    user = get_user(request)
    tool = Tool.objects.filter(user_id=user.id).get(slug=slug)
    form = UpdateForm(instance=tool)

    if request.method == 'POST':
        method = request.POST.get('_method')

        if method == 'PUT':
            form = UpdateForm(request.POST, request.FILES, instance=tool)
            if form.is_valid():
                new_tool = form.save()
                messages.success(request, f'{new_tool.name} has been updated!')
                return redirect('tools:show', slug=new_tool.slug)
            else:
                for field, errors in form.errors.items():
                    for err in errors:
                        messages.error(request, f"{field.capitalize()}: {err}")

        elif method == 'DELETE':
            name = tool.name
            tool.delete()

            messages.success(request, f'{name} has been deleted!')
            return redirect('tools:index')

    return render(request, 'tools/show.html', { 'tool': tool, 'form': form })