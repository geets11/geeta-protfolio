@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Contact Messages</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($contacts->count() > 0)
    <div class="row">
        @foreach($contacts as $contact)
        <div class="col-md-6 mb-4">
            <div class="card {{ $contact->status == 'unread' ? 'border-warning' : '' }}">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">{{ $contact->name }}</h6>
                    <div>
                        <span class="badge bg-{{ $contact->status == 'unread' ? 'warning' : 'success' }} me-2">
                            {{ $contact->status }}
                        </span>
                        @if($contact->status == 'unread')
                            <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Email:</strong> 
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </p>
                    <p class="mb-2"><strong>Subject:</strong> {{ $contact->subject }}</p>
                    <p class="mb-3"><strong>Message:</strong></p>
                    <div class="bg-light p-3 rounded mb-3">
                        {{ Str::limit($contact->message, 200) }}
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>{{ $contact->formatted_date }}
                        </small>
                        <div>
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-primary me-2">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <form method="POST" action="{{ route('admin.contacts.delete', $contact) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center">
        {{ $contacts->links() }}
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-inbox fa-4x text-muted mb-4"></i>
            <h4>No contact messages yet.</h4>
            <p class="text-muted">Messages sent through the contact form will appear here.</p>
            <a href="{{ route('home') }}#contact" class="btn btn-primary">
                <i class="fas fa-external-link-alt me-1"></i>View Contact Form
            </a>
        </div>
    </div>
@endif
@endsection
