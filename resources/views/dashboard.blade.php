<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: #0d6efd;
        }
        .navbar-brand, .nav-link, .navbar-text {
            color: #fff !important;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .table th {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg px-4">
        <a class="navbar-brand fw-bold" href="#">My Dashboard</a>
        <div class="ms-auto d-flex align-items-center">
            <span class="navbar-text me-3">
                Welcome, <strong>{{ Auth::user()->name }}</strong>
            </span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-5">

        <!-- CARD: CREATE POST -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Post</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="3" placeholder="Enter content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Add Post</button>
                </form>
            </div>
        </div>

        <!-- CARD: POSTS TABLE -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">All Posts</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Title</th>
                            <th>Content</th>
                            <th width="25%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>
                                <!-- UPDATE FORM -->
                                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex gap-1">
                                        <input type="text" name="title" value="{{ $post->title }}" class="form-control form-control-sm w-25">
                                        <input type="text" name="content" value="{{ $post->content }}" class="form-control form-control-sm w-50">
                                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                    </div>
                                </form>

                                <!-- DELETE FORM -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mt-1">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No posts yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
