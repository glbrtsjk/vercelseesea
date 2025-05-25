
document.addEventListener('DOMContentLoaded', function() {
    // Ban user action
    const banUserLinks = document.querySelectorAll('.ban-user');
    banUserLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const userId = this.dataset.userId;
            if (confirm('Are you sure you want to ban this user from the community?')) {
                const communitySlug = document.querySelector('meta[name="community-slug"]').content;

                fetch(`/communities/${communitySlug}/ban-user`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        reason: 'Banned by moderator'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success notification
                        showNotification('success', 'User has been banned from this community');

                        // If we're on the moderation page, refresh the banned users list
                        if (document.getElementById('refreshBannedBtn')) {
                            loadBannedUsers();
                        }
                    } else {
                        showNotification('danger', data.message || 'Error banning user');
                    }
                })
                .catch(error => {
                    console.error('Error banning user:', error);
                    showNotification('danger', 'Error banning user');
                });
            }
        });
    });

    // Mute user action
    const muteUserLinks = document.querySelectorAll('.mute-user');
    muteUserLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            const userId = this.dataset.userId;
            if (confirm('Are you sure you want to mute this user for 15 minutes?')) {
                const communitySlug = document.querySelector('meta[name="community-slug"]').content;

                fetch(`/communities/${communitySlug}/mute-user`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        user_id: userId,
                        duration: 15 // minutes
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success notification
                        showNotification('success', 'User has been muted for 15 minutes');

                        // If we're on the moderation page, refresh the muted users list
                        if (document.getElementById('refreshMutedBtn')) {
                            loadMutedUsers();
                        }
                    } else {
                        showNotification('danger', data.message || 'Error muting user');
                    }
                })
                .catch(error => {
                    console.error('Error muting user:', error);
                    showNotification('danger', 'Error muting user');
                });
            }
        });
    });

    // Load banned users (for moderation page)
    function loadBannedUsers() {
        const container = document.querySelector('#bannedUsersContainer');
        if (!container) return;

        const communitySlug = document.querySelector('meta[name="community-slug"]').content;

        container.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

        fetch(`/communities/${communitySlug}/banned-users`)
            .then(response => response.json())
            .then(data => {
                if (data.users && data.users.length > 0) {
                    container.innerHTML = '';
                    const list = document.createElement('ul');
                    list.className = 'list-group';

                    data.users.forEach(user => {
                        const item = document.createElement('li');
                        item.className = 'list-group-item d-flex justify-content-between align-items-center';

                        const userInfo = document.createElement('div');
                        userInfo.innerHTML = `
                            <span class="fw-bold">${user.nama}</span>
                            <small class="text-muted d-block">Banned on: ${user.banned_date}</small>
                        `;

                        const unbanBtn = document.createElement('button');
                        unbanBtn.className = 'btn btn-sm btn-outline-primary unban-user';
                        unbanBtn.innerHTML = 'Unban';
                        unbanBtn.dataset.userId = user.id;
                        unbanBtn.addEventListener('click', function() {
                            unbanUser(user.id);
                        });

                        item.appendChild(userInfo);
                        item.appendChild(unbanBtn);
                        list.appendChild(item);
                    });

                    container.appendChild(list);
                } else {
                    container.innerHTML = '<div class="alert alert-info">No banned users in this community.</div>';
                }
            })
            .catch(error => {
                console.error('Error loading banned users:', error);
                container.innerHTML = '<div class="alert alert-danger">Error loading banned users</div>';
            });
    }

    // Load muted users (for moderation page)
    function loadMutedUsers() {
        const container = document.querySelector('#mutedUsersContainer');
        if (!container) return;

        const communitySlug = document.querySelector('meta[name="community-slug"]').content;

        container.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

        fetch(`/communities/${communitySlug}/muted-users`)
            .then(response => response.json())
            .then(data => {
                if (data.users && data.users.length > 0) {
                    container.innerHTML = '';
                    const list = document.createElement('ul');
                    list.className = 'list-group';

                    data.users.forEach(user => {
                        const item = document.createElement('li');
                        item.className = 'list-group-item d-flex justify-content-between align-items-center';

                        const userInfo = document.createElement('div');
                        userInfo.innerHTML = `
                            <span class="fw-bold">${user.nama}</span>
                            <small class="text-muted d-block">Muted until: ${user.muted_until}</small>
                        `;

                        const unmuteBtn = document.createElement('button');
                        unmuteBtn.className = 'btn btn-sm btn-outline-warning unmute-user';
                        unmuteBtn.innerHTML = 'Unmute';
                        unmuteBtn.dataset.userId = user.id;
                        unmuteBtn.addEventListener('click', function() {
                            unmuteUser(user.id);
                        });

                        item.appendChild(userInfo);
                        item.appendChild(unmuteBtn);
                        list.appendChild(item);
                    });

                    container.appendChild(list);
                } else {
                    container.innerHTML = '<div class="alert alert-info">No muted users in this community.</div>';
                }
            })
            .catch(error => {
                console.error('Error loading muted users:', error);
                container.innerHTML = '<div class="alert alert-danger">Error loading muted users</div>';
            });
    }

    // Unban user
    function unbanUser(userId) {
        if (confirm('Are you sure you want to unban this user?')) {
            const communitySlug = document.querySelector('meta[name="community-slug"]').content;

            fetch(`/communities/${communitySlug}/unban-user`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    showNotification('success', 'User has been unbanned');

                    // Refresh banned users list
                    loadBannedUsers();
                } else {
                    showNotification('danger', data.message || 'Error unbanning user');
                }
            })
            .catch(error => {
                console.error('Error unbanning user:', error);
                showNotification('danger', 'Error unbanning user');
            });
        }
    }

    // Unmute user
    function unmuteUser(userId) {
        if (confirm('Are you sure you want to unmute this user?')) {
            const communitySlug = document.querySelector('meta[name="community-slug"]').content;

            fetch(`/communities/${communitySlug}/unmute-user`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    showNotification('success', 'User has been unmuted');

                    // Refresh muted users list
                    loadMutedUsers();
                } else {
                    showNotification('danger', data.message || 'Error unmuting user');
                }
            })
            .catch(error => {
                console.error('Error unmuting user:', error);
                showNotification('danger', 'Error unmuting user');
            });
        }
    }

    // Initialize on moderation page
    if (document.getElementById('bannedUsersContainer')) {
        loadBannedUsers();
    }

    if (document.getElementById('mutedUsersContainer')) {
        loadMutedUsers();
    }

    // Refresh buttons
    const refreshBannedBtn = document.getElementById('refreshBannedBtn');
    if (refreshBannedBtn) {
        refreshBannedBtn.addEventListener('click', loadBannedUsers);
    }

    const refreshMutedBtn = document.getElementById('refreshMutedBtn');
    if (refreshMutedBtn) {
        refreshMutedBtn.addEventListener('click', loadMutedUsers);
    }

    // Utility function to show notifications
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} notification-toast position-fixed bottom-0 end-0 m-3`;
        notification.style.zIndex = 1060;
        notification.innerHTML = message;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
        }, 100);

        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
});
