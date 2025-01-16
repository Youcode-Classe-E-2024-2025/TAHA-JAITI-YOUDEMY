import { showError } from "./errorHandler.js";
import { clearErrors } from "./errorHandler.js";

const handleAddCourse = () => {
    const formContainer = document.getElementById('addContainer');
    const form = document.getElementById('addForm');
    const btn = document.getElementById('addBtn');
    const close = document.getElementById('closeBtn');

    if (btn && form && formContainer && close) {
        const toggle = () => {
            formContainer.classList.toggle('hidden');
            formContainer.classList.toggle('flex');
        };

        btn.addEventListener('click', toggle);
        close.addEventListener('click', toggle);

        formContainer.addEventListener('click', (e) => {
            if (e.target === formContainer) {
                toggle();
            }
        });

        form.addEventListener('click', (e) => {
            e.stopPropagation();


        });

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let valid = true;

            const title = form.querySelector('#title');
            if (!title.value.trim() || title.value.length < 10) {
                showError(title, 'Title is must be at least 10 characters long.');
                valid = false;
            }

            const description = form.querySelector('#description');
            if (!description.value.trim() || description.value.length < 10) {
                showError(description, 'Description is .');
                valid = false;
            }

            const content = form.querySelector('#content');
            if (!content.value.trim()) {
                showError(content, 'Content is required.');
                valid = false;
            }

            const category = form.querySelector('#category_id');
            if (!category.value) {
                showError(category, 'Category is required.');
                valid = false;
            }

            const tags = form.querySelector('#tags');
            if (!tags.value || tags.selectedOptions.length === 0) {
                showError(tags, 'At least one tag is required.');
                valid = false;
            }

            if (valid){
                form.submit();
            }
        })
    }

    tinymce.init({
        selector: '#content',
        license_key: 'gpl',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        height: 300,
        menubar: false,
        branding: false,
        setup: (editor) => {
            editor.on('change', () => {
                editor.save();
            });
        }
    });
}

export default handleAddCourse;