@extends('layouts.admin')

@section('title', 'Message Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Message Details</h2>
    <a href="{{ route('admin.contacts') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back to Messages
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $contact->subject }}</h5>
                <span class="badge bg-{{ $contact->status == 'unread' ? 'warning' : 'success' }}">
                    {{ $contact->status }}
                </span>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6>From:</h6>
                    <p class="mb-1"><strong>{{ $contact->name }}</strong></p>
                    <p class="mb-0">
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </p>
                </div>
                
                <div class="mb-4">
                    <h6>Message:</h6>
                    <div class="bg-light p-4 rounded">
                        {!! nl2br(e($contact->message)) !!}
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-primary">
                        <i class="fas fa-reply me-1"></i>Reply via Email
                    </a>
                    @if($contact->status == 'unread')
                        <form method="POST" action="{{ route('admin.contacts.mark-read', $contact) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-1"></i>Mark as Read
                            </button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.contacts.delete', $contact) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this message?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Message Info</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Received:</small>
                    <p class="mb-0">{{ $contact->formatted_date }}</p>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Time ago:</small>
                    <p class="mb-0">{{ $contact->time_ago }}</p>
                </div>
                @if($contact->ip_address)
                <div class="mb-3">
                    <small class="text-muted">IP Address:</small>
                    <p class="mb-0"><code>{{ $contact->ip_address }}</code></p>
                </div>
                @endif
                @if($contact->user_agent)
                <div class="mb-3">
                    <small class="text-muted">Browser:</small>
                    <p class="mb-0 small">{{ Str::limit($contact->user_agent, 50) }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
