<form action="{{ route('communities.messages.store', $community) }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($isChatLocked && !$canModerate)
        <div class="alert alert-warning mb-3">
            <i class="fas fa-lock"></i> {{ __('Chat is currently locked by a moderator') }}
        </div>
    @endif

    <div class="input-group mb-3">
        <textarea class="form-control" id="messageInput" name="content" rows="2"
            placeholder="{{ $isChatLocked && !$canModerate ? __('Chat is currently locked by a moderator') : __('Type a message') }}"
            {{ $isChatLocked && !$canModerate ? 'disabled' : '' }}></textarea>

        @if(!($isChatLocked && !$canModerate))
            <button class="btn btn-outline-secondary" type="button" title="{{ __('Add attachment') }}" id="attachmentBtn">
                <i class="fas fa-paperclip"></i>
            </button>
        @endif

        <button class="btn btn-primary" type="submit" {{ $isChatLocked && !$canModerate ? 'disabled' : '' }}>
            <i class="fas fa-paper-plane"></i> {{ __('Send') }}
        </button>
    </div>

    @if(!($isChatLocked && !$canModerate))
        <input type="file" name="attachment" id="attachment" class="d-none" accept="image/jpeg,image/jpg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,application/zip">

        <div id="imagePreview" class="mt-2 d-none">
            <div class="d-flex align-items-center">
                <div class="image-preview-container me-2">
                    <img src="" class="img-thumbnail" style="max-height: 100px; display: none;" alt="{{ __('Preview') }}">
                </div>
                <div class="file-icon-container me-2 d-none">
                    <i class="fas fa-file fa-2x text-primary"></i>
                </div>
                <div class="file-name-container me-2"></div>
                <button type="button" class="btn btn-sm btn-outline-danger" id="removeAttachment">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="mt-2">
            <small class="text-muted">
                <i class="fas fa-info-circle"></i>
                {{ __('Moderators can remove inappropriate content at any time') }}
            </small>
        </div>
    @endif

    @if($isSlowMode > 0 && !$canModerate)
        <div class="mt-2">
            <small class="text-muted">
                <i class="fas fa-clock"></i>
                {{ __('Slow mode is active') }}:
                {{ $isSlowMode < 60 ? __(':seconds seconds between messages', ['seconds' => $isSlowMode]) : __(':minutes minute(s) between messages', ['minutes' => $isSlowMode / 60]) }}
            </small>
        </div>
    @endif
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const attachmentInput = document.getElementById('attachment');
        const attachmentBtn = document.getElementById('attachmentBtn');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewImg = imagePreview.querySelector('img');
        const fileIconContainer = document.querySelector('.file-icon-container');
        const fileNameContainer = document.querySelector('.file-name-container');
        const removeAttachmentBtn = document.getElementById('removeAttachment');

        // Open file dialog when attachment button is clicked
        if (attachmentBtn) {
            attachmentBtn.addEventListener('click', function() {
                attachmentInput.click();
            });
        }

        // Show preview when file is selected
        if (attachmentInput) {
            attachmentInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];

                    if (file.type.startsWith('image/')) {
                        // If it's an image, show image preview
                        imagePreviewImg.style.display = 'block';
                        fileIconContainer.classList.add('d-none');

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreviewImg.src = e.target.result;
                            fileNameContainer.textContent = file.name;
                            imagePreview.classList.remove('d-none');
                        };

                        reader.readAsDataURL(file);
                    } else {
                        // If it's not an image, show file icon
                        imagePreviewImg.style.display = 'none';
                        fileIconContainer.classList.remove('d-none');
                        fileNameContainer.textContent = file.name;
                        imagePreview.classList.remove('d-none');
                    }
                }
            });
        }

        // Remove attachment
        if (removeAttachmentBtn) {
            removeAttachmentBtn.addEventListener('click', function() {
                attachmentInput.value = '';
                imagePreview.classList.add('d-none');
                imagePreviewImg.src = '';
                imagePreviewImg.style.display = 'none';
                fileIconContainer.classList.add('d-none');
                fileNameContainer.textContent = '';
            });
        }
    });
</script>
