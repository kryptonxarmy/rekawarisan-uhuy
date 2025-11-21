@extends('frontend.layout.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Tulis Artikel Baru</h2>

    @if(session('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
    @endif

    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full mt-1 px-3 py-2 border rounded">
            @error('title') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Sampul (opsional)</label>
            <div class="mt-1 flex items-center gap-4">
                <label for="cover" class="inline-flex items-center px-4 py-2 bg-white border rounded cursor-pointer hover:bg-gray-50">
                    <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3v4M8 3v4m1 4h6"></path></svg>
                    <span class="text-sm text-gray-700">Pilih file</span>
                </label>
                <span id="cover-filename" class="text-sm text-gray-600">Tidak ada file dipilih</span>
            </div>
            <input id="cover" type="file" name="cover" accept="image/*" class="hidden" />
            <div id="cover-preview" class="mt-4 hidden">
                <img id="cover-preview-img" src="#" alt="Preview" class="w-48 h-auto rounded shadow" />
            </div>
            @error('cover') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Isi Artikel</label>
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor input="body" class="prose max-w-none border rounded bg-white"></trix-editor>
            @error('body') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded">Kirim Artikel</button>
            <a href="{{ route('pustakawarisan') }}" class="ml-3 text-gray-600">Batal</a>
        </div>
    </form>
</div>
<!-- Trix editor + upload handling -->
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
<script>
    // Ensure CSRF token is available for fetch
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

    document.addEventListener('trix-attachment-add', function(event) {
        const attachment = event.attachment;
        if (attachment.file) {
            uploadAttachment(attachment);
        }
    });

    function uploadAttachment(attachment) {
        const file = attachment.file;
        const form = new FormData();
        form.append('file', file);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('articles.upload_image') }}', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
        xhr.upload.onprogress = function(e) {
            let progress = 0;
            if (e.lengthComputable) {
                progress = (e.loaded / e.total) * 100;
            }
            attachment.setUploadProgress(progress);
        };
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        const resp = JSON.parse(xhr.responseText);
                        attachment.setAttributes({ url: resp.url, href: resp.url });
                    } catch (err) {
                        console.error('Upload failed: invalid JSON', err);
                    }
                } else {
                    console.error('Upload failed with status ' + xhr.status);
                }
            }
        };
        xhr.send(form);
    }
</script>
<script>
    // Cover preview & filename display
    const coverInput = document.getElementById('cover');
    const coverFilename = document.getElementById('cover-filename');
    const coverPreview = document.getElementById('cover-preview');
    const coverPreviewImg = document.getElementById('cover-preview-img');

    coverInput.addEventListener('change', function(e) {
        const file = this.files[0];
        if (!file) {
            coverFilename.textContent = 'Tidak ada file dipilih';
            coverPreview.classList.add('hidden');
            return;
        }
        coverFilename.textContent = file.name;
        const reader = new FileReader();
        reader.onload = function(ev) {
            coverPreviewImg.src = ev.target.result;
            coverPreview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    });

    // Clicking the visible label triggers the hidden file input by default because label[for]
</script>
@endsection
