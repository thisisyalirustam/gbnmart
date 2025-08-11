@extends('admin.layout.content')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

    <div class="pagetitle">
        <h1>Edit Blog</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.blog') }}"
                        class="text-decoration-none text-muted">Blogs</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Update Your Blog</div>
                    <div class="card-body">
                        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                            enctype="multipart/form-data" id="editBlogForm">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $blog->title }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" class="form-select" required>
                                    <option value="{{ $blog->product_cat->id }}">{{ $blog->product_cat->name }}</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status" required>
                                    <option value="draft" {{ $blog->is_published == false ? 'selected' : '' }}>Draft
                                    </option>
                                    <option value="published" {{ $blog->is_published == true ? 'selected' : '' }}>Published
                                    </option>
                                </select>
                            </div>


                            <div class="form-group mb-3">
                                <label class="form-label">Featured Image</label><br>
                                @if ($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="Image" class="image-preview mb-2"
                                        width="200">
                                @endif
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Content</label>
                                <div id="editor" style="min-height: 300px;">{!! $blog->content !!}</div>
                                <input type="hidden" name="content" id="contentInput">
                            </div>

                            <div class="form-group d-flex gap-3">
                                <button type="submit" class="btn btn-success">Update Blog</button>
                                <a href="{{ route('admin.blog') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        let quill = new Quill('#editor', {
            theme: 'snow'
        });

        // On submit: transfer Quill content to hidden input
        document.getElementById('editBlogForm').addEventListener('submit', function(e) {
            document.getElementById('contentInput').value = quill.root.innerHTML;
        });
    </script>
@endsection
