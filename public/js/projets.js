function openModal() {
    document.getElementById('projectModal').classList.add('active');
}

function closeModal() {
    document.getElementById('projectModal').classList.remove('active');
}

// function addProject(event) {
//     event.preventDefault();
//     const title = document.getElementById('projets_titre').value;
//     const description = document.getElementById('projets_description').value;

//     const projectHTML = `
//         <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
//             <div class="flex justify-between items-start">
//                 <span class="px-3 py-1 text-sm font-semibold text-indigo-500 bg-indigo-100 rounded-full">Nouveau</span>
//                 <button class="text-gray-400 hover:text-gray-600">
//                     <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
//                         <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
//                     </svg>
//                 </button>
//             </div>
//             <h3 class="mt-4 text-lg font-semibold">${title}</h3>
//             <p class="mt-2 text-gray-600">${description}</p>
//             <div class="mt-4 flex justify-between items-center">
//                 <div class="flex space-x-4 text-sm text-gray-500">
//                     <span>0 tâches</span>
//                     <span>0 membres</span>
//                 </div>
//                 <a href="kanban.html" class="text-indigo-600 hover:text-indigo-800">Voir le projet →</a>
//             </div>
//         </div>
//     `;

//     document.getElementById('projects-grid').insertAdjacentHTML('afterbegin', projectHTML);
//     closeModal();
//     event.target.reset();
// }