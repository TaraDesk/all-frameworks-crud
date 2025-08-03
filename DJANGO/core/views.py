from django.shortcuts import render, redirect
from django.contrib import messages
from django.contrib.auth import authenticate, login as auth_login, logout as auth_logout, get_user
from django.views.decorators.http import require_safe, require_POST, require_http_methods

from .forms import LoginForm, RegisterForm, ProfileForm

@require_safe
def index(request):
    form_data = {
        'login_data': request.session.pop("login_data", {}),
        'register_data': request.session.pop("register_data", {}),
    }

    return render(request, 'core/index.html', {'form_data': form_data})

@require_POST
def login(request):
    form = LoginForm(request.POST)

    if form.is_valid():
        email = form.cleaned_data['email']
        password = form.cleaned_data['password']

        user = authenticate(request, username=email, password=password)
        if user is not None:
            auth_login(request, user)
            messages.success(request, 'Logged in successfully!')
            return redirect('tools:index')
        else:
            messages.error(request, 'Invalid email or password')
    else:
        for field, errors in form.errors.items():
            for err in errors:
                messages.error(request, f"{field.capitalize()}: {err}")

    request.session['login_data'] = { 'email': request.POST.get('email') }
    return redirect('core:index')

@require_POST
def register(request):
    form = RegisterForm(request.POST)

    if form.is_valid():
        form.save()
        messages.success(request, 'Registered successfully!, You can now login with your credentials.')
    else:
        for field, errors in form.errors.items():
            label = form.fields[field].label if field in form.fields else field.capitalize()
            for err in errors:
                messages.error(request, f"{label}: {err}")

        request.session['register_data'] = {
            'name': request.POST.get('name'),
            'email': request.POST.get('email'),
        }

    return redirect('core:index')

@require_http_methods(['GET', 'POST'])
def show(request):
    user = get_user(request)
    form = ProfileForm(instance=user)

    if request.method == 'POST':
        method = request.POST.get('_method')

        if method == 'PUT':
            form = ProfileForm(request.POST, instance=user)
            
            if form.is_valid():
                form.save()
                messages.success(request, "Update data successful!")
                return redirect('core:show')
            else:
                for field, errors in form.errors.items():
                    for err in errors:
                        messages.error(request, f"{field.capitalize()}: {err}")
        elif method == 'DELETE':
            auth_logout(request)
            user.delete()
            messages.success(request, 'Your account has been deleted!')
            return redirect('core:index')

    return render(request, 'core/show.html', {'form': form})

@require_POST
def logout(request):
    auth_logout(request)
    messages.success(request, 'Logged out successfully!')
    return redirect('core:index')