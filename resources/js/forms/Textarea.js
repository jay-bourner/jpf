
// Initialize Summernote
import { SummernoteEditor } from '../features/SummernoteEditor';

class Textarea {
    constructor() {
        this.textareas = document.querySelectorAll('textarea.summernote');

        this.textareas.forEach(textarea => {
            // Initialize Summernote on each textarea
            new SummernoteEditor(textarea);
        });
    }
}

export { Textarea };