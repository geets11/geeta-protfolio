@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <div>
        <span class="text-muted">Welcome back!</span>
        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline ms-3">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="fas fa-sign-out-alt me-1"></i>Logout
            </button>
        </form>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_contacts'] }}</div>
            <div class="stat-label">Total Messages</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-number text-warning">{{ $stats['unread_contacts'] }}</div>
            <div class="stat-label">Unread Messages</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-number text-success">{{ $stats['contacts_today'] }}</div>
            <div class="stat-label">Today's Messages</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-number text-info">{{ $stats['contacts_this_week'] }}</div>
            <div class="stat-label">This Week</div>
        </div>
    </div>
</div>

<!-- Recent Messages -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Recent Messages</h5>
        <a href="{{ route('admin.contacts') }}" class="btn btn-primary btn-sm">
            View All Messages
        </a>
    </div>
    <div class="card-body">
        @if($recent_contacts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ Str::limit($contact->subject, 30) }}</td>
                            <td>
                                <span class="badge bg-{{ $contact->status == 'unread' ? 'warning' : 'success' }}">
                                    {{ $contact->status }}
                                </span>
                            </td>
                            <td>{{ $contact->time_ago }}</td>
                            <td>
                                <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">No messages yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
