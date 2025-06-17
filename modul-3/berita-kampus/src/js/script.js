// Element references
const btn = document.getElementById('menu-btn');
const menu = document.getElementById('mobile-menu');
const iconOpen = document.getElementById('icon-open');
const iconClose = document.getElementById('icon-close');
const overlay = document.getElementById('modal-overlay');
const confirmModal = document.getElementById('confirm-modal');
const confirmText = document.getElementById('confirm-text');
const confirmYes = document.getElementById('confirm-yes');
const confirmNo = document.getElementById('confirm-no');
const editModal = document.getElementById('edit-modal');
const editInput = document.getElementById('edit-input');
const editSave = document.getElementById('edit-save');
const editCancel = document.getElementById('edit-cancel');

// Sidebar toggle
btn.addEventListener('click', e => {
  e.stopPropagation();
  menu.classList.toggle('hidden');
  iconOpen.classList.toggle('hidden');
  iconClose.classList.toggle('hidden');
});

document.addEventListener('click', e => {
  if (!menu.classList.contains('hidden') && !menu.contains(e.target) && e.target !== btn) {
    menu.classList.add('hidden');
    iconOpen.classList.remove('hidden');
    iconClose.classList.add('hidden');
  }
});

// Comments CRUD + Like
let currentAction = null;
let currentArticle = null;
let currentIndex = null;
function loadComments(id) { return JSON.parse(localStorage.getItem(`comments_article_${id}`) || '[]'); }
function saveComments(id, cmts) { localStorage.setItem(`comments_article_${id}`, JSON.stringify(cmts)); }

function showConfirm(text, onYes) {
  confirmText.textContent = text;
  overlay.classList.remove('hidden');
  confirmModal.classList.remove('hidden');
  // Handlers
  const yesHandler = () => { onYes(); hideModal(); };
  confirmYes.addEventListener('click', yesHandler, { once: true });
  confirmNo.addEventListener('click', hideModal, { once: true });
}

function showEdit(initial, onSave) {
  editInput.value = initial;
  overlay.classList.remove('hidden');
  editModal.classList.remove('hidden');
  const saveHandler = () => { onSave(editInput.value.trim()); hideModal(); };
  editSave.addEventListener('click', saveHandler, { once: true });
  editCancel.addEventListener('click', hideModal, { once: true });
}

function hideModal() {
  overlay.classList.add('hidden');
  confirmModal.classList.add('hidden');
  editModal.classList.add('hidden');
}

function renderComments(articleId) {
  const list = document.getElementById(`comments-list-${articleId}`);
  list.innerHTML = '';
  const comments = loadComments(articleId);
  comments.forEach((c, idx) => {
    const card = document.createElement('div');
    card.className = 'bg-gray-100 p-3 rounded relative';
    card.innerHTML = `
      <div class="mb-2">${c.text}</div>
      <div class="flex items-center space-x-3 text-gray-600">
        <button data-action="like" class="focus:outline-none">❤️ ${c.likes}</button>
        <button data-action="edit" class="focus:outline-none">✏️</button>
        <button data-action="delete" class="focus:outline-none">🗑️</button>
      </div>
    `;
    // Delegation
    card.addEventListener('click', e => {
      const action = e.target.getAttribute('data-action');
      if (action === 'like') {
        c.likes++;
        saveComments(articleId, comments);
        renderComments(articleId);
      }
      if (action === 'edit') {
        showEdit(c.text, newText => {
          if (newText) { c.text = newText; saveComments(articleId, comments); renderComments(articleId); }
        });
      }
      if (action === 'delete') {
        showConfirm('Hapus komentar ini?', () => {
          comments.splice(idx, 1);
          saveComments(articleId, comments);
          renderComments(articleId);
        });
      }
    });
    list.appendChild(card);
  });
}

document.querySelectorAll('form[data-article-id]').forEach(form => {
  const id = form.dataset.articleId;
  renderComments(id);
  form.addEventListener('submit', e => {
    e.preventDefault();
    const txt = form.comment.value.trim();
    if (!txt) return;
    const cmts = loadComments(id);
    cmts.push({ text: txt, likes: 0 });
    saveComments(id, cmts);
    renderComments(id);
    form.reset();
  });
});