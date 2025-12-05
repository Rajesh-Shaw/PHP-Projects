// script.js - simple drag & drop for Kanban
document.addEventListener('DOMContentLoaded', () => {
  const draggables = () => document.querySelectorAll('.card');
  const dropzones = document.querySelectorAll('.dropzone');

  let dragged = null;

  document.addEventListener('dragstart', (e) => {
    const c = e.target.closest('.card');
    if (!c) return;
    dragged = c;
    e.dataTransfer.effectAllowed = 'move';
    c.classList.add('dragging');
  });

  document.addEventListener('dragend', (e) => {
    if (dragged) dragged.classList.remove('dragging');
    dragged = null;
  });

  dropzones.forEach(zone => {
    zone.addEventListener('dragover', (e) => {
      e.preventDefault();
      zone.classList.add('over');
    });

    zone.addEventListener('dragleave', () => {
      zone.classList.remove('over');
    });

    zone.addEventListener('drop', (e) => {
      e.preventDefault();
      zone.classList.remove('over');
      if (!dragged) return;
      zone.appendChild(dragged);

      // update status via AJAX
      const status = zone.closest('.column').getAttribute('data-status');
      const taskId = dragged.getAttribute('data-id');

      fetch('update_status.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({task_id: taskId, status})
      }).then(r => r.json()).then(j => {
        if (j.status !== 'ok') {
          alert('Failed to update: ' + (j.msg || ''));
          location.reload();
        }
      }).catch(err => {
        console.error(err);
        alert('Network error');
        location.reload();
      });
    });
  });
});
