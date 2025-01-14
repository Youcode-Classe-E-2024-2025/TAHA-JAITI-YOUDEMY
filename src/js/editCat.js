const editCat = () => {
    const editBtns = document.querySelectorAll('#editCat');
    const editForm = document.getElementById('editForm');

    if (editBtns && editForm){
        editBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();                
                const closeRow = btn.closest('tr');

                const [id, name] = closeRow.querySelectorAll('td');
                
                const nameInput = editForm.querySelector('#name');
                const idInput = editForm.querySelector('#idInput');
                
                nameInput.value = name.textContent;
                idInput.value = id.textContent;

                editForm.classList.toggle('hidden');
                editForm.classList.toggle('flex');

                const close = editForm.querySelector('#closeEdit');

                close.addEventListener('click', (e) => {
                    e.preventDefault();

                    editForm.classList.toggle('hidden');
                    editForm.classList.toggle('flex');
                })
            })
        })
    }

}

export default editCat;