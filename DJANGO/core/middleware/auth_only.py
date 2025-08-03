from django.shortcuts import redirect
from django.contrib import messages
from django.conf import settings
from django.urls import resolve, Resolver404

class AuthOnlyMiddleware:
    def __init__(self, get_response):
        self.get_response = get_response

    def __call__(self, request):
        guest_only_route = ['/', '/login', '/register']

        if not request.user.is_authenticated and not request.path in guest_only_route:
            messages.error(request, "Please login first!")
            return redirect('core:index')

        return self.get_response(request)