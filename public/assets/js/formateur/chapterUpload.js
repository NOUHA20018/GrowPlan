document.addEventListener('DOMContentLoaded', function() {
    const r = new Resumable({
        target: '/upload-video',
        query: {_token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
        fileType: ['mp4', 'mov'],
        chunkSize: 1 * 1024 * 1024, // 1MB
        headers: { 
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        testChunks: true,
        throttleProgressCallbacks: 1,
    });

    // Assign browse to file input
    r.assignBrowse(document.querySelector('input[name="video"]'));
    
    r.on('fileAdded', function(file) {
        document.getElementById('upload-progress').innerText = 'Starting upload...';
        r.upload();
    });

    r.on('fileProgress', function(file) {
        const progress = Math.floor(file.progress() * 100);
        document.getElementById('upload-progress').innerText = `${progress}% uploaded`;
    });

    r.on('fileSuccess', function(file, response) {
        try {
            const jsonResponse = JSON.parse(response);
            document.getElementById('uploadedVideoName').value = jsonResponse.fileName;
            document.getElementById('upload-progress').innerText = 'Upload complete!';
        } catch (e) {
            document.getElementById('upload-progress').innerText = 'Error processing upload';
            console.error('Error parsing response:', e);
        }
    });

    r.on('fileError', function(file, message) {
        document.getElementById('upload-progress').innerText = 'Upload failed: ' + message;
    });

    r.on('error', function(message, file) {
        document.getElementById('upload-progress').innerText = 'Error: ' + message;
    });
});