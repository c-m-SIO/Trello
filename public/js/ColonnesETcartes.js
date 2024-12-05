// Variables globales
const users = [
    { id: 1, name: 'John Doe', avatar: 'https://randomuser.me/api/portraits/men/32.jpg' },
    { id: 2, name: 'Jane Smith', avatar: 'https://randomuser.me/api/portraits/women/44.jpg' },
    { id: 3, name: 'Mike Johnson', avatar: 'https://randomuser.me/api/portraits/men/46.jpg' }
];

// Gestion des modales
function openColumnModal() {
    document.getElementById('columnModal').classList.add('active');
}

function closeColumnModal() {
    document.getElementById('columnModal').classList.remove('active');
}

function openTaskModal(columnId) {
    const modal = document.getElementById('taskModal');
    modal.dataset.columnId = columnId;
    modal.classList.add('active');
}

function closeTaskModal() {
    document.getElementById('taskModal').classList.remove('active');
}

// Ajout de colonnes
function addColumn(event) {
    event.preventDefault();
    const title = document.getElementById('columnTitle').value;
    const columnId = 'column-' + Date.now();
    
    const columnHTML = `
        <div class="flex flex-col flex-shrink-0 w-72" id="${columnId}">
            <div class="flex items-center flex-shrink-0 h-10 px-2">
                <span class="block text-sm font-semibold">${title}</span>
                <span class="flex items-center justify-center w-5 h-5 ml-2 text-sm font-semibold text-indigo-500 bg-white rounded bg-opacity-30">0</span>
                <button onclick="openTaskModal('${columnId}')" class="flex items-center justify-center w-6 h-6 ml-auto text-indigo-500 rounded hover:bg-indigo-500 hover:text-indigo-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                </button>
            </div>
            <div class="flex flex-col pb-2 overflow-auto" id="${columnId}-tasks"></div>
        </div>
    `;
    
    document.getElementById('kanban-board').insertAdjacentHTML('beforeend', columnHTML);
    closeColumnModal();
    event.target.reset();
}

// Ajout de tâches
function addTask(event) {
    event.preventDefault();
    const title = document.getElementById('taskTitle').value;
    const description = document.getElementById('taskDescription').value;
    const tag = document.getElementById('taskTag').value;
    const userId = document.getElementById('taskUser').value;
    const columnId = document.getElementById('taskModal').dataset.columnId;
    
    const taskHTML = `
        <div class="relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100" draggable="true">
            <span class="flex items-center h-6 px-3 text-xs font-semibold text-${getTagColor(tag)}-500 bg-${getTagColor(tag)}-100 rounded-full">${tag}</span>
            <h4 class="mt-3 text-sm font-medium">${title}</h4>
            <p class="mt-2 text-xs text-gray-600">${description}</p>
            <div class="flex items-center w-full mt-3 text-xs font-medium text-gray-400">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                    </svg>
                    <span class="ml-1 leading-none">${new Date().toLocaleDateString()}</span>
                </div>
                <img class="w-6 h-6 ml-auto rounded-full" src="${getUserAvatar(userId)}" alt="${getUserName(userId)}"/>
            </div>
        </div>
    `;
    
    document.getElementById(`${columnId}-tasks`).insertAdjacentHTML('beforeend', taskHTML);
    updateTaskCount(columnId);
    closeTaskModal();
    event.target.reset();
}

function getTagColor(tag) {
    const colors = {
        design: 'pink',
        dev: 'green',
        marketing: 'yellow'
    };
    return colors[tag] || 'gray';
}

function getUserAvatar(userId) {
    const user = users.find(u => u.id === parseInt(userId));
    return user ? user.avatar : 'https://randomuser.me/api/portraits/men/32.jpg';
}

function getUserName(userId) {
    const user = users.find(u => u.id === parseInt(userId));
    return user ? user.name : 'Utilisateur';
}

function updateTaskCount(columnId) {
    const column = document.getElementById(columnId);
    const tasksCount = column.querySelectorAll('.flex.flex-col.pb-2 > div').length;
    column.querySelector('span.flex.items-center.justify-center').textContent = tasksCount;
}